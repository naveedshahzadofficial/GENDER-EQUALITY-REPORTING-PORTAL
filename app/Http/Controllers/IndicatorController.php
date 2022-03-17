<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIndicatorRequest;
use App\Http\Requests\UpdateIndicatorRequest;
use App\Models\Indicator;
use App\Models\Target;
use Yajra\DataTables\DataTables;

class IndicatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $query=Indicator::all();
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('target_value', function (Indicator $indicator) {
                    return optional($indicator->target)->target_value;
                })
                ->editColumn('status', function (Indicator $indicator) {
                    return '<span class="label label-lg font-weight-bold label-inline '.($indicator->status?'label-light-success':'label-light-danger').'">'.($indicator->status?'Active':'Inactive').'</span>';
                })
                ->addColumn('action', function(Indicator $indicator){
                    $actionBtn ='<a href="'.route('indicators.edit',$indicator).'" class="btn btn-icon btn-outline-danger btn-circle btn-xs mr-2" title="Update"> <i class="flaticon2-edit"></i> </a>';
                    $actionBtn .= '<a onclick="activate_inactive(this); return false;" href="' . route('indicators.destroy', $indicator) . '" class="btn btn-icon btn-circle btn-xs mr-2 btn-outline-danger" title="' . ($indicator->status == "0" ? 'Activate' : 'Deactivate') . '"> <i class="' . ($indicator->status ? 'icon-md fas fa-toggle-on' : 'icon-md fas fa-toggle-off') . '"></i> </a>';
                    return $actionBtn;
                })
                ->rawColumns(['target_value','status', 'action'])
                ->make(true);
        }
        return view('indicators.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $targets = Target::where('status', 'Active')->orderBy('order_no')->get();
        return view('indicators.create', compact('targets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreIndicatorRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreIndicatorRequest $request)
    {
        $data = $request->validated();
        Indicator::create($data);
        return redirect()
            ->route('indicators.index')
            ->with('success_message', 'Indicator has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Indicator  $indicator
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Indicator $indicator)
    {
        return view('indicators.show',compact('indicator'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Indicator  $indicator
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Indicator $indicator)
    {
        $targets = Target::where('status', 'Active')->orderBy('order_no')->get();
        return view('indicators.edit',compact('indicator', 'targets'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIndicatorRequest  $request
     * @param  \App\Models\Indicator  $indicator
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateIndicatorRequest $request, Indicator $indicator)
    {
        $data = $request->validated();
        $indicator->update($data);
        return redirect()
            ->route('indicators.index')
            ->with('success_message', 'Indicator has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Indicator  $indicator
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Indicator $indicator)
    {
        $indicator->update(['status'=>!$indicator->status]);
        return redirect()
            ->route('indicators.index')
            ->with('success_message', 'Indicator status has been changed successfully.');

    }
}
