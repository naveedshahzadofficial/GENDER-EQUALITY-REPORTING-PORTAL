<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnnualDevelopmentProjectRequest;
use App\Http\Requests\UpdateAnnualDevelopmentProjectRequest;
use App\Models\AnnualDevelopmentProject;
use App\Models\Department;
use App\Models\Project;
use App\Models\ProjectProgressReport;
use App\Models\ProjectType;
use App\Models\Target;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class AnnualDevelopmentProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $query=AnnualDevelopmentProject::with('department', 'project', 'projectType');
            if(auth()->user()->isDepartment()){
                $query->where('department_id', auth()->user()->department_id);
            }
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('department_name', function (AnnualDevelopmentProject $annualDevelopmentProject) {
                    return optional($annualDevelopmentProject->department)->department_name;
                })
                ->addColumn('project_title', function (AnnualDevelopmentProject $annualDevelopmentProject) {
                    return optional($annualDevelopmentProject->project)->project_title;
                })
                ->addColumn('project_type_title', function (AnnualDevelopmentProject $annualDevelopmentProject) {
                    return optional($annualDevelopmentProject->projectType)->project_type_title;
                })
                ->addColumn('target_value', function (AnnualDevelopmentProject $annualDevelopmentProject) {
                    return optional($annualDevelopmentProject->target)->target_value;
                })
                ->editColumn('project_document_file', function (AnnualDevelopmentProject $annualDevelopmentProject) {
                    return '<a target="_blank" href="'.Storage::url($annualDevelopmentProject->project_document_file).'" title="Attachment" class="btn btn-icon btn-outline-danger btn-circle btn-sm"/><i class="flaticon2-download"></i></a>';
                })
                ->editColumn('status', function (AnnualDevelopmentProject $annualDevelopmentProject) {
                    return '<span class="label label-lg font-weight-bold label-inline '.($annualDevelopmentProject->status == '1'?'label-light-success':'label-light-danger').'">'.($annualDevelopmentProject->status?'Active':'Inactive').'</span>';
                })
                ->addColumn('action', function(AnnualDevelopmentProject $annualDevelopmentProject){
                    $actionBtn = '<a target="_blank" href="' . route('annual-development-projects.show', $annualDevelopmentProject) . '" class="btn btn-icon btn-circle btn-xs mr-2 btn-outline-danger" title="Detail"> <i class="icon-md fas fa-eye"></i> </a>';
                    if (auth()->user()->isDepartment()) {
                        $actionBtn .='<a href="'.route('annual-development-projects.edit',$annualDevelopmentProject).'" class="btn btn-icon btn-outline-danger btn-circle btn-xs mr-2" title="Update"> <i class="flaticon2-edit"></i> </a>';
                        $actionBtn .= '<a onclick="activate_inactive(this); return false;" href="' . route('annual-development-projects.destroy', $annualDevelopmentProject) . '" class="btn btn-icon btn-circle btn-xs mr-2 btn-outline-danger" title="' . ($annualDevelopmentProject->status? 'Deactivate' : 'Activate') . '"> <i class="' . ($annualDevelopmentProject->status ? 'icon-md fas fa-toggle-on' : 'icon-md fas fa-toggle-off') . '"></i> </a>';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['department_name', 'project_title', 'project_type_title','target_value', 'project_document_file', 'status', 'action'])
                ->make(true);
        }

        return view('annual-development-projects.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::where('status', 1)->get(['id', 'department_name']);
        $projects = Project::where('status', 'Active')->when(auth()->user()->isDepartment(), function($query){
            return $query->where('department_id', auth()->user()->department_id);
        })->get();
        $project_types = ProjectType::where('status', 1)->get();
        $targets = Target::where('status', 'Active')->get();
        return view('annual-development-projects.create', compact('departments', 'projects', 'project_types', 'targets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAnnualDevelopmentProjectRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreAnnualDevelopmentProjectRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('project_document_file')) {
            $file = $request->file('project_document_file');
            $data['project_document_file'] = $file->store('project_documents', 'public');
        }
        $annualDevelopmentProject = AnnualDevelopmentProject::create($data);

        if(isset($data['project_budgets']) && !empty($data['project_budgets']))
            $annualDevelopmentProject->projectBudgets()->createMany($data['project_budgets']);

        $progress_reports = array();
        if(isset($data['progress_reports']) && !empty($data['progress_reports'])){
            foreach ($data['progress_reports'] as $index => $progress_report) {
                if ($request->hasFile("progress_reports.$index.progress_report_file")) {
                    $file = $request->file("progress_reports.$index.progress_report_file");
                    $progress_report['progress_report_file'] = $file->store('progress_reports', 'public');
                }
                array_push($progress_reports, new ProjectProgressReport($progress_report));
            }
        }

        if (count($progress_reports) > 0)
            $annualDevelopmentProject->projectProgressReport()->saveMany($progress_reports);

        return redirect()
            ->route('annual-development-projects.index')
            ->with('success_message', 'Annual development project has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AnnualDevelopmentProject  $annualDevelopmentProject
     * @return \Illuminate\Http\Response
     */
    public function show(AnnualDevelopmentProject $annualDevelopmentProject)
    {
        $annualDevelopmentProject->load('department', 'project', 'projectType', 'target', 'projectBudgets', 'projectProgressReport');
        return view('annual-development-projects.show',compact('annualDevelopmentProject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AnnualDevelopmentProject  $annualDevelopmentProject
     * @return \Illuminate\Http\Response
     */
    public function edit(AnnualDevelopmentProject $annualDevelopmentProject)
    {
        $annualDevelopmentProject->load('projectBudgets', 'projectProgressReport');
        $departments = Department::where('status', 1)->get(['id', 'department_name']);
        $projects = Project::where('status', 'Active')->when(auth()->user()->isDepartment(), function($query){
            return $query->where('department_id', auth()->user()->department_id);
        })->get();
        $project_types = ProjectType::where('status', 'Active')->get();
        $targets = Target::where('status', 'Active')->get();
        return view('annual-development-projects.edit', compact('departments', 'projects', 'project_types', 'annualDevelopmentProject', 'targets'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAnnualDevelopmentProjectRequest  $request
     * @param  \App\Models\AnnualDevelopmentProject  $annualDevelopmentProject
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateAnnualDevelopmentProjectRequest $request, AnnualDevelopmentProject $annualDevelopmentProject)
    {
        $data = $request->validated();
        if ($request->hasFile('project_document_file')) {
            $file = $request->file('project_document_file');
            $data['project_document_file'] = $file->store('project_documents', 'public');
        }

        $annualDevelopmentProject->update($data);

        if ($annualDevelopmentProject->projectBudgets->isNotEmpty())
            $annualDevelopmentProject->projectBudgets()->delete();

        if(isset($request->project_budgets) && !empty($request->project_budgets))
            $annualDevelopmentProject->projectBudgets()->createMany($request->project_budgets);

        $progress_reports = array();
        if(isset($request->progress_reports) && !empty($request->progress_reports)){
            foreach ($request->progress_reports as $index => $progress_report) {
                if ($request->hasFile("progress_reports.$index.progress_report_file")) {
                    $file = $request->file("progress_reports.$index.progress_report_file");
                    $progress_report['progress_report_file'] = $file->store('progress_reports', 'public');
                }else if(isset($progress_report['old_progress_report_file']) && !empty($progress_report['old_progress_report_file'])){
                    $progress_report['progress_report_file'] = $progress_report['old_progress_report_file'];
                }
                array_push($progress_reports, new ProjectProgressReport($progress_report));
            }
        }

        if ($annualDevelopmentProject->projectProgressReport->isNotEmpty())
            $annualDevelopmentProject->projectProgressReport()->delete();

        if (count($progress_reports) > 0)
            $annualDevelopmentProject->projectProgressReport()->saveMany($progress_reports);


        return redirect()
            ->route('annual-development-projects.index')
            ->with('success_message', 'Annual development project has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AnnualDevelopmentProject  $annualDevelopmentProject
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(AnnualDevelopmentProject $annualDevelopmentProject)
    {
        $annualDevelopmentProject->update(['status'=>!$annualDevelopmentProject->status]);
        return redirect()
            ->route('annual-development-projects.index')
            ->with('success_message', 'Annual development project status has been changed successfully.');
    }

    public function findProject(Request $request){
        $project = Project::find($request->project_id);
        $data = new \stdClass;
        if($project) {
            $data->status = true;
            $data->project_start_date = Carbon::parse($project->project_start_date)->format('d-m-Y');
            $data->project_end_date = Carbon::parse($project->project_end_date)->format('d-m-Y');

            $start_date = Carbon::parse($project->project_start_date);
            $end_date = Carbon::parse($project->project_end_date);
            $diffYear = $start_date->diffInYears($end_date);
            $start_year = $start_date->format('Y');
            $start_month = $start_date->format('m');
            $end_year = $end_date->format('Y');
            $end_month = $end_date->format('m');
            $years = array();
            $year_index = 0;
            $diffYear = $end_month>6?$diffYear+2:$diffYear+1;

            for ($i=1; $i<=$diffYear; $i++){
                $year = new \stdClass;
                if($start_month>6){
                    $year->index = $year_index;
                    $year->name = ($start_year)."-".($start_year+1);
                    array_push($years, $year);
                    $year_index++;
                }else{
                    $year->index = $year_index;
                    $year->name = ($start_year-1)."-".($start_year);
                    array_push($years, $year);
                    $year_index++;
                }
                $start_year++;
            }

            $data->years = $years;


        }else{
            $data->status = false;
            $data->years = [];
        }
        return response()->json($data);
    }
}
