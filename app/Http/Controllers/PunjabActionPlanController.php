<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePunjabActionPlanRequest;
use App\Http\Requests\UpdatePunjabActionPlanRequest;
use App\Models\Department;
use App\Models\Indicator;
use App\Models\PunjabActionPlan;
use App\Models\Target;
use Yajra\DataTables\DataTables;

class PunjabActionPlanController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $query = PunjabActionPlan::with('department', 'target', 'indicator');
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('department_name', function (PunjabActionPlan $punjabActionPlan) {
                    return optional($punjabActionPlan->department)->department_name;
                })
                ->addColumn('target_value', function (PunjabActionPlan $punjabActionPlan) {
                    return optional($punjabActionPlan->target)->target_value;
                })
                ->addColumn('indicator_title', function (PunjabActionPlan $punjabActionPlan) {
                    return optional($punjabActionPlan->indicator)->indicator_title;
                })
                ->editColumn('status', function (PunjabActionPlan $punjabActionPlan) {
                    return '<span class="label label-lg font-weight-bold label-inline '.($punjabActionPlan->status?'label-light-success':'label-light-danger').'">'.($punjabActionPlan->status?'Active':'Inactive').'</span>';
                })
                ->addColumn('action', function(PunjabActionPlan $punjabActionPlan){
                    $actionBtn = '<a target="_blank" href="' . route('punjab-action-plans.show', $punjabActionPlan) . '" class="btn btn-icon btn-circle btn-xs mr-2 btn-outline-danger" title="Detail"> <i class="icon-md fas fa-eye"></i> </a>';
                    $actionBtn .='<a href="'.route('punjab-action-plans.edit',$punjabActionPlan).'" class="btn btn-icon btn-outline-danger btn-circle btn-xs mr-2" title="Update"> <i class="flaticon2-edit"></i> </a>';
                    $actionBtn .= '<a onclick="activate_inactive(this); return false;" href="' . route('punjab-action-plans.destroy', $punjabActionPlan) . '" class="btn btn-icon btn-circle btn-xs mr-2 btn-outline-danger" title="' . ($punjabActionPlan->status? 'Deactivate' : 'Activate') . '"> <i class="' . ($punjabActionPlan->status ? 'icon-md fas fa-toggle-on' : 'icon-md fas fa-toggle-off') . '"></i> </a>';
                    return $actionBtn;
                })
                ->rawColumns(['department_name','target_value','indicator_title','status', 'action'])
                ->make(true);
        }
        return view('punjab-action-plans.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::where('status', 1)->get();
        $targets = Target::where('status', 'Active')->get();
        $indicators = Indicator::where('status', 1)->get();
        $progress_status = ['Not Started', 'In Progress', 'Completed'];
        return view('punjab-action-plans.create', compact('departments','targets', 'indicators', 'progress_status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePunjabActionPlanRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePunjabActionPlanRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('indicator_framework_file')) {
            $file = $request->file('indicator_framework_file');
            $data['indicator_framework_file'] = $file->store('indicator_framework', 'public');
        }
        $punjabActionPlan = PunjabActionPlan::create($data);

        if(isset($request->target_reforms) && !empty($request->target_reforms))
            $punjabActionPlan->targetReforms()->createMany($request->target_reforms);

        return redirect()
            ->route('punjab-action-plans.index')
            ->with('success_message', 'Punjab Action Plan has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PunjabActionPlan  $punjabActionPlan
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(PunjabActionPlan $punjabActionPlan)
    {
        $punjabActionPlan->load('department', 'target', 'indicator', 'targetReforms');
        return view('punjab-action-plans.show',compact('punjabActionPlan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PunjabActionPlan  $punjabActionPlan
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(PunjabActionPlan $punjabActionPlan)
    {
        $punjabActionPlan->load('targetReforms');
        $departments = Department::where('status', 1)->get();
        $targets = Target::where('status', 'Active')->get();
        $indicators = Indicator::where('status', 1)->get();
        $progress_status = ['Not Started', 'In Progress', 'Completed'];
        return view('punjab-action-plans.edit', compact('punjabActionPlan', 'departments', 'targets', 'indicators', 'progress_status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePunjabActionPlanRequest  $request
     * @param  \App\Models\PunjabActionPlan  $punjabActionPlan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePunjabActionPlanRequest $request, PunjabActionPlan $punjabActionPlan)
    {
        $data = $request->validated();
        if ($request->hasFile('indicator_framework_file')) {
            $file = $request->file('indicator_framework_file');
            $data['indicator_framework_file'] = $file->store('indicator_framework', 'public');
        }
        $punjabActionPlan->update($data);

        if ($punjabActionPlan->targetReforms->isNotEmpty())
            $punjabActionPlan->targetReforms()->delete();

        if(isset($request->target_reforms) && !empty($request->target_reforms))
            $punjabActionPlan->targetReforms()->createMany($request->target_reforms);

        return redirect()
            ->route('punjab-action-plans.index')
            ->with('success_message', 'Punjab Action Plan has been updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PunjabActionPlan  $punjabActionPlan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(PunjabActionPlan $punjabActionPlan)
    {
        $punjabActionPlan->update(['status'=>!$punjabActionPlan->status]);
        return redirect()
            ->route('punjab-action-plans.index')
            ->with('success_message', 'Punjab Action Plan status has been changed successfully.');

    }
}
