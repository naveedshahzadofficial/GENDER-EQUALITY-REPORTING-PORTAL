@extends('layouts.main')
@push('title', 'Detail Voluntary National Report')
@push('breadcrumb-items')
    <li class="breadcrumb-item">
        <a href="{{ route('voluntary-national-report.index') }}" class="text-muted">Voluntary National Report</a>
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
                    <div class="card card-custom gutter-b  example-compact">
                        <div class="card-header">
                            <h3 class="card-title">Detail Voluntary National Report</h3>

                        </div>
                        <div class="card-body">
                            <div class="row mt-10">
                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Department:</strong></div>
                                        <div
                                            class="col-md-6 value">{{ $voluntaryNationalReport->department->department_name }}</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Target:</strong></div>
                                        <div
                                            class="col-md-6 value">{{ $voluntaryNationalReport->target->target_value }}</div>
                                    </div>
                                </div>

                            </div>
                            <div class="row mt-10">
                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Policies/Projects:</strong></div>
                                        <div class="col-md-6 value">{{ optional($voluntaryNationalReport->project)->project_title }}</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Project Type:</strong></div>
                                        <div class="col-md-6 value">{{ optional($voluntaryNationalReport->projectType)->project_type_title }}</div>
                                    </div>
                                </div>

                            </div>

                            <div class="row mt-10">
                            <div class="col-md-6">
                                <div class="static-info row">
                                    <div class="col-md-6 name"><strong>Start Date:</strong></div>
                                    <div class="col-md-6 value">{{ $voluntaryNationalReport->start_date }}</div>
                                </div>
                            </div>

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>End Date:</strong></div>
                                        <div class="col-md-6 value">{{ $voluntaryNationalReport->end_date }}</div>
                                    </div>
                                </div>

                            </div>

                            <div class="row mt-10">
                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Achievement So Far:</strong></div>
                                        <div class="col-md-6 value">{{ $voluntaryNationalReport->achievements }}</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Challenges:</strong></div>
                                        <div class="col-md-6 value">{{ $voluntaryNationalReport->challenges }}</div>
                                    </div>
                                </div>

                            </div>
                            <div class="row mt-10">
                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Action Taken:</strong></div>
                                        <div class="col-md-6 value">{{ $voluntaryNationalReport->action_taken }}</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Way Forward:</strong></div>
                                        <div class="col-md-6 value">{{ $voluntaryNationalReport->way_forward }}</div>
                                    </div>
                                </div>

                            </div>
                            <div class="row mt-10">
                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Partnership:</strong></div>
                                        <div class="col-md-6 value">{{ $voluntaryNationalReport->partnership }}</div>
                                    </div>
                                </div>


                            </div>




                            <div class="row mt-10">
                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Attachment:</strong></div>
                                        <div class="col-md-6 value"> @if(!empty($voluntaryNationalReport->attachment))&nbsp;<a href="{{ Storage::url($voluntaryNationalReport->attachment) }}" target="_blank">View File</a> @endif</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Status:</strong></div>
                                        <div
                                            class="col-md-6 value">{{ $voluntaryNationalReport->status }}</div>
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

