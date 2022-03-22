@extends('layouts.main')
@push('title', 'Update Project')
@push('breadcrumb-items')
    <li class="breadcrumb-item">
        <a href="{{ route('projects.index') }}" class="text-muted">Project</a>
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
                            <h3 class="card-title">Update Project</h3>

                        </div>

                        <!--begin::Form-->
                        {!! Form::open(array('id'=>'form_add_edit','route' => ['projects.update', $project],'method'=>'PUT', 'files'=>'true')) !!}
                        <div class="card-body">

                            <div class="row form-group">
                                <div class="col-lg-6 @if(!empty(auth()->user()->department_id)) d-none @endif">
                                    <label>Department <span class="color-red-700">*</span></label>
                                    <select class="form-control select2" name="department_id">
                                        <option value="">Select Department</option>
                                        @foreach($departments as $department)
                                            <option {{ old('department_id',$project->department_id)== $department->id ? 'selected': '' }} value="{{ $department->id }}"> {{ $department->department_name }} </option>
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
                                            <option {{ old('project_type_id', $project->project_type_id)== $project_type->id ? 'selected': '' }} value="{{ $project_type->id }}"> {{ $project_type->project_type_title }} </option>
                                        @endforeach
                                    </select>
                                    @error('project_type_id')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label>Project Title <span class="color-red-700">*</span></label>
                                    <input type="text" name="project_title" class="form-control" placeholder="Title" value="{{ old('project_title',$project->project_title) }}" />
                                    @error('project_title')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="row form-group">
                                <div class="col-lg-6">
                                    <label>Start Date<span class="color-red-700">*</span></label>
                                    <input id="start_datepicker" readonly type="text" name="project_start_date" style="width: 100% !important;" class="form-control" placeholder="Start Date" value="{{ old('project_start_date',$project->project_start_date) }}" />
                                    @error('project_start_date')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6">
                                    <label>End Date<span class="color-red-700">*</span></label>
                                    <input id="end_datepicker" readonly type="text" name="project_end_date" style="width: 100% !important;" class="form-control" placeholder="End Date" value="{{ old('project_end_date',$project->project_end_date) }}" />
                                    @error('project_end_date')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-lg-12">
                                    <label>Description<span class="color-red-700"></span></label>
                                    <textarea class="form-control resize-none" rows="4" name="project_description" placeholder="Project description...">{{ old('project_description',$project->project_description) }}</textarea>
                                    @error('project_description')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="row form-group">
                                <div class="col-lg-6">
                                    <label>Location of project<span class="text-danger">*</span></label>
                                    <div class="col-form-label">
                                        <div class="radio-inline">
                                            <label class="radio radio-primary"><input type="radio"  name="project_is_all_punjab" value="1" {{ old('project_is_all_punjab', $project->project_is_all_punjab)=='1'?'checked':'' }}><span></span>All of Punjab</label>
                                            <label class="radio radio-primary"><input type="radio" name="project_is_all_punjab" value="0" {{ old('project_is_all_punjab', $project->project_is_all_punjab)=='0'?'checked':'' }}><span></span>Specific Location </label>
                                        </div>
                                        @error('project_is_all_punjab')
                                        <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 {{ old('project_is_all_punjab', $project->project_is_all_punjab)=='0'?'':'d-none' }}" id="is_punjab">
                                    <label>Locations<span class="text-danger">*</span></label>
                                    <select class="form-control multiple-select2" multiple name="district_ids[]" style="width: 100% !important;">
                                        @foreach($districts as $district)
                                            <option {{ $project->isHasLocation($district->id) ? 'selected': '' }} value="{{ $district->id }}"> {{ $district->district_name_e }} </option>
                                        @endforeach
                                    </select>
                                    @error('district_ids')
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

@push('post-styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .select2-container {
            min-width: 400px;
        }

        .select2-results__option {
            padding-right: 20px;
            vertical-align: middle;
        }
        .select2-results__option:before {
            content: "";
            display: inline-block;
            position: relative;
            height: 20px;
            width: 20px;
            border: 2px solid #e9e9e9;
            border-radius: 4px;
            background-color: #fff;
            margin-right: 20px;
            vertical-align: middle;
        }
        .select2-results__option[aria-selected=true]:before {
            font-family:fontAwesome;
            content: "\f00c";
            color: #fff;
            background-color: #ff3a21;
            border: 0;
            display: inline-block;
            padding-left: 3px;
        }
        .select2-container--default .select2-results__option[aria-selected=true] {
            background-color: #fff;
        }
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #eaeaeb;
            color: #272727;
        }
        .select2-container--default .select2-selection--multiple {
            margin-bottom: 10px;
        }
        .select2-container--default.select2-container--open.select2-container--below .select2-selection--multiple {
            border-radius: 4px;
        }
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: #ff3a21;
            border-width: 2px;
        }
        .select2-container--default .select2-selection--multiple {
            border-width: 2px;
        }
        .select2-container--open .select2-dropdown--below {

            border-radius: 6px;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);

        }
        .select2-selection .select2-selection--multiple:after {
            content: 'hhghgh';
        }
        /* select with icons badges single*/
        .select-icon .select2-selection__placeholder .badge {
            display: none;
        }
        .select-icon .placeholder {
            /* 	display: none; */
        }
        .select-icon .select2-results__option:before,
        .select-icon .select2-results__option[aria-selected=true]:before {
            display: none !important;
            /* content: "" !important; */
        }
        .select-icon  .select2-search--dropdown {
            display: none;
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
                                    message: 'Start date is required'
                                }
                            }
                        },
                        project_end_date: {
                            validators: {
                                notEmpty: {
                                    message: 'End date is required'
                                }
                            }
                        },
                        project_is_all_punjab: {
                            validators: {
                                notEmpty: {
                                    message: 'Project Location is required'
                                }
                            }
                        },
                        'district_ids[]': {
                            validators: {
                                callback: {
                                    message: 'Please specific the location',
                                    callback: function(input) {
                                        const selectedCheckbox = document.getElementById('form_add_edit').querySelector('[name="project_is_all_punjab"]:checked');
                                        const framework = selectedCheckbox ? selectedCheckbox.value : '';
                                        return (framework !== '0')? true: (input.value !== '');
                                    }
                                }
                            },
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

            $(".multiple-select2").select2({
                closeOnSelect : false,
                placeholder : "Select Location",
                // allowHtml: true,
                allowClear: true,
            });

            $("input[name='project_is_all_punjab']").on('change', function (){
                let is_punjab = $("input[name='project_is_all_punjab']:checked").val();
                if(is_punjab == 1)
                {
                    $('#is_punjab').addClass('d-none');
                }
                else
                {
                    $('#is_punjab').removeClass('d-none');
                }
            });


        });
    </script>
@endpush
