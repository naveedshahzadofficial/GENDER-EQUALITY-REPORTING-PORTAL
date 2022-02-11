@extends('layouts.main')
@push('title', 'Violence Against Women')
@push('breadcrumb-items')
    <li class="breadcrumb-item">
        <a href="{{ route('women-ombudsperson-violences.index') }}" class="text-muted">Women Ombudsperson: Violence Against Women</a>
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
                    <div class="card card-custom gutter-b">
                        <div class="card-header">
                            <h3 class="card-title">Detail Violence Against Women</h3>

                        </div>
                        <div class="card-body">
                            <div class="row mt-10">
                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Department:</strong></div>
                                        <div
                                            class="col-md-6 value">{{ optional($womenOmbudspersonViolence->department)->department_name }}</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>District:</strong></div>
                                        <div
                                            class="col-md-6 value">{{ optional($womenOmbudspersonViolence->district)->district_name_e }}</div>
                                    </div>
                                </div>

                            </div>
                            <div class="row mt-10">

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Month:</strong></div>
                                        <div class="col-md-6 value">{{ optional($womenOmbudspersonViolence->month)->month_name }}</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Year:</strong></div>
                                        <div
                                            class="col-md-6 value">{{ $womenOmbudspersonViolence->year }}</div>
                                    </div>
                                </div>

                            </div>
                            <h4 class="mt-10 font-weight-bold section_heading">
                                <span>Complaints</span>
                            </h4>

                            <div class="row mt-10">

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Complaints Proceeding Initiated:</strong></div>
                                        <div class="col-md-6 value">{{ $womenOmbudspersonViolence->complaints_proceeding_initiated }}</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Complaints Disposed without Initiating Proceeding:</strong></div>
                                        <div
                                            class="col-md-6 value">{{ $womenOmbudspersonViolence->complaints_disposed_without_proceeding_initiated }}</div>
                                    </div>
                                </div>

                            </div>


                            <h4 class="mt-10 font-weight-bold section_heading">
                                <span>Cases</span>
                            </h4>


                            <div class="row mt-10">

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Total Case Completed:</strong></div>
                                        <div class="col-md-6 value">{{ $womenOmbudspersonViolence->total_cases_completed }}</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Total Cases in Progress:</strong></div>
                                        <div class="col-md-6 value">{{ $womenOmbudspersonViolence->total_cases_in_progress }}</div>
                                    </div>
                                </div>


                            </div>



                            <div class="row mt-10">
                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Status:</strong></div>
                                        <div
                                            class="col-md-6 value">{{ $womenOmbudspersonViolence->status?'Active':'Inactive' }}</div>
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

