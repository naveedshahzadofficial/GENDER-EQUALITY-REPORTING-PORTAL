@extends('layouts.main')
@push('title', 'Violence Against Children and Women')
@push('breadcrumb-items')
    <li class="breadcrumb-item">
        <a href="{{ route('police-department-violences.index') }}" class="text-muted">Police Department: Violence Against Children and Women</a>
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
                            <h3 class="card-title">Detail Violence Against Children and Women</h3>

                        </div>
                        <div class="card-body">
                            <div class="row mt-10">
                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Department:</strong></div>
                                        <div
                                            class="col-md-6 value">{{ optional($policeDepartmentViolence->department)->department_name }}</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>District:</strong></div>
                                        <div
                                            class="col-md-6 value">{{ optional($policeDepartmentViolence->district)->district_name_e }}</div>
                                    </div>
                                </div>

                            </div>
                            <div class="row mt-10">

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Month:</strong></div>
                                        <div class="col-md-6 value">{{ optional($policeDepartmentViolence->month)->month_name }}</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Year:</strong></div>
                                        <div
                                            class="col-md-6 value">{{ $policeDepartmentViolence->year }}</div>
                                    </div>
                                </div>

                            </div>
                            <h4 class="mt-10 font-weight-bold section_heading">
                                <span>Violence Against Children</span>
                            </h4>

                            <div class="row mt-10">

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Child Abuse:</strong></div>
                                        <div class="col-md-6 value">{{ $policeDepartmentViolence->child_abuse }}</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Child Abuse and Murder:</strong></div>
                                        <div
                                            class="col-md-6 value">{{ $policeDepartmentViolence->child_abuse_murder }}</div>
                                    </div>
                                </div>

                            </div>


                            <div class="row mt-10">

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Child Labour:</strong></div>
                                        <div class="col-md-6 value">{{ $policeDepartmentViolence->child_labour }}</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Child Marriage:</strong></div>
                                        <div
                                            class="col-md-6 value">{{ $policeDepartmentViolence->child_marriage }}</div>
                                    </div>
                                </div>

                            </div>

                            <h4 class="mt-10 font-weight-bold section_heading">
                                <span>Violence Against Women</span>
                            </h4>


                            <div class="row mt-10">

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Murder:</strong></div>
                                        <div class="col-md-6 value">{{ $policeDepartmentViolence->women_murder }}</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Domestic Violence:</strong></div>
                                        <div
                                            class="col-md-6 value">{{ $policeDepartmentViolence->women_domestic_violence }}</div>
                                    </div>
                                </div>

                            </div>


                            <div class="row mt-10">

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Rape:</strong></div>
                                        <div class="col-md-6 value">{{ $policeDepartmentViolence->women_rape }}</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Gange Rape:</strong></div>
                                        <div
                                            class="col-md-6 value">{{ $policeDepartmentViolence->women_gang_rape }}</div>
                                    </div>
                                </div>

                            </div>


                            <div class="row mt-10">

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Kidnapping/ Abduction:</strong></div>
                                        <div class="col-md-6 value">{{ $policeDepartmentViolence->women_kidnapping }}</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Burning:</strong></div>
                                        <div
                                            class="col-md-6 value">{{ $policeDepartmentViolence->women_burning }}</div>
                                    </div>
                                </div>

                            </div>

                            <div class="row mt-10">

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Honour Killing of Women:</strong></div>
                                        <div class="col-md-6 value">{{ $policeDepartmentViolence->women_honour_killing }}</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Vani:</strong></div>
                                        <div
                                            class="col-md-6 value">{{ $policeDepartmentViolence->women_vani }}</div>
                                    </div>
                                </div>

                            </div>

                            <div class="row mt-10">

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Forced/ Bonded Labour:</strong></div>
                                        <div class="col-md-6 value">{{ $policeDepartmentViolence->women_forced_bonded_labour }}</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Other Violence against Women:</strong></div>
                                        <div
                                            class="col-md-6 value">{{ $policeDepartmentViolence->women_other }}</div>
                                    </div>
                                </div>

                            </div>

                            <div class="row mt-10">

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Total:</strong></div>
                                        <div class="col-md-6 value">{{ $policeDepartmentViolence->total }}</div>
                                    </div>
                                </div>
                            </div>




                            <div class="row mt-10">
                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Status:</strong></div>
                                        <div
                                            class="col-md-6 value">{{ $policeDepartmentViolence->status?'Active':'Inactive' }}</div>
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

