<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePoliceDepartmentViolenceRequest;
use App\Http\Requests\UpdatePoliceDepartmentViolenceRequest;
use App\Models\Department;
use App\Models\District;
use App\Models\Month;
use App\Models\PoliceDepartmentViolence;
use Yajra\DataTables\DataTables;

class PoliceDepartmentViolenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $query = PoliceDepartmentViolence::with('department' ,'district', 'month');
            if(auth()->user()->isDepartment()){
                $query->where('department_id', auth()->user()->department_id);
            }
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('department_name', function (PoliceDepartmentViolence $policeDepartmentViolence) {
                    return optional($policeDepartmentViolence->department)->department_name;
                })
                ->addColumn('district_name_e', function (PoliceDepartmentViolence $policeDepartmentViolence) {
                    return optional($policeDepartmentViolence->district)->district_name_e;
                })
                ->addColumn('month_name', function (PoliceDepartmentViolence $policeDepartmentViolence) {
                    return optional($policeDepartmentViolence->month)->month_name;
                })
                ->editColumn('status', function (PoliceDepartmentViolence $policeDepartmentViolence) {
                    return '<span class="label label-lg font-weight-bold label-inline '.($policeDepartmentViolence->status?'label-light-success':'label-light-danger').'">'.($policeDepartmentViolence->status?'Active':'Inactive').'</span>';
                })
                ->addColumn('action', function(PoliceDepartmentViolence $policeDepartmentViolence){
                    $actionBtn = '<a target="_blank" href="' . route('police-department-violences.show', $policeDepartmentViolence) . '" class="btn btn-icon btn-circle btn-xs mr-2 btn-outline-danger" title="Detail"> <i class="icon-md fas fa-eye"></i> </a>';
                    if (auth()->user()->isDepartment() && !auth()->user()->isPAPDepartment()) {
                        $actionBtn .= '<a href="' . route('police-department-violences.edit', $policeDepartmentViolence) . '" class="btn btn-icon btn-outline-danger btn-circle btn-xs mr-2" title="Update"> <i class="flaticon2-edit"></i> </a>';
                        $actionBtn .= '<a onclick="activate_inactive(this); return false;" href="' . route('police-department-violences.destroy', $policeDepartmentViolence) . '" class="btn btn-icon btn-circle btn-xs mr-2 btn-outline-danger" title="' . ($policeDepartmentViolence->status ? 'Deactivate' : 'Activate') . '"> <i class="' . ($policeDepartmentViolence->status ? 'icon-md fas fa-toggle-on' : 'icon-md fas fa-toggle-off') . '"></i> </a>';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['district_name_e','month_name','target_value','status', 'action'])
                ->make(true);
        }
        return view('police-department-violences.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::where('status', 1)->get();
        $districts = District::where('district_status', 1)->where('province_id',7)->get();
        $months = Month::all();
        return view('police-department-violences.create', compact('departments', 'districts', 'months'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePoliceDepartmentViolenceRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePoliceDepartmentViolenceRequest $request)
    {
        PoliceDepartmentViolence::create($request->validated());
        return redirect()
            ->route('police-department-violences.index')
            ->with('success_message', 'Violence Against Children and Women has been added successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PoliceDepartmentViolence  $policeDepartmentViolence
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(PoliceDepartmentViolence $policeDepartmentViolence)
    {
        $policeDepartmentViolence->load('department' ,'district', 'month');
        return view('police-department-violences.show',compact('policeDepartmentViolence'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PoliceDepartmentViolence  $policeDepartmentViolence
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(PoliceDepartmentViolence $policeDepartmentViolence)
    {
        $policeDepartmentViolence->load('department', 'district', 'month');
        $departments = Department::where('status', 1)->get();
        $districts = District::where('district_status', 1)->where('province_id',7)->get();
        $months = Month::all();
        return view('police-department-violences.edit', compact('policeDepartmentViolence', 'departments', 'districts', 'months'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePoliceDepartmentViolenceRequest  $request
     * @param  \App\Models\PoliceDepartmentViolence  $policeDepartmentViolence
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePoliceDepartmentViolenceRequest $request, PoliceDepartmentViolence $policeDepartmentViolence)
    {
        $policeDepartmentViolence->update($request->validated());
        return redirect()
            ->route('police-department-violences.index')
            ->with('success_message', 'Violence Against Children and Women has been updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PoliceDepartmentViolence  $policeDepartmentViolence
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(PoliceDepartmentViolence $policeDepartmentViolence)
    {
        $policeDepartmentViolence->update(['status'=>!$policeDepartmentViolence->status]);
        return redirect()
            ->route('police-department-violences.index')
            ->with('success_message', 'Violence Against Children and Women status has been changed successfully.');
    }

}
