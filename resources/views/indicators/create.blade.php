@extends('layouts.main')
@push('title', 'Add Indicator')
@push('breadcrumb-items')
    <li class="breadcrumb-item">
        <a href="{{ route('indicators.index') }}" class="text-muted">Indicators</a>
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
                    <div class="card card-custom gutter-b ">
                        <div class="card-header">
                            <h3 class="card-title">Add Indicator</h3>

                        </div>

                        <!--begin::Form-->
                        {!! Form::open(array('id'=>'form_add_edit','route' => 'indicators.store','method'=>'POST','files' => 'true')) !!}
                        <div class="card-body">
                            <div class="row form-group">
                                <div class="col-lg-6">
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

                                <div class="col-lg-6">
                                    <label>Title <span class="color-red-700">*</span></label>
                                    <input type="text" name="indicator_title" class="form-control" placeholder="Title" value="{{ old('indicator_title') }}" />
                                    @error('indicator_title')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary custom-btn-form mr-2">Submit</button>
                            <a href="{{ route('indicators.index') }}"  class="btn btn-secondary">Cancel</a>
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
                        target_id: {
                            validators: {
                                notEmpty: {
                                    message: 'Target is required'
                                }
                            }
                        },
                        indicator_title: {
                            validators: {
                                notEmpty: {
                                    message: 'Indicator title is required'
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
