@extends('layouts.main')
@push('title', 'Add Voluntary National Report')
@push('breadcrumb-items')
    <li class="breadcrumb-item">
        <a href="{{ route('voluntary-national-report.index') }}" class="text-muted">Voluntary National Report</a>
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
                    <div class="card card-custom gutter-b  example-compact">
                        <div class="card-header">
                            <h3 class="card-title">Add Voluntary National Report</h3>

                        </div>

                        <!--begin::Form-->
                        {!! Form::open(array('id'=>'form_add_edit','route' => 'voluntary-national-report.store','method'=>'POST','files' => 'true')) !!}
                        <div class="card-body">
                            <div class="row form-group d-none">
                                <div class="col-lg-6">
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
                            </div>

                            <div class="row form-group">
                                <div class="col-lg-12">
                                    <label>Targets <span class="color-red-700">*</span></label>
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
                            </div>

                            <div class="row form-group">
                                <div class="col-lg-6">
                                    <label>Policies / Program / Project / Interventions <span class="color-red-700">*</span></label>
                                    <select class="form-control select2" name="project_id" onchange="getProject(this)">
                                        <option value="">Select Project</option>
                                        @foreach($projects as $project)
                                            <option {{ old('project_id')== $project->id ? 'selected': '' }} value="{{ $project->id }}"> {{ $project->project_title }} </option>
                                        @endforeach
                                    </select>
                                    @error('project_id')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6">
                                    <label>Project Type <span class="color-red-700">*</span></label>
                                    <select readonly class="form-control" name="project_type_id" id="project_type_id">
                                        <option value="">Select Project</option>
                                        @foreach($project_types as $project_type)
                                            <option {{ old('project_type_id')== $project_type->id ? 'selected': '' }} value="{{ $project_type->id }}"> {{ $project_type->project_type_title }} </option>
                                        @endforeach
                                    </select>
                                    @error('project_type_id')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="row form-group">

                                <div class="col-lg-6">
                                    <label>Start Date<span class="color-red-700">*</span></label>
                                    <input id="start_datepicker" readonly type="text" name="start_date" style="width: 100% !important;" class="form-control" placeholder="Start Date" value="{{ old('start_date') }}" />
                                    @error('start_date')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label>End Date<span class="color-red-700">*</span></label>
                                    <input id="end_datepicker" readonly type="text" name="end_date" style="width: 100% !important;" class="form-control" placeholder="End Date" value="{{ old('end_date') }}" />
                                    @error('end_date')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Achievement So Far <span class="color-red-700">*</span></label>
                                    <textarea class="form-control" name="achievements" id="achievements" >{{ old('achievements')?old('achievements'):'' }}</textarea>
                                    @error('achievements')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6">
                                    <label>Challenges <span class="color-red-700">*</span></label>
                                    <textarea class="form-control" name="challenges" id="challenges" >{{ old('challenges')?old('challenges'):'' }}</textarea>
                                    @error('challenges')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Action Taken <span class="color-red-700">*</span></label>
                                    <textarea class="form-control" name="action_taken" id="action_taken" >{{ old('action_taken')?old('action_taken'):'' }}</textarea>
                                    @error('action_taken')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6">
                                    <label>Way Forward <span class="color-red-700">*</span></label>
                                    <textarea class="form-control" name="way_forward" id="way_forward" >{{ old('way_forward')?old('way_forward'):'' }}</textarea>
                                    @error('way_forward')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group row">

                                <div class="col-lg-6">
                                    <label>Partnership <span class="color-red-700">*</span></label>
                                    <textarea class="form-control" name="partnership" id="partnership" >{{ old('partnership')?old('partnership'):'' }}</textarea>
                                    @error('partnership')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6">
                                    <label>Upload Attachment<span class="color-red-700">*</span></label>
                                    <input type="file" name="attachment" class="form-control" value="{{ old('attachment') }}" />
                                    <small>Upload formats are jpeg, jpg, png, pdf and upload file size must be less than 2 MB</small>
                                    @error('attachment')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary custom-btn-form mr-2">Submit</button>
                            <a href="{{ route('voluntary-national-report.index') }}"  class="btn btn-secondary">Cancel</a>
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

@push('post-styles')
    <style>
        select[readonly]#project_type_id {
            pointer-events: none;
            touch-action: none;
        }
    </style>
@endpush


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
                        target_id: {
                            validators: {
                                notEmpty: {
                                    message: 'Target is required'
                                }
                            }
                        },
                        project_id: {
                            validators: {
                                notEmpty: {
                                    message: 'Project is required'
                                }
                            }
                        },
                        project_type_id: {
                            validators: {
                                notEmpty: {
                                    message: 'Project type is required'
                                }
                            }
                        },
                        start_date: {
                            validators: {
                                notEmpty: {
                                    message: 'start date is required'
                                }
                            }
                        },
                        achievements: {
                            validators: {
                                notEmpty: {
                                    message: 'Achievements is required'
                                }
                            }
                        },
                        challenges: {
                            validators: {
                                notEmpty: {
                                    message: 'Challenges is required'
                                }
                            }
                        },
                        action_taken: {
                            validators: {
                                notEmpty: {
                                    message: 'Action Taken is required'
                                }
                            }
                        },
                        way_forward: {
                            validators: {
                                notEmpty: {
                                    message: 'Way Forward is required'
                                }
                            }
                        },
                        partnership: {
                            validators: {
                                notEmpty: {
                                    message: 'Partnership is required'
                                }
                            }
                        },
                        end_date: {
                            validators: {
                                notEmpty: {
                                    message: 'End date is required'
                                }
                            }
                        },
                        attachment: {
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

        function getProject(obj){
            let project_id = $(obj).val();
            if(project_id) {
                $.post('{{ route('projects.project-ajax') }}', {'project_id': project_id}, function (response) {
                    $('#start_datepicker').val(response.project_start_date);
                    $('#end_datepicker').val(response.project_end_date);
                    $('#project_type_id').val(response.project_type_id)
                });
            }else{
                $('#start_datepicker').val('');
                $('#end_datepicker').val('');
                $('#project_type_id').val('')
            }
        }
    </script>

@endpush
