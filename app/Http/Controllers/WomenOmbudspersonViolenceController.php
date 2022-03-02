<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWomenOmbudspersonViolenceRequest;
use App\Http\Requests\UpdateWomenOmbudspersonViolenceRequest;
use App\Models\Department;
use App\Models\District;
use App\Models\Month;
use App\Models\WomenOmbudspersonViolence;
use Yajra\DataTables\DataTables;

class WomenOmbudspersonViolenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $query = WomenOmbudspersonViolence::with('department' ,'district', 'month');
            if(auth()->user()->isDepartment()){
                $query->where('department_id', auth()->user()->department_id);
            }
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('department_name', function (WomenOmbudspersonViolence $womenOmbudspersonViolence) {
                    return optional($womenOmbudspersonViolence->department)->department_name;
                })
                ->addColumn('district_name_e', function (WomenOmbudspersonViolence $womenOmbudspersonViolence) {
                    return optional($womenOmbudspersonViolence->district)->district_name_e;
                })
                ->addColumn('month_name', function (WomenOmbudspersonViolence $womenOmbudspersonViolence) {
                    return optional($womenOmbudspersonViolence->month)->month_name;
                })
                ->editColumn('status', function (WomenOmbudspersonViolence $womenOmbudspersonViolence) {
                    return '<span class="label label-lg font-weight-bold label-inline '.($womenOmbudspersonViolence->status?'label-light-success':'label-light-danger').'">'.($womenOmbudspersonViolence->status?'Active':'Inactive').'</span>';
                })
                ->addColumn('action', function(WomenOmbudspersonViolence $womenOmbudspersonViolence){
                    $actionBtn = '<a target="_blank" href="' . route('women-ombudsperson-violences.show', $womenOmbudspersonViolence) . '" class="btn btn-icon btn-circle btn-xs mr-2 btn-outline-danger" title="Detail"> <i class="icon-md fas fa-eye"></i> </a>';
                    if (auth()->user()->isDepartment() && !auth()->user()->isPAPDepartment()) {
                        $actionBtn .= '<a href="' . route('women-ombudsperson-violences.edit', $womenOmbudspersonViolence) . '" class="btn btn-icon btn-outline-danger btn-circle btn-xs mr-2" title="Update"> <i class="flaticon2-edit"></i> </a>';
                        $actionBtn .= '<a onclick="activate_inactive(this); return false;" href="' . route('women-ombudsperson-violences.destroy', $womenOmbudspersonViolence) . '" class="btn btn-icon btn-circle btn-xs mr-2 btn-outline-danger" title="' . ($womenOmbudspersonViolence->status ? 'Deactivate' : 'Activate') . '"> <i class="' . ($womenOmbudspersonViolence->status ? 'icon-md fas fa-toggle-on' : 'icon-md fas fa-toggle-off') . '"></i> </a>';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['district_name_e','month_name','target_value','status', 'action'])
                ->make(true);
        }
        return view('women-ombudsperson-violences.index');
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
        return view('women-ombudsperson-violences.create', compact('departments', 'districts', 'months'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWomenOmbudspersonViolenceRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreWomenOmbudspersonViolenceRequest $request)
    {
        WomenOmbudspersonViolence::create($request->validated());
        return redirect()
            ->route('women-ombudsperson-violences.index')
            ->with('success_message', 'Violence Against Women has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WomenOmbudspersonViolence  $womenOmbudspersonViolence
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(WomenOmbudspersonViolence $womenOmbudspersonViolence)
    {
        $womenOmbudspersonViolence->load('department', 'district', 'month');
        return view('women-ombudsperson-violences.show',compact('womenOmbudspersonViolence'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WomenOmbudspersonViolence  $womenOmbudspersonViolence
     * @return \Illuminate\Http\Response
     */
    public function edit(WomenOmbudspersonViolence $womenOmbudspersonViolence)
    {
        $womenOmbudspersonViolence->load('department', 'district', 'month');
        $departments = Department::where('status', 1)->get();
        $districts = District::where('district_status', 1)->where('province_id',7)->get();
        $months = Month::all();
        return view('women-ombudsperson-violences.edit', compact('womenOmbudspersonViolence', 'departments', 'districts', 'months'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWomenOmbudspersonViolenceRequest  $request
     * @param  \App\Models\WomenOmbudspersonViolence  $womenOmbudspersonViolence
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateWomenOmbudspersonViolenceRequest $request, WomenOmbudspersonViolence $womenOmbudspersonViolence)
    {
        $womenOmbudspersonViolence->update($request->validated());
        return redirect()
            ->route('women-ombudsperson-violences.index')
            ->with('success_message', 'Violence Against Women has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WomenOmbudspersonViolence  $womenOmbudspersonViolence
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(WomenOmbudspersonViolence $womenOmbudspersonViolence)
    {
        $womenOmbudspersonViolence->update(['status'=>!$womenOmbudspersonViolence->status]);
        return redirect()
            ->route('women-ombudsperson-violences.index')
            ->with('success_message', 'Violence Against Women status has been changed successfully.');
    }
}
