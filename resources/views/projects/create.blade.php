@extends('layouts.main')
@push('title', 'Add Voluntary National Report')
@push('breadcrumb-items')
    <li class="breadcrumb-item">
        <a href="{{ route('projects.index') }}" class="text-muted">Project</a>
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
                            <h3 class="card-title">Add Project</h3>

                        </div>

                        <!--begin::Form-->
                        {!! Form::open(array('id'=>'form_add_edit','route' => 'projects.store','method'=>'POST','files' => 'true')) !!}
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
                            </div>

                            <div class="row form-group">
                                <div class="col-lg-6">
                                    <label>Project Type <span class="color-red-700">*</span></label>
                                    <select class="form-control select2" name="project_type_id">
                                        <option value="">Select Project</option>
                                        @foreach($project_types as $project_type)
                                            <option {{ old('project_type_id')== $project_type->id ? 'selected': '' }} value="{{ $project_type->id }}"> {{ $project_type->project_type_title }} </option>
                                        @endforeach
                                    </select>
                                    @error('project_type_id')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6">
                                    <label>Project Title <span class="color-red-700">*</span></label>
                                    <input type="text" name="project_title" class="form-control" placeholder="Title" value="{{ old('project_title') }}" />
                                    @error('project_title')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">

                                <div class="col-lg-6">
                                    <label>Start Date<span class="color-red-700">*</span></label>
                                    <input readonly type="text" name="project_start_date" style="width: 100% !important;" class="form-control datepicker" placeholder="Start Date" value="{{ old('project_start_date') }}" />
                                    @error('project_start_date')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label>End Date<span class="color-red-700">*</span></label>
                                    <input readonly type="text" name="project_end_date" style="width: 100% !important;" class="form-control datepicker" placeholder="End Date" value="{{ old('project_end_date') }}" />
                                    @error('project_end_date')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary custom-btn-form mr-2">Submit</button>
                            <a href="{{ route('projects.index') }}"  class="btn btn-secondary">Cancel</a>
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
                        project_type_id: {
                            validators: {
                                notEmpty: {
                                    message: 'Project Type is required'
                                }
                            }
                        },
                        project_title: {
                            validators: {
                                notEmpty: {
                                    message: 'Title is required'
                                }
                            }
                        },
                        project_start_date: {
                            validators: {
                                notEmpty: {
                                    message: 'start date is required'
                                }
                            }
                        },
                        project_end_date: {
                            validators: {
                                notEmpty: {
                                    message: 'End date is required'
                                }
                            }
                        }
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
