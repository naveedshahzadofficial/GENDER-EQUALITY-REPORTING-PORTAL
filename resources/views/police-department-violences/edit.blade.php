@extends('layouts.main')
@push('title', 'Update Violence Against Children and Women')
@push('breadcrumb-items')
    <li class="breadcrumb-item">
        <a href="{{ route('police-department-violences.index') }}" class="text-muted">Police Department: Violence Against Children and Women</a>
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
                    <div class="card card-custom gutter-b">
                        <div class="card-header">
                            <h3 class="card-title">Update Violence Against Children and Women</h3>

                        </div>

                        <!--begin::Form-->
                        {!! Form::open(array('id'=>'form_add_edit','route' => ['police-department-violences.update', $policeDepartmentViolence],'method'=>'PUT','files' => 'true')) !!}
                        <div class="card-body">

                            <div class="row form-group">
                                <div class="col-lg-6 @if(!empty(auth()->user()->department_id)) d-none @endif">
                                    <label>Department <span class="color-red-700">*</span></label>
                                    <select class="form-control select2" name="department_id">
                                        <option value="">Select Department</option>
                                        @foreach($departments as $department)
                                            <option {{ old('department_id',$policeDepartmentViolence->department_id)== $department->id ? 'selected': '' }} value="{{ $department->id }}"> {{ $department->department_name }} </option>
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
                                                <option {{ old('district_id', $policeDepartmentViolence->district_id)== $district->id ? 'selected': '' }} value="{{ $district->id }}"> {{ $district->district_name_e }} </option>
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
                                                <option {{ old('month_id', $policeDepartmentViolence->month_id)== $month->id ? 'selected': '' }} value="{{ $month->id }}"> {{ $month->month_name }} </option>
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
                                            <option {{ old('year', $policeDepartmentViolence->year)== $i ? 'selected': '' }} value="{{ $i }}"> {{ $i }} </option>
                                        @endfor
                                    </select>
                                    @error('year')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <h4 class="mt-10 font-weight-bold section_heading">
                                <span>Violence Against Children</span>
                            </h4>

                            <div class="row form-group">

                                <div class="col-lg-6">
                                    <label>Child Abuse<span class="color-red-700">*</span></label>
                                    <input  type="text" name="child_abuse" class="form-control crime_stats money_format" placeholder="Child Abuse" value="{{ old('child_abuse', $policeDepartmentViolence->child_abuse) }}" />
                                    @error('child_abuse')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6">
                                    <label>Child Abuse and Murder<span class="color-red-700">*</span></label>
                                    <input  type="text" name="child_abuse_murder" class="form-control crime_stats money_format" placeholder="Child Abuse and Murder" value="{{ old('child_abuse_murder', $policeDepartmentViolence->child_abuse_murder) }}" />
                                    @error('child_abuse_murder')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="row form-group">

                                <div class="col-lg-6">
                                    <label>Child Labour<span class="color-red-700">*</span></label>
                                    <input  type="text" name="child_labour" class="form-control crime_stats money_format" placeholder="Child Labour" value="{{ old('child_labour', $policeDepartmentViolence->child_labour) }}" />
                                    @error('child_labour')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6">
                                    <label>Child Marriage<span class="color-red-700">*</span></label>
                                    <input  type="text" name="child_marriage" class="form-control crime_stats money_format" placeholder="Child Marriage" value="{{ old('child_marriage', $policeDepartmentViolence->child_marriage) }}" />
                                    @error('child_marriage')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <h4 class="mt-10 font-weight-bold section_heading">
                                <span>Violence Against Women</span>
                            </h4>

                            <div class="row form-group">

                                <div class="col-lg-6">
                                    <label>Murder<span class="color-red-700">*</span></label>
                                    <input  type="text" name="women_murder" class="form-control crime_stats money_format" placeholder="Murder" value="{{ old('women_murder', $policeDepartmentViolence->women_murder) }}" />
                                    @error('women_murder')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6">
                                    <label>Domestic Violence<span class="color-red-700">*</span></label>
                                    <input  type="text" name="women_domestic_violence" class="form-control crime_stats money_format" placeholder="Domestic Violence" value="{{ old('women_domestic_violence', $policeDepartmentViolence->women_domestic_violence) }}" />
                                    @error('women_domestic_violence')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="row form-group">

                                <div class="col-lg-6">
                                    <label>Rape<span class="color-red-700">*</span></label>
                                    <input  type="text" name="women_rape" class="form-control crime_stats money_format" placeholder="Rape" value="{{ old('women_rape', $policeDepartmentViolence->women_rape) }}" />
                                    @error('women_rape')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label>Gange Rape<span class="color-red-700">*</span></label>
                                    <input  type="text" name="women_gang_rape" class="form-control crime_stats money_format" placeholder="Gange Rape" value="{{ old('women_gang_rape', $policeDepartmentViolence->women_gang_rape) }}" />
                                    @error('women_gang_rape')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>



                            </div>

                            <div class="row form-group">

                                <div class="col-lg-6">
                                    <label>Kidnapping/ Abduction<span class="color-red-700">*</span></label>
                                    <input  type="text" name="women_kidnapping" class="form-control crime_stats money_format" placeholder="Kidnapping/ Abduction" value="{{ old('women_kidnapping', $policeDepartmentViolence->women_kidnapping) }}" />
                                    @error('women_kidnapping')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6">
                                    <label>Burning<span class="color-red-700">*</span></label>
                                    <input  type="text" name="women_burning" class="form-control crime_stats money_format" placeholder="Burning" value="{{ old('women_burning', $policeDepartmentViolence->women_burning) }}" />
                                    @error('women_burning')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="row form-group">

                                <div class="col-lg-6">
                                    <label>Honour Killing of Women<span class="color-red-700">*</span></label>
                                    <input  type="text" name="women_honour_killing" class="form-control crime_stats money_format" placeholder="Honour Killing of Women" value="{{ old('women_honour_killing', $policeDepartmentViolence->women_honour_killing) }}" />
                                    @error('women_honour_killing')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6">
                                    <label>Vani<span class="color-red-700">*</span></label>
                                    <input  type="text" name="women_vani" class="form-control crime_stats money_format" placeholder="Vani" value="{{ old('women_vani', $policeDepartmentViolence->women_vani) }}" />
                                    @error('women_vani')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="row form-group">

                                <div class="col-lg-6">
                                    <label>Forced/ Bonded Labour<span class="color-red-700">*</span></label>
                                    <input  type="text" name="women_forced_bonded_labour" class="form-control crime_stats money_format" placeholder="Forced/ Bonded Labour" value="{{ old('women_forced_bonded_labour', $policeDepartmentViolence->women_forced_bonded_labour) }}" />
                                    @error('women_forced_bonded_labour')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6">
                                    <label>Other Violence against Women<span class="color-red-700"></span></label>
                                    <input  type="text" name="women_other" class="form-control crime_stats money_format" placeholder="Other Violence against Women" value="{{ old('women_other', $policeDepartmentViolence->women_other) }}" />
                                    @error('women_other')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="row form-group">
                                <div class="col-lg-6">
                                    <label>Total<span class="color-red-700">*</span></label>
                                    <input readonly type="text" id="total_stats" name="total" class="form-control money_format" placeholder="Total" value="{{ old('total', $policeDepartmentViolence->total) }}" />
                                    @error('total')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>



                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary custom-btn-form mr-2">Submit</button>
                            <a href="{{ route('police-department-violences.index') }}"  class="btn btn-secondary">Cancel</a>
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
                        child_abuse: {
                            validators: {
                                notEmpty: {
                                    message: 'Child abuse is required'
                                }
                            }
                        },
                        child_abuse_murder: {
                            validators: {
                                notEmpty: {
                                    message: 'Child abuse murder is required'
                                }
                            }
                        },
                        child_labour: {
                            validators: {
                                notEmpty: {
                                    message: 'Child Labour is required'
                                }
                            }
                        },
                        child_marriage: {
                            validators: {
                                notEmpty: {
                                    message: 'Child Marriage is required'
                                }
                            }
                        },
                        women_murder: {
                            validators: {
                                notEmpty: {
                                    message: 'Murder is required'
                                }
                            }
                        },
                        women_domestic_violence: {
                            validators: {
                                notEmpty: {
                                    message: 'Domestic violence is required'
                                }
                            }
                        },
                        women_rape: {
                            validators: {
                                notEmpty: {
                                    message: 'Rape is required'
                                }
                            }
                        },
                        women_gang_rape: {
                            validators: {
                                notEmpty: {
                                    message: 'Gang rape is required'
                                }
                            }
                        },
                        women_kidnapping: {
                            validators: {
                                notEmpty: {
                                    message: 'Kidnapping/ Abduction is required'
                                }
                            }
                        },
                        women_burning: {
                            validators: {
                                notEmpty: {
                                    message: 'Burning is required'
                                }
                            }
                        },
                        women_honour_killing: {
                            validators: {
                                notEmpty: {
                                    message: 'Honour killing is required'
                                }
                            }
                        },
                        women_vani: {
                            validators: {
                                notEmpty: {
                                    message: 'Vani is required'
                                }
                            }
                        },
                        women_forced_bonded_labour: {
                            validators: {
                                notEmpty: {
                                    message: 'Forced/ Bonded labour is required'
                                }
                            }
                        },
                        women_other: {
                            validators: {
                                enabled: false,
                                notEmpty: {
                                    message: 'Other violence against women is required'
                                }
                            }
                        },
                        total: {
                            validators: {
                                notEmpty: {
                                    message: 'Total is required'
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
            $('.crime_stats').on('change', function (){
                let total_stats = 0;
                $('.crime_stats').each(function (){
                    let crime_stat = $(this).val();
                    if(crime_stat)
                        total_stats += parseInt(crime_stat.replace(',',''));
                });

                $('#total_stats').val(total_stats);

            });

        });
    </script>

@endpush
