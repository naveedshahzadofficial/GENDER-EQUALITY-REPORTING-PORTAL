@extends('layouts.main')
@push('title', 'Update Violence Against Women')
@push('breadcrumb-items')
    <li class="breadcrumb-item">
        <a href="{{ route('federal-agency-violences.index') }}" class="text-muted">Federal Investigation Agency: Violence Against Women</a>
    </li>
    <li class="breadcrumb-item">
        <a class="text-muted">Update</a>
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
                            <h3 class="card-title">Update Violence Against Women</h3>

                        </div>

                        <!--begin::Form-->
                        {!! Form::open(array('id'=>'form_add_edit','route' => ['federal-agency-violences.update', $federalAgencyViolence],'method'=>'PUT','files' => 'true')) !!}
                        <div class="card-body">

                            <div class="row form-group">
                                <div class="col-lg-6 @if(!empty(auth()->user()->department_id)) d-none @endif">
                                    <label>Department <span class="color-red-700">*</span></label>
                                    <select class="form-control select2" name="department_id">
                                        <option value="">Select Department</option>
                                        @foreach($departments as $department)
                                            <option {{ old('department_id',$federalAgencyViolence->department_id)== $department->id ? 'selected': '' }} value="{{ $department->id }}"> {{ $department->department_name }} </option>
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
                                                <option {{ old('district_id', $federalAgencyViolence->district_id)== $district->id ? 'selected': '' }} value="{{ $district->id }}"> {{ $district->district_name_e }} </option>
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
                                                <option {{ old('month_id', $federalAgencyViolence->month_id)== $month->id ? 'selected': '' }} value="{{ $month->id }}"> {{ $month->month_name }} </option>
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
                                            <option {{ old('year', $federalAgencyViolence->year)== $i ? 'selected': '' }} value="{{ $i }}"> {{ $i }} </option>
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
                                    <label>Total Complaints<span class="color-red-700">*</span></label>
                                    <input  type="text" name="total_complaints" class="form-control money_format" placeholder="Total Complaints" value="{{ old('total_complaints', $federalAgencyViolence->total_complaints) }}" />
                                    @error('total_complaints')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6">
                                    <label>Converted to FIR<span class="color-red-700">*</span></label>
                                    <input  type="text" name="complaints_converted_to_fir" class="form-control money_format" placeholder="Converted to FIR" value="{{ old('complaints_converted_to_fir', $federalAgencyViolence->complaints_converted_to_fir) }}" />
                                    @error('complaints_converted_to_fir')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="row form-group">

                                <div class="col-lg-6">
                                    <label>Complaints Disposed without FIR<span class="color-red-700">*</span></label>
                                    <input  type="text" name="complaints_disposed_without_fir" class="form-control money_format" placeholder="Complaints Disposed" value="{{ old('complaints_disposed_without_fir', $federalAgencyViolence->complaints_disposed_without_fir) }}" />
                                    @error('complaints_disposed_without_fir')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6">
                                    <label>Complaints In Process<span class="color-red-700">*</span></label>
                                    <input  type="text" name="complaints_in_process" class="form-control money_format" placeholder="Child Marriage" value="{{ old('complaints_in_process', $federalAgencyViolence->complaints_in_process) }}" />
                                    @error('complaints_in_process')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <h4 class="mt-10 font-weight-bold section_heading">
                                <span>Cases</span>
                            </h4>

                            <div class="row form-group">

                                <div class="col-lg-6">
                                    <label>Case Completed<span class="color-red-700">*</span></label>
                                    <input  type="text" name="case_completed" class="form-control money_format" placeholder="Case Completed" value="{{ old('case_completed',  $federalAgencyViolence->case_completed) }}" />
                                    @error('case_completed')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>


                            </div>


                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary custom-btn-form mr-2">Submit</button>
                            <a href="{{ route('federal-agency-violences.index') }}"  class="btn btn-secondary">Cancel</a>
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
                        total_complaints: {
                            validators: {
                                notEmpty: {
                                    message: 'Total Complaints is required'
                                }
                            }
                        },
                        complaints_converted_to_fir: {
                            validators: {
                                notEmpty: {
                                    message: 'Converted to FIR is required'
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
                        case_completed: {
                            validators: {
                                notEmpty: {
                                    message: 'Case Completed is required'
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
