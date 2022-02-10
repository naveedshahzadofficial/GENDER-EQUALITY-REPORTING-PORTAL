@extends('layouts.main')
@push('title', 'Add Violence Against Women')
@push('breadcrumb-items')
    <li class="breadcrumb-item">
        <a href="{{ route('women-ombudsperson-violences.index') }}" class="text-muted">Federal Investigation Agency: Violence Against Women</a>
    </li>
    <li class="breadcrumb-item">
        <a class="text-muted">Add</a>
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
                            <h3 class="card-title">Add Violence Against Women</h3>

                        </div>

                        <!--begin::Form-->
                        {!! Form::open(array('id'=>'form_add_edit','route' => 'women-ombudsperson-violences.store','method'=>'POST','files' => 'true')) !!}
                        <div class="card-body">

                            <div class="row form-group">
                                <div class="col-lg-6 @if(!empty(auth()->user()->department_id)) d-none @endif">
                                    <label>Department <span class="color-red-700">*</span></label>
                                    <select class="form-control select2" name="department_id">
                                        <option value="">Select Department</option>
                                        @foreach($departments as $department)
                                            <option {{ old('department_id',auth()->user()->department_id)== $department->id ? 'selected': '' }} value="{{ $department->id }}"> {{ $department->department_name }} </option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6">
                                    <label>District <span class="color-red-700">*</span></label>
                                    <select class="form-control select2" name="district_id">
                                        <option value="">Select District</option>
                                        @if(isset($districts) && !empty($districts))
                                            @foreach($districts as $district)
                                                <option {{ old('district_id')== $district->id ? 'selected': '' }} value="{{ $district->id }}"> {{ $district->district_name_e }} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('district_id')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>


                            <div class="row form-group">

                                <div class="col-lg-6">
                                    <label>Month <span class="color-red-700">*</span></label>
                                    <select class="form-control select2" name="month_id">
                                        <option value="">Select Month</option>
                                        @if(isset($months) && !empty($months))
                                            @foreach($months as $month)
                                                <option {{ old('month_id')== $month->id ? 'selected': '' }} value="{{ $month->id }}"> {{ $month->month_name }} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('month_id')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6">
                                    <label>Year <span class="color-red-700">*</span></label>
                                    <select class="form-control select2" name="year">
                                        <option value="">Select Year</option>
                                            @for($i=date('Y'); $i>=2015; $i--)
                                                <option {{ old('year')== $i ? 'selected': '' }} value="{{ $i }}"> {{ $i }} </option>
                                            @endfor
                                    </select>
                                    @error('year')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <h4 class="mt-10 font-weight-bold section_heading">
                                <span>Complaints</span>
                            </h4>

                            <div class="row form-group">

                                <div class="col-lg-6">
                                    <label>Complaints Proceeding Initiated<span class="color-red-700">*</span></label>
                                    <input  type="text" name="complaints_proceeding_initiated" class="form-control money_format" placeholder="Complaints Proceeding Initiated" value="{{ old('complaints_proceeding_initiated') }}" />
                                    @error('complaints_proceeding_initiated')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6">
                                    <label>Complaints Disposed without Initiating Proceeding<span class="color-red-700">*</span></label>
                                    <input  type="text" name="complaints_disposed_without_proceeding_initiated" class="form-control money_format" placeholder="Complaints Disposed without Initiating Proceeding" value="{{ old('complaints_disposed_without_proceeding_initiated') }}" />
                                    @error('complaints_disposed_without_proceeding_initiated')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>


                            <h4 class="mt-10 font-weight-bold section_heading">
                                <span>Cases</span>
                            </h4>

                            <div class="row form-group">

                                <div class="col-lg-6">
                                    <label>Total Case Completed<span class="color-red-700">*</span></label>
                                    <input  type="text" name="total_cases_completed" class="form-control money_format" placeholder="Total Case Completed" value="{{ old('total_cases_completed') }}" />
                                    @error('total_cases_completed')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6">
                                    <label>Total Cases in Progress<span class="color-red-700">*</span></label>
                                    <input  type="text" name="total_cases_in_progress" class="form-control money_format" placeholder="Total Cases in Progress" value="{{ old('total_cases_in_progress') }}" />
                                    @error('total_cases_in_progress')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>


                            </div>


                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary custom-btn-form mr-2">Submit</button>
                            <a href="{{ route('women-ombudsperson-violences.index') }}"  class="btn btn-secondary">Cancel</a>
                        </div>
                    {!! Form::close() !!}
                    <!--end::Form-->
                    </div>

                </div>

            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@endsection

@push('post-scripts')
    <script>


        $(document).ready(function() {
            FormValidation.formValidation(
                document.getElementById('form_add_edit'),
                {
                    fields: {
                        department_id: {
                            validators: {
                                notEmpty: {
                                    message: 'Department is required'
                                }
                            }
                        },
                        district_id: {
                            validators: {
                                notEmpty: {
                                    message: 'District is required'
                                }
                            }
                        },
                        month_id: {
                            validators: {
                                notEmpty: {
                                    message: 'Month name is required'
                                }
                            }
                        },
                        year: {
                            validators: {
                                notEmpty: {
                                    message: 'Year is required'
                                }
                            }
                        },
                        complaints_proceeding_initiated: {
                            validators: {
                                notEmpty: {
                                    message: 'Complaints Proceeding Initiated is required'
                                }
                            }
                        },
                        complaints_disposed_without_proceeding_initiated: {
                            validators: {
                                notEmpty: {
                                    message: 'Complaints Disposed without Initiating Proceeding is required'
                                }
                            }
                        },
                        complaints_disposed_without_fir: {
                            validators: {
                                notEmpty: {
                                    message: 'Complaints Disposed without FIR is required'
                                }
                            }
                        },
                        complaints_in_process: {
                            validators: {
                                notEmpty: {
                                    message: 'Complaints In Process is required'
                                }
                            }
                        },
                        total_cases_completed: {
                            validators: {
                                notEmpty: {
                                    message: 'Total Case Completed is required'
                                }
                            }
                        },
                        total_cases_in_progress: {
                            validators: {
                                notEmpty: {
                                    message: 'Total Cases in Progress is required'
                                }
                            }
                        },

                    },

                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        excluded: new FormValidation.plugins.Excluded(),
                        // Validate fields when clicking the Submit button
                        submitButton: new FormValidation.plugins.SubmitButton(),
                        // Submit the form when all fields are valid
                        defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                        // Bootstrap Framework Integration
                        bootstrap: new FormValidation.plugins.Bootstrap({
                            eleInvalidClass: '',
                            eleValidClass: '',
                        })
                    }
                }
            );

        });
    </script>

@endpush
