<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Storage;
use App\Jobs\SendChangePasswordEmailJob;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function index(Request $request)
    {


        if ($request->ajax()) {

            $query = User::with('role','department')->where('role_id','!=','1')->get();
            return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('name', function (User $user) {
                return $user->name;
            })
            ->addColumn('email', function (User $user) {
                return $user->email;
            })
            ->addColumn('role', function (User $user) {
                return $user->role->role_name;
            })
                ->addColumn('department', function (User $user) {
                    return $user->department->department_name;
                })
            ->addColumn('status', function (User $user) {
                if($user->status==1){
                    $title='Active';
                    $class='label-light-success';
                }else{
                    $title='Inactive';
                    $class=' label-light-danger';
                }
                  $form="<span class='label label-lg font-weight-bold ".$class." label-inline'>$title</span>";

                  return $form;

            })
            ->addColumn('action', function(User $user){
                $actionBtn ='<a href="'.route('users.edit',$user).'" class="btn btn-icon btn-outline-danger btn-circle btn-xs mr-2" title="Update"> <i class="flaticon2-edit"></i> </a>';
                $actionBtn .= '<a onclick="activate_inactive(this); return false;" href="' . route('users.destroy', $user) . '" class="btn btn-icon btn-circle btn-xs mr-2 btn-outline-danger" title="' . ($user->status? 'Deactivate' : 'Activate') . '"> <i class="' . ($user->status ? 'icon-md fas fa-toggle-on' : 'icon-md fas fa-toggle-off') . '"></i> </a>';
                return $actionBtn;
            })
            ->rawColumns(['action','status'])
            ->make(true);

        }
        return view('users.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('id', '!=', '1')->get(['id', 'role_name']);
        $departments = Department::get(['id', 'department_name']);
        return view('users.create',compact('roles','departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'cnic_no' => 'required|unique:users,cnic_no',
            'password' => 'required|same:password_confirmation',
            'mobile_no' => 'required',
            'role_id' => 'required',
            'department_id' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        return redirect()->route('users.index')->with('success_message','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::where('id', '!=', '1')->get(['id', 'role_name']);
        $departments = Department::get(['id', 'department_name']);
        return view('users.edit', compact('user', 'roles','departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'username' => 'required|unique:users,username,'.$id,
            'cnic_no' => 'required|unique:users,cnic_no,'.$id,
            'password' => 'same:password_confirmation',
            'mobile_no' => 'required',
            'role_id' => 'required',
            'department_id' => 'required'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        return redirect()->route('users.index')
                        ->with('success_message','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
       $user->update(['status'=> !$user->status]);
       return redirect()->route('users.index')->with('success','User deleted successfully');
    }

    public function profile(){
        $user = Auth::user();
        $roles = Role::all();
        return view('users.profile',compact('user', 'roles'));
    }


    public function profileUpdate(ProfileUpdateRequest $request){

        $validated = $request->validated();

        $user = User::findorfail(auth()->id());
        $user->update($validated);

         session()->flash(
            'status', 'Your profile has been successfully updated.'
        );
         return redirect()->route('profile');
    }


    public function changePassword(){
        return view('users.change_password');
    }

    public function passwordUpdate(ChangePasswordRequest $request){
     User::find(auth()->user()->id)->update(['password'=> Hash::make($request->password)]);
      $user = User::find(auth()->user()->id);
      $user->new_password=$request->password;

//      dispatch(new SendChangePasswordEmailJob($user->toArray()));


        return redirect()->back()->with('success','Password has been change successfully.');
    }

}
