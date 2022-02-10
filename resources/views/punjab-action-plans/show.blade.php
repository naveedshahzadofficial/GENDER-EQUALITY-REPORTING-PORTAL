@extends('layouts.main')
@push('title', 'Punjab Action Plan')
@push('breadcrumb-items')
    <li class="breadcrumb-item">
        <a href="{{ route('punjab-action-plans.index') }}" class="text-muted">Punjab Action Plan</a>
    </li>
    <li class="breadcrumb-item">
        <a class="text-muted">Detail</a>
    </li>
@endpush
@section('content')
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="">
                <div class="">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">Detail Punjab Action Plan</h3>

                        </div>
                        <div class="card-body">
                            <div class="row mt-10">
                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Department:</strong></div>
                                        <div
                                            class="col-md-6 value">{{ optional($punjabActionPlan->department)->department_name }}</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Year:</strong></div>
                                        <div
                                            class="col-md-6 value">{{ $punjabActionPlan->year }}</div>
                                    </div>
                                </div>

                            </div>
                            <div class="row mt-10">
                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Target:</strong></div>
                                        <div class="col-md-6 value">{{ optional($punjabActionPlan->target)->target_value }}</div>
                                    </div>
                                </div>

                                 <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Indicator:</strong></div>
                                        <div class="col-md-6 value">{{ optional($punjabActionPlan->indicator)->indicator_title }}</div>
                                    </div>
                                </div>

                            </div>


                            <div class="row mt-10">

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>File Attachment (Indicator Framework):</strong></div>
                                        <div class="col-md-6 value"> @if(!empty($punjabActionPlan->indicator_framework_file))&nbsp;<a href="{{ \Illuminate\Support\Facades\Storage::url($punjabActionPlan->indicator_framework_file) }}" target="_blank">View File</a> @endif</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Baseline:</strong></div>
                                        <div class="col-md-6 value">{{ $punjabActionPlan->baseline }}</div>
                                    </div>
                                </div>

                            </div>

                            <div class="row mt-10">

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Reporting Agency:</strong></div>
                                        <div class="col-md-6 value">{{ $punjabActionPlan->reporting_agency }}</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Implementation Responsibility:</strong></div>
                                        <div class="col-md-6 value">{{ $punjabActionPlan->implementation_responsibility }}</div>
                                    </div>
                                </div>

                            </div>

                            <h4 class="mt-10 font-weight-bold section_heading">
                                <span>Target Reform Action Plan</span>
                            </h4>

                            <div class="row mt-10">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Defining Action</th>
                                            <th class="text-center">Defining Date</th>
                                            <th class="text-center">Progress Status</th>
                                        </tr>
                                        </thead>
                                        <tbody id="budget-table-data">
                                        @foreach($punjabActionPlan->targetReforms as $target_reform)
                                            <tr>
                                                <td class="text-center"><div class="value">{{ $target_reform->defining_action }}</div></td>
                                                <td class="text-center"><div class="value">{{ $target_reform->defining_date }}</div></td>
                                                <td class="text-center"><div class="value">{{ $target_reform->progress_status }}</div></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>


                            <div class="row mt-10">
                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Status:</strong></div>
                                        <div
                                            class="col-md-6 value">{{ $punjabActionPlan->status?'Active':'Inactive' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->

@endsection

