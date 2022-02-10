@extends('layouts.main')
@push('title', 'Add Target')
@push('breadcrumb-items')
    <li class="breadcrumb-item">
        <a href="{{ route('targets.index') }}" class="text-muted">Target</a>
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
                            <h3 class="card-title">Add Target</h3>

                        </div>

                        <!--begin::Form-->
                        {!! Form::open(array('id'=>'form_add_edit','route' => 'targets.store','method'=>'POST','files' => 'true')) !!}
                        <div class="card-body">
                            <div class="row form-group">
                                <div class="col-lg-6">
                                    <label>Upload Icon<span class="color-red-700">*</span></label>
                                    <input type="file" name="icon_name" class="form-control" value="{{ old('icon_name') }}" />
                                    <small>Upload formats are jpeg,jpg,png and upload file size must be less than 2 MB</small>
                                    @error('icon_name')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label>Target <span class="color-red-700">*</span></label>
                                    <input type="text" name="target_value" class="form-control" placeholder="Name" value="{{ old('target_value') }}" />
                                    @error('target_value')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-6">
                                    <label>Factor<span class="color-red-700">*</span></label>
                                    <input type="text" name="target_factor" style="width: 100% !important;" class="form-control" placeholder="Factor" value="{{ old('target_factor') }}" />
                                    @error('target_factor')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary custom-btn-form mr-2">Submit</button>
                            <a href="{{ route('targets.index') }}"  class="btn btn-secondary">Cancel</a>
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
                        target_value: {
                            validators: {
                                notEmpty: {
                                    message: 'Target is required'
                                }
                            }
                        },
                        target_factor: {
                            validators: {
                                notEmpty: {
                                    message: 'Factor is required'
                                }
                            }
                        },
                        icon_name: {
                            validators: {
                                notEmpty: {
                                    message: 'Icon is required'
                                },
                                file: {
                                    extension: 'jpeg,jpg,png',
                                    type: 'image/jpeg,image/png',
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
    </script>

@endpush
