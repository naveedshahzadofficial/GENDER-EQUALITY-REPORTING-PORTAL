@extends('layouts.main')
@push('title', 'Add Punjab Action Plans')
@push('breadcrumb-items')
    <li class="breadcrumb-item">
        <a href="{{ route('punjab-action-plans.index') }}" class="text-muted">Punjab Action Plans</a>
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
                    <div class="card card-custom gutter-b">
                        <div class="card-header">
                            <h3 class="card-title">Add Punjab Action Plan</h3>

                        </div>

                        <!--begin::Form-->
                        {!! Form::open(array('id'=>'form_add_edit','route' => 'punjab-action-plans.store','method'=>'POST','files' => 'true')) !!}
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


                            <div class="row form-group">

                                <div class="col-lg-6">
                                    <label>Target <span class="color-red-700">*</span></label>
                                    <select class="form-control select2" name="target_id">
                                        <option value="">Select Target</option>
                                        @if(isset($targets) && !empty($targets))
                                            @foreach($targets as $target)
                                                <option {{ old('target_id')== $target->id ? 'selected': '' }} value="{{ $target->id }}"> {{ $target->target_value }} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('target_id')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6">
                                    <label>Indicator <span class="color-red-700">*</span></label>
                                    <select class="form-control select2" name="indicator_id">
                                        <option value="">Select Indicator</option>
                                        @if(isset($indicators) && !empty($indicators))
                                            @foreach($indicators as $indicator)
                                                <option {{ old('indicator_id')== $indicator->id ? 'selected': '' }} value="{{ $indicator->id }}"> {{ $indicator->indicator_title }} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('indicator_id')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="row form-group">
                                <div class="col-lg-6">
                                    <label>File Attachment (Indicator Framework)<span class="color-red-700">*</span></label>
                                    <input type="file" name="indicator_framework_file" class="form-control" value="{{ old('indicator_framework_file') }}" />
                                    <small>Upload formats are jpeg,jpg,png,pdf and upload file size must be less than 2 MB</small>
                                    @error('indicator_framework_file')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6">
                                    <label>Baseline<span class="color-red-700">*</span></label>
                                    <input type="text" name="baseline"  class="form-control" placeholder="Baseline" value="{{ old('baseline') }}" />
                                    @error('baseline')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="row form-group">
                                <div class="col-lg-6">
                                    <label>Reporting Agency<span class="color-red-700">*</span></label>
                                    <input type="text" name="reporting_agency"  class="form-control" placeholder="Reporting Agency" value="{{ old('reporting_agency') }}" />
                                    @error('reporting_agency')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label>Implementation Responsibility<span class="color-red-700">*</span></label>
                                    <input type="text" name="implementation_responsibility"  class="form-control" placeholder="Responsibility" value="{{ old('implementation_responsibility') }}" />
                                    @error('implementation_responsibility')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <h4 class="mt-10 font-weight-bold section_heading">
                                <span>Target Reform Action Plan</span>
                            </h4>

                            <div class="section_box">
                                <div class="row form-group">
                                    <div class="col-lg-12">
                                        <table class="table table-bordered m_repeater_section">
                                            <thead>
                                            <tr>
                                                <th class="text-left">Defining Action</th>
                                                <th class="text-left">Defining Date</th>
                                                <th class="text-left" colspan="2">Progress Status</th>
                                            </tr>
                                            </thead>
                                            <tbody data-repeater-list="target_reforms">
                                            @for($index =0; $index<count(old('target_reforms',array(0))); $index++)
                                                <tr  data-repeater-item>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <input type="text" name="defining_action" style="width: 100% !important;" class="form-control defining_action" placeholder="Defining action" value="{{ old("target_reforms.{$index}.defining_action") }}" />
                                                                @error("target_reforms.{$index}.defining_action")
                                                                <div class="error">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <input readonly type="text" name="defining_date" style="width: 100% !important;" class="form-control defining_date datepicker" placeholder="Defining date" value="{{ old("target_reforms.{$index}.defining_date") }}" />
                                                                @error("target_reforms.{$index}.defining_date")
                                                                <div class="error">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <select class="form-control select2 progress_status" name="progress_status" style="width: 100% !important;">
                                                                    <option value="">Select Progress Status</option>
                                                                    @if(isset($progress_status) && !empty($progress_status))
                                                                        @foreach($progress_status as $status)
                                                                            <option {{ old("target_reforms.{$index}.progress_status")== $status ? 'selected': '' }} value="{{ $status }}"> {{ $status }} </option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                                @error("target_reforms.{$index}.progress_status")
                                                                <div class="error">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <a href="javascript:;" data-repeater-delete="" class="btn btn-icon btn-danger btn-sm">
                                                            <i class="la la-remove"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endfor

                                            <tfoot>
                                            <td colspan="7" class="text-right">
                                                <div data-repeater-create="" class="btn btn btn-sm btn-success m-btn m-btn--icon m-btn--pill m-btn--wide">
					<span><i class="la la-plus"></i><span>Add Another Target Reform</span></span>
                                                </div>
                                            </td>
                                            </tfoot>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary custom-btn-form mr-2">Submit</button>
                            <a href="{{ route('punjab-action-plans.index') }}"  class="btn btn-secondary">Cancel</a>
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

        const defining_actions_rule = {
            validators: {
                notEmpty: {
                    message: 'Defining action is required'
                }
            }
        };

        const reform_action_defining_dates_rule = {
            validators: {
                notEmpty: {
                    message: 'Reform action defining date is required'
                }
            }
        };

        const reform_action_plan_progress_statuses_rule = {
            validators: {
                notEmpty: {
                    message: 'Reform action plan progress status is required'
                }
            }
        };

        let fv;
        $(document).ready(function() {

            $('.m_repeater_section').repeater({
                initEmpty: false,
                defaultValues: {
                    'text-input': 'foo'
                },
                show: function() {
                    $(this).slideDown();
                    $(this).find('.select2.select2-container').remove();
                    $(this).find('.select2').removeClass('select2-hidden-accessible');
                    $('.select2').select2();
                    $(this).find('.datepicker').datetimepicker({
                        timepicker:false,
                        format:'Y-m-d',
                        formatDate:'Y-m-d',
                        scrollInput : false,
                        maxDate: new Date
                    });
                    let defining_action = $(this).find('.defining_action').attr('name');
                    fv.addField(defining_action, defining_actions_rule);
                    let defining_date = $(this).find('.defining_date').attr('name');
                    fv.addField(defining_date, reform_action_defining_dates_rule);
                    let progress_status = $(this).find('.progress_status').attr('name');
                    fv.addField(progress_status, reform_action_plan_progress_statuses_rule);
                },
                hide: function(deleteElement) {
                    if(confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                        let defining_action = $(this).find('.defining_action').attr('name');
                        fv.removeField(defining_action);
                        let defining_date = $(this).find('.defining_date').attr('name');
                        fv.removeField(defining_date);
                        let progress_status = $(this).find('.progress_status').attr('name');
                        fv.removeField(progress_status);
                    }
                },
                isFirstItemUndeletable: true,
            });

            fv = FormValidation.formValidation(
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
                        year: {
                            validators: {
                                notEmpty: {
                                    message: 'Year is required'
                                }
                            }
                        },
                        target_id: {
                            validators: {
                                notEmpty: {
                                    message: 'Target is required'
                                }
                            }
                        },
                        indicator_id: {
                            validators: {
                                notEmpty: {
                                    message: 'Indicator is required'
                                }
                            }
                        },
                        indicator_framework_file: {
                            validators: {
                                notEmpty: {
                                    message: 'Attachment is required'
                                },
                                file: {
                                    extension: 'jpeg,jpg,png,pdf',
                                    type: 'image/jpeg,image/png,application/pdf',
                                    maxSize: 2097152, // 2048 * 1024
                                    message: 'The selected file is not valid',
                                },
                            }
                        },
                        baseline: {
                            validators: {
                                notEmpty: {
                                    message: 'Baseline is required'
                                }
                            }
                        },
                        reporting_agency: {
                            validators: {
                                notEmpty: {
                                    message: 'Reporting Agency is required'
                                }
                            }
                        },
                        implementation_responsibility: {
                            validators: {
                                notEmpty: {
                                    message: 'Implementation Responsibility is required'
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

            @for($index =0; $index<count(old('target_reforms',array(0))); $index++)
            fv.addField('target_reforms[{{$index}}][defining_action]', defining_actions_rule);
            fv.addField('target_reforms[{{$index}}][defining_date]', reform_action_defining_dates_rule);
            fv.addField('target_reforms[{{$index}}][progress_status]', reform_action_plan_progress_statuses_rule);
            @endfor

        });
    </script>

@endpush
