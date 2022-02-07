<?php

namespace App\Http\Controllers;

use App\Models\Target;
use App\Http\Requests\StoreTargetRequest;
use App\Http\Requests\UpdateTargetRequest;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class TargetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $query=Target::with('indicators');
            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('icon_name', function (Target $target) {
                    return '<a target="_blank" href="'.Storage::url($target->icon_name).'" title="Icon" class="btn btn-icon btn-outline-danger btn-circle btn-sm"/><i class="flaticon2-download"></i></a>';
                })
                ->editColumn('status', function (Target $target) {
                    return '<span class="label label-lg font-weight-bold label-inline '.($target->status == "Active"?'label-light-success':'label-light-danger').'">'.($target->status).'</span>';
                })
                ->addColumn('indicator_titles', function (Target $target) {
                    $indicator_titles = '<ol style="padding-left: 0 !important;">';
                    foreach ($target->indicators as $indicator){
                        $indicator_titles .= "<li>{$indicator->indicator_title}</li>";
                    }
                    $indicator_titles .= '</ul>';
                    return $indicator_titles;
                })
                ->addColumn('action', function(Target $target){
                        $actionBtn ='<a href="'.route('targets.edit',$target).'" class="btn btn-icon btn-outline-danger btn-circle btn-xs mr-2" title="Update"> <i class="flaticon2-edit"></i> </a>';
                        $actionBtn .= '<a onclick="activate_inactive(this); return false;" href="' . route('targets.destroy', $target) . '" class="btn btn-icon btn-circle btn-xs mr-2 btn-outline-danger" title="' . ($target->status == "Inactive" ? 'Activate' : 'Deactivate') . '"> <i class="' . ($target->status=='Active' ? 'icon-md fas fa-toggle-on' : 'icon-md fas fa-toggle-off') . '"></i> </a>';
                    return $actionBtn;
                })
                ->rawColumns(['indicator_titles','icon_name', 'status', 'action'])
                ->make(true);
        }
        return view('targets.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('targets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTargetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTargetRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('icon_name')) {
            $file = $request->file('icon_name');
            $data['icon_name'] = $file->store('target-icons', 'public');
        }
        $data['status'] = "Active";
        Target::create($data);
        return redirect()
            ->route('targets.index')
            ->with('success_message', 'Target has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Target  $target
     * @return \Illuminate\Http\Response
     */
    public function show(Target $target)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Target  $target
     * @return \Illuminate\Http\Response
     */
    public function edit(Target $target)
    {
        return view('targets.edit',compact('target'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTargetRequest  $request
     * @param  \App\Models\Target  $target
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTargetRequest $request, Target $target)
    {
        $data = $request->validated();
        if ($request->hasFile('icon_name')) {
            $file = $request->file('icon_name');
            $data['icon_name'] = $file->store('target-icons', 'public');
        }
        $target->update($data);
        return redirect()
            ->route('targets.index')
            ->with('success_message', 'Target has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Target  $target
     * @return \Illuminate\Http\Response
     */
    public function destroy(Target $target)
    {
        if($target->status == "Active"){
            $selected_status = "Inactive";
        }else{
            $selected_status = "Active";
        }
        $target->update(['status'=>$selected_status]);
        return redirect()
            ->route('targets.index')
            ->with('success_message', 'Target status has been changed successfully.');
    }
}
