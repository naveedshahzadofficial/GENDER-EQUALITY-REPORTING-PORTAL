<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\ProjectType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $query=Project::with('projectType');
            if(auth()->user()->isDepartment()){
                $query->where('department_id', auth()->user()->department_id);
            }
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('department_name', function (Project $project) {
                    return optional($project->department)->department_name;
                })
                ->addColumn('project_type_title', function (Project $project) {
                    return optional($project->projectType)->project_type_title;
                })
                ->editColumn('status', function (Project $project) {
                    return '<span class="label label-lg font-weight-bold label-inline '.($project->status == "Active"?'label-light-success':'label-light-danger').'">'.($project->status).'</span>';
                })
                ->addColumn('action', function(Project $project){
                        $actionBtn ='<a href="'.route('projects.edit',$project).'" class="btn btn-icon btn-outline-danger btn-circle btn-xs mr-2" title="Update"> <i class="flaticon2-edit"></i> </a>';
                        $actionBtn .= '<a onclick="activate_inactive(this); return false;" href="' . route('projects.destroy', $project) . '" class="btn btn-icon btn-circle btn-xs mr-2 btn-outline-danger" title="' . ($project->status == "Inactive" ? 'Activate' : 'Deactivate') . '"> <i class="' . ($project->status=='Active' ? 'icon-md fas fa-toggle-on' : 'icon-md fas fa-toggle-off') . '"></i> </a>';
                    return $actionBtn;
                })
                ->rawColumns(['project_type_title', 'status', 'action'])
                ->make(true);
        }
        return view('projects.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project_types = ProjectType::where('status', 1)->get();
//        $departments = Department::where('status', 1)->get();
        $departments = Department::where('status', 1)->get();
        return view('projects.create', compact('project_types', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();
        $data['status'] = "Active";
        Project::create($data);
        return redirect()
            ->route('projects.index')
            ->with('success_message', 'Project has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $project_types = ProjectType::where('status', 1)->get();
        $departments = Department::where('status', 1)->get();
        return view('projects.edit',compact('project', 'project_types', 'departments'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->validated();
        $project->update($data);
        return redirect()
            ->route('projects.index')
            ->with('success_message', 'Project has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if($project->status == "Active"){
            $selected_status = "Inactive";
        }else{
            $selected_status = "Active";
        }
        $project->update(['status'=>$selected_status]);
        return redirect()
            ->route('projects.index')
            ->with('success_message', 'Project status has been changed successfully.');
    }

    public function getProject(Request $request){
        $project = Project::findorFail($request->project_id);
        return response()->json($project);
    }
}
