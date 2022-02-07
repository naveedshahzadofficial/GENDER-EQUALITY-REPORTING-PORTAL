@extends('layouts.main')
@push('title', 'Gender Segregation Budgeting')
@push('breadcrumb-items')
    <li class="breadcrumb-item">
        <a href="{{ route('annual-development-projects.index') }}" class="text-muted">Gender Segregation Budgeting</a>
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
                            <h3 class="card-title">Detail Gender Segregation Budgeting</h3>

                        </div>
                        <div class="card-body">
                            <div class="row mt-10">
                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Department:</strong></div>
                                        <div
                                            class="col-md-6 value">{{ optional($annualDevelopmentProject->department)->department_name }}</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Project:</strong></div>
                                        <div
                                            class="col-md-6 value">{{ optional($annualDevelopmentProject->project)->project_title }}</div>
                                    </div>
                                </div>

                            </div>
                            <div class="row mt-10">
                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Project Type:</strong></div>
                                        <div class="col-md-6 value">{{ optional($annualDevelopmentProject->projectType)->project_type_title }}</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Project Document Attachment:</strong></div>
                                        <div class="col-md-6 value"> @if(!empty($annualDevelopmentProject->project_document_file))&nbsp;<a href="{{ Storage::url($annualDevelopmentProject->project_document_file) }}" target="_blank">View File</a> @endif</div>
                                    </div>
                                </div>


                            </div>

                            <div class="row mt-10">

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Total Approved Budget (Million):</strong></div>
                                        <div class="col-md-6 value">{{ $annualDevelopmentProject->total_approved_budget }}</div>
                                    </div>
                                </div>

                            </div>

                            <div class="row mt-10">

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Project Start Date:</strong></div>
                                        <div class="col-md-6 value">{{ $annualDevelopmentProject->project_start_date }}</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Project End Date:</strong></div>
                                        <div class="col-md-6 value">{{ $annualDevelopmentProject->project_end_date }}</div>
                                    </div>
                                </div>

                            </div>

                            <h4 class="mt-10 font-weight-bold section_heading">
                                <span>Budget</span>
                            </h4>

                            <div class="row mt-10">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Fiscal Year</th>
                                            <th class="text-center">Allocation</th>
                                            <th class="text-center">Utilization</th>
                                        </tr>
                                        </thead>
                                        <tbody id="budget-table-data">
                                        @foreach($annualDevelopmentProject->projectBudgets as $project_budget)
                                            <tr>
                                                <td class="text-center"><div class="value">{{ $project_budget->fiscal_year }}</div></td>
                                                <td class="text-center"><div class="value">{{ $project_budget->budget_allocation }}</div></td>
                                                <td class="text-center"><div class="value">{{ $project_budget->budget_utilization }}</div></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>


                            <div class="row mt-10">

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Total Expenditure:</strong></div>
                                        <div class="col-md-6 value">{{ $annualDevelopmentProject->total_expenditure }}</div>
                                    </div>
                                </div>

                            </div>

                            <div class="row mt-10">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th class="text-center">Progress Report</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($annualDevelopmentProject->projectProgressReport as $progress_report)
                                        <tr>
                                            <td class="text-center"><div class="value">{{ $loop->iteration }}</div></td>
                                            <td class="text-center"><div class="value">@if(!empty($progress_report->progress_report_file))&nbsp;<a href="{{ \Illuminate\Support\Facades\Storage::url($progress_report->progress_report_file) }}" target="_blank">View File</a> @endif</div></td>
                                        </tr>
                                        @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>


                            <h4 class="mt-10 font-weight-bold section_heading">
                                <span>Project Beneficiaries</span>
                            </h4>

                            <div class="row mt-10">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Male</th>
                                            <th class="text-center">Female</th>
                                            <th class="text-center">Transgender</th>
                                            <th class="text-center">Total</th>
                                            <th class="text-center">Minority</th>
                                            <th class="text-center">Disabilities</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center"><div class="value">{{ $annualDevelopmentProject->beneficiary_male }}</div></td>
                                                <td class="text-center"><div class="value">{{ $annualDevelopmentProject->beneficiary_female }}</div></td>
                                                <td class="text-center"><div class="value">{{ $annualDevelopmentProject->beneficiary_trans_gender }}</div></td>
                                                <td class="text-center"><div class="value">{{ $annualDevelopmentProject->beneficiary_total }}</div></td>
                                                <td class="text-center"><div class="value">{{ $annualDevelopmentProject->minority }}</div></td>
                                                <td class="text-center"><div class="value">{{ $annualDevelopmentProject->disability }}</div></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>




                            <div class="row mt-10">
                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Status:</strong></div>
                                        <div
                                            class="col-md-6 value">{{ $annualDevelopmentProject->status?'Active':'Inactive' }}</div>
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

