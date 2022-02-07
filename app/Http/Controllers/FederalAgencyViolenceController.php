<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFederalAgencyViolenceRequest;
use App\Http\Requests\UpdateFederalAgencyViolenceRequest;
use App\Models\Department;
use App\Models\District;
use App\Models\FederalAgencyViolence;
use App\Models\Month;
use Yajra\DataTables\DataTables;

class FederalAgencyViolenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(request()->ajax()) {
            $query = FederalAgencyViolence::with('department' ,'district', 'month');
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('department_name', function (FederalAgencyViolence $federalAgencyViolence) {
                    return optional($federalAgencyViolence->department)->department_name;
                })
                ->addColumn('district_name_e', function (FederalAgencyViolence $federalAgencyViolence) {
                    return optional($federalAgencyViolence->district)->district_name_e;
                })
                ->addColumn('month_name', function (FederalAgencyViolence $federalAgencyViolence) {
                    return optional($federalAgencyViolence->month)->month_name;
                })
                ->editColumn('status', function (FederalAgencyViolence $federalAgencyViolence) {
                    return '<span class="label label-lg font-weight-bold label-inline '.($federalAgencyViolence->status?'label-light-success':'label-light-danger').'">'.($federalAgencyViolence->status?'Active':'Inactive').'</span>';
                })
                ->addColumn('action', function(FederalAgencyViolence $federalAgencyViolence){
                    $actionBtn ='<a href="'.route('police-department-violences.edit',$federalAgencyViolence).'" class="btn btn-icon btn-outline-danger btn-circle btn-xs mr-2" title="Update"> <i class="flaticon2-edit"></i> </a>';
                    $actionBtn .= '<a onclick="activate_inactive(this); return false;" href="' . route('police-department-violences.destroy', $federalAgencyViolence) . '" class="btn btn-icon btn-circle btn-xs mr-2 btn-outline-danger" title="' . ($federalAgencyViolence->status? 'Deactivate' : 'Activate') . '"> <i class="' . ($federalAgencyViolence->status ? 'icon-md fas fa-toggle-on' : 'icon-md fas fa-toggle-off') . '"></i> </a>';
                    return $actionBtn;
                })
                ->rawColumns(['district_name_e','month_name','target_value','status', 'action'])
                ->make(true);
        }
        return view('federal-agency-violences.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::where('status', 1)->get();
        $districts = District::where('district_status', 1)->where('province_id',7)->get();
        $months = Month::all();
        return view('federal-agency-violences.create', compact('departments', 'districts', 'months'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFederalAgencyViolenceRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreFederalAgencyViolenceRequest $request)
    {
        FederalAgencyViolence::create($request->validated());
        return redirect()
            ->route('federal-agency-violences.index')
            ->with('success_message', 'Violence Against Women has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FederalAgencyViolence  $federalAgencyViolence
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(FederalAgencyViolence $federalAgencyViolence)
    {
        $federalAgencyViolence->load('department', 'district', 'month');
        return view('federal-agency-violences.show',compact('federalAgencyViolence'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FederalAgencyViolence  $federalAgencyViolence
     * @return \Illuminate\Http\Response
     */
    public function edit(FederalAgencyViolence $federalAgencyViolence)
    {
        $federalAgencyViolence->load('department', 'district', 'month');
        $departments = Department::where('status', 1)->get();
        $districts = District::where('district_status', 1)->where('province_id',7)->get();
        $months = Month::all();
        return view('federal-agency-violences.edit', compact('federalAgencyViolence', 'departments', 'districts', 'months'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFederalAgencyViolenceRequest  $request
     * @param  \App\Models\FederalAgencyViolence  $federalAgencyViolence
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateFederalAgencyViolenceRequest $request, FederalAgencyViolence $federalAgencyViolence)
    {
        $federalAgencyViolence->update($request->validated());
        return redirect()
            ->route('federal-agency-violences.index')
            ->with('success_message', 'Violence Against Women has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FederalAgencyViolence  $federalAgencyViolence
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(FederalAgencyViolence $federalAgencyViolence)
    {
        $federalAgencyViolence->update(['status'=>!$federalAgencyViolence->status]);
        return redirect()
            ->route('federal-agency-violences.index')
            ->with('success_message', 'Violence Against Women status has been changed successfully.');
    }
}
