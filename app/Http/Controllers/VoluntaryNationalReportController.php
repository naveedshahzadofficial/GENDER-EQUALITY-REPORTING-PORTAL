<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Project;
use App\Models\Target;
use App\Models\VoluntaryNationalReport;
use App\Http\Requests\StoreVoluntaryNationalReportRequest;
use App\Http\Requests\UpdateVoluntaryNationalReportRequest;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class VoluntaryNationalReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $query=VoluntaryNationalReport::with('User','Department', 'Target', 'project');
            if(auth()->user()->isDepartment()){
                $query->where('department_id', auth()->user()->department_id);
            }
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('username', function (VoluntaryNationalReport $voluntaryNationalReport) {
                    return optional($voluntaryNationalReport->user)->name;
                })
                ->addColumn('department_name', function (VoluntaryNationalReport $voluntaryNationalReport) {
                    return optional($voluntaryNationalReport->department)->department_name;
                })
                ->addColumn('target_value', function (VoluntaryNationalReport $voluntaryNationalReport) {
                    return optional($voluntaryNationalReport->target)->target_value;
                })
                ->addColumn('project_title', function (VoluntaryNationalReport $voluntaryNationalReport) {
                    return optional($voluntaryNationalReport->project)->project_title;
                })
                ->editColumn('attachment', function (VoluntaryNationalReport $voluntaryNationalReport) {
                    return '<a target="_blank" href="'.Storage::url($voluntaryNationalReport->attachment).'" title="Attachment" class="btn btn-icon btn-outline-danger btn-circle btn-sm"/><i class="flaticon2-download"></i></a>';
                })
                ->editColumn('status', function (VoluntaryNationalReport $voluntaryNationalReport) {
                    return '<span class="label label-lg font-weight-bold label-inline '.($voluntaryNationalReport->status == "Active"?'label-light-success':'label-light-danger').'">'.($voluntaryNationalReport->status).'</span>';
                })
                ->addColumn('action', function(VoluntaryNationalReport $voluntaryNationalReport){
                    $actionBtn = '<a target="_blank" href="' . route('voluntary-national-report.show', $voluntaryNationalReport) . '" class="btn btn-icon btn-circle btn-xs mr-2 btn-outline-danger" title="Detail"> <i class="icon-md fas fa-eye"></i> </a>';
                    if (auth()->user()->isDepartment()) {
                        $actionBtn .='<a href="'.route('voluntary-national-report.edit',$voluntaryNationalReport).'" class="btn btn-icon btn-outline-danger btn-circle btn-xs mr-2" title="Update"> <i class="flaticon2-edit"></i> </a>';
                        $actionBtn .= '<a onclick="activate_inactive(this); return false;" href="' . route('voluntary-national-report.destroy', $voluntaryNationalReport) . '" class="btn btn-icon btn-circle btn-xs mr-2 btn-outline-danger" title="' . ($voluntaryNationalReport->status == "Inactive" ? 'Activate' : 'Deactivate') . '"> <i class="' . ($voluntaryNationalReport->status=='Active' ? 'icon-md fas fa-toggle-on' : 'icon-md fas fa-toggle-off') . '"></i> </a>';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['project_title','username', 'department_name', 'target_value', 'attachment', 'status', 'action'])
                ->make(true);
        }
        return view('voluntary-national-report.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::where('status', 1)->get(['id', 'department_name']);
        $targets = Target::where('status', 'Active')->get(['id', 'target_value']);
        $projects = Project::where('status', 'Active')->when(auth()->user()->isDepartment(), function($query){
            return $query->where('department_id', auth()->user()->department_id);
        })->get();
        return view('voluntary-national-report.create', compact('departments','targets', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVoluntaryNationalReportRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVoluntaryNationalReportRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $data['attachment'] = $file->store('voluntary-national-report', 'public');
        }
        $data['status'] = "Active";
        VoluntaryNationalReport::create($data);
        return redirect()
            ->route('voluntary-national-report.index')
            ->with('success_message', 'Voluntary national report has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VoluntaryNationalReport  $voluntaryNationalReport
     * @return \Illuminate\Http\Response
     */
    public function show(VoluntaryNationalReport $voluntaryNationalReport)
    {
        $voluntaryNationalReport->load('user');
        return view('voluntary-national-report.show',compact('voluntaryNationalReport'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VoluntaryNationalReport  $voluntaryNationalReport
     * @return \Illuminate\Http\Response
     */
    public function edit(VoluntaryNationalReport $voluntaryNationalReport)
    {
        $departments = Department::where('status', 1)->get(['id', 'department_name']);
        $targets = Target::where('status', 'Active')->get(['id', 'target_value']);
        $projects = Project::where('status', 'Active')->when(auth()->user()->isDepartment(), function($query){
            return $query->where('department_id', auth()->user()->department_id);
        })->get();
        return view('voluntary-national-report.edit',compact('departments','targets','voluntaryNationalReport', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVoluntaryNationalReportRequest  $request
     * @param  \App\Models\VoluntaryNationalReport  $voluntaryNationalReport
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVoluntaryNationalReportRequest $request, VoluntaryNationalReport $voluntaryNationalReport)
    {
        $data = $request->validated();
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $data['attachment'] = $file->store('voluntary-national-report', 'public');
        }
        $voluntaryNationalReport->update($data);
        return redirect()
            ->route('voluntary-national-report.index')
            ->with('success_message', 'Voluntary national report has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VoluntaryNationalReport  $voluntaryNationalReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(VoluntaryNationalReport $voluntaryNationalReport)
    {
        if($voluntaryNationalReport->status == "Active"){
            $selected_status = "Inactive";
        }else{
            $selected_status = "Active";
        }
        $voluntaryNationalReport->update(['status'=>$selected_status]);
        return redirect()
            ->route('voluntary-national-report.index')
            ->with('success_message', 'Voluntary national report status has been changed successfully.');
    }
}
