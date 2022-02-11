@extends('layouts.main')
@push('title', 'Violence Against Women')
@push('breadcrumb-items')
    <li class="breadcrumb-item">
        <a href="{{ route('police-department-violences.index') }}" class="text-muted">Federal Investigation Agency: Violence Against Women</a>
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
                                            class="col-md-6 value">{{ optional($federalAgencyViolence->department)->department_name }}</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>District:</strong></div>
                                        <div
                                            class="col-md-6 value">{{ optional($federalAgencyViolence->district)->district_name_e }}</div>
                                    </div>
                                </div>

                            </div>
                            <div class="row mt-10">

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Month:</strong></div>
                                        <div class="col-md-6 value">{{ optional($federalAgencyViolence->month)->month_name }}</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Year:</strong></div>
                                        <div
                                            class="col-md-6 value">{{ $federalAgencyViolence->year }}</div>
                                    </div>
                                </div>

                            </div>
                            <h4 class="mt-10 font-weight-bold section_heading">
                                <span>Complaints</span>
                            </h4>

                            <div class="row mt-10">

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Total Complaints:</strong></div>
                                        <div class="col-md-6 value">{{ $federalAgencyViolence->total_complaints }}</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Converted to FIR:</strong></div>
                                        <div
                                            class="col-md-6 value">{{ $federalAgencyViolence->complaints_converted_to_fir }}</div>
                                    </div>
                                </div>

                            </div>


                            <div class="row mt-10">

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Complaints Disposed without FIR:</strong></div>
                                        <div class="col-md-6 value">{{ $federalAgencyViolence->complaints_disposed_without_fir }}</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Complaints In Process:</strong></div>
                                        <div
                                            class="col-md-6 value">{{ $federalAgencyViolence->complaints_in_process }}</div>
                                    </div>
                                </div>

                            </div>

                            <h4 class="mt-10 font-weight-bold section_heading">
                                <span>Cases</span>
                            </h4>


                            <div class="row mt-10">

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Case Completed:</strong></div>
                                        <div class="col-md-6 value">{{ $federalAgencyViolence->case_completed }}</div>
                                    </div>
                                </div>


                            </div>



                            <div class="row mt-10">
                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Status:</strong></div>
                                        <div
                                            class="col-md-6 value">{{ $federalAgencyViolence->status?'Active':'Inactive' }}</div>
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

