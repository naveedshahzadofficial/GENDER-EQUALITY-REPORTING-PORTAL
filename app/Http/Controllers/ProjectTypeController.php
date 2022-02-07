<?php

namespace App\Http\Controllers;

use App\Models\ProjectType;
use App\Http\Requests\StoreProjectTypeRequest;
use App\Http\Requests\UpdateProjectTypeRequest;
use App\Models\Target;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ProjectTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $query=ProjectType::all();
            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('status', function (ProjectType $projectType) {
                    return '<span class="label label-lg font-weight-bold label-inline '.($projectType->status == "Active"?'label-light-success':'label-light-danger').'">'.($projectType->status).'</span>';
                })
                ->addColumn('action', function(ProjectType $projectType){
                    $actionBtn ='<a href="'.route('project-types.edit',$projectType).'" class="btn btn-icon btn-outline-danger btn-circle btn-xs mr-2" title="Update"> <i class="flaticon2-edit"></i> </a>';
                    $actionBtn .= '<a onclick="activate_inactive(this); return false;" href="' . route('project-types.destroy', $projectType) . '" class="btn btn-icon btn-circle btn-xs mr-2 btn-outline-danger" title="' . ($projectType->status == "Inactive" ? 'Activate' : 'Deactivate') . '"> <i class="' . ($projectType->status=='Active' ? 'icon-md fas fa-toggle-on' : 'icon-md fas fa-toggle-off') . '"></i> </a>';
                    return $actionBtn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('project-types.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('project-types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectTypeRequest $request)
    {
        $data = $request->validated();
        $data['status'] = "Active";
        ProjectType::create($data);
        return redirect()
            ->route('project-types.index')
            ->with('success_message', 'Project type has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectType  $projectType
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectType $projectType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectType  $projectType
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectType $projectType)
    {
        return view('project-types.edit',compact('projectType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectTypeRequest  $request
     * @param  \App\Models\ProjectType  $projectType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectTypeRequest $request, ProjectType $projectType)
    {
        $data = $request->validated();
        $projectType->update($data);
        return redirect()
            ->route('project-types.index')
            ->with('success_message', 'Project type has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectType  $projectType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectType $projectType)
    {
        if($projectType->status == "Active"){
            $selected_status = "Inactive";
        }else{
            $selected_status = "Active";
        }
        $projectType->update(['status'=>$selected_status]);
        return redirect()
            ->route('project-types.index')
            ->with('success_message', 'Project type status has been changed successfully.');
    }
}
