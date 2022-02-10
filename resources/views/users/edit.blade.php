@extends('layouts.main')

@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" class="text-muted">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('users.index') }}" class="text-muted">Users</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted">Update</a>
                        </li>

                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>

        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="">
                <div class="">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b ">
                        <div class="card-header">
                            <h3 class="card-title">User Update</h3>

                        </div>

                        <!--begin::Form-->
                        {!! Form::model($user, ['id'=>'user_edit','method' => 'put','route' => ['users.update', $user->id]]) !!}
                        <div class="card-body">

                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Name<span class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{ $user->name }}" class="form-control" placeholder="Name" />
                                    @error('name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label>Username<span class="text-danger">*</span></label>
                                    <input type="text" name="username" value="{{ $user->username }}" class="form-control" placeholder="Username" />
                                    @error('username')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Email<span class="text-danger">*</span></label>
                                    <input type="email" value="{{ $user->email }}" name="email" class="form-control" placeholder="Email" />
                                    @error('email')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label>Cnic No.<span class="text-danger">*</span></label>
                                    <input type="text" value="{{ $user->cnic_no }}" name="cnic_no" class="form-control cnic_no" placeholder="Cnic No" />
                                    @error('cnic_no')
                                <div class="error">{{ $message }}</div>
                            @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Mobile Number<span class="text-danger">*</span></label>
                                    <input type="text" value="{{ $user->mobile_no }}" name="mobile_no" class="form-control mobile_no" placeholder="Mobile Number" />
                                    @error('mobile_no')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password" />
                                    @error('password')
                                <div class="error">{{ $message }}</div>
                            @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" />
                                    @error('password_confirmation')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6">
                                    <label>Role<span class="text-danger">*</span></label>
                                    <div class="">
                                        <select class="form-control select2" name="role_id" required>
                                            <option selected>Select Role</option>
                                            @foreach($roles as $role)
                                            <option value="{{ $role->id }}" @if($role->id == $user->role_id) selected @endif> {{ $role->role_name }} </option>
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                <div class="error">{{ $message }}</div>
                            @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Department<span class="text-danger">*</span></label>
                                    <div class="">
                                        <select class="form-control select2" name="department_id" required style="width: 100% !important;">
                                            <option selected>Select Department</option>
                                            @foreach($departments as $department)
                                                <option value="{{ $department->id }}" @if($department->id == $user->department_id) selected @endif> {{ $department->department_name }} </option>
                                            @endforeach
                                        </select>
                                        @error('department_id')
                                        <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <label>Status<span class="text-danger">*</span></label>
                                    <div class="col-form-label">
                                        <div class="radio-inline">
                                            <label class="radio radio-primary">
                                                <input type="radio" name="status" @if($user->status== '1' ) checked @endif value="1">
                                                <span></span>Active</label>


                                            <label class="radio radio-primary">
                                                <input type="radio" name="status" @if($user->status== '0' ) checked @endif value="0">
                                                <span></span>Inactive</label>
                                                @error('status')
                                <div class="error">{{ $message }}</div>
                            @enderror
                                        </div>

                                    </div>

                                </div>



                            </div>


                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary custom-btn-form mr-2">Submit</button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
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
</div>

@endsection



@push('post-scripts')
    <script>
        $(document).ready(function() {
            FormValidation.formValidation(
                document.getElementById('user_edit'),
                {
                    fields: {
                        cnic_no: {
                            validators: {
                                notEmpty: {
                                    message: 'CNIC No. is required'
                                }
                            }
                        },
                        name: {
                            validators: {
                                notEmpty: {
                                    message: 'Name is required'
                                }
                            }
                        },
                        status: {
                            validators: {
                                notEmpty: {
                                    message: 'STatus is required'
                                }
                            }
                        },
                        role_id: {
                            validators: {
                                notEmpty: {
                                    message: 'Role is required'
                                }
                            }
                        },
                        mobile_no: {
                            validators: {
                                notEmpty: {
                                    message: 'Mobile Number is required'
                                },
                                digits: {
                                    message: 'Mobile Number is not a valid digits'
                                },
                                stringLength: {
                                    min: 11,
                                    max: 11
                                },
                            }
                        },
                        email: {
                            validators: {
                                notEmpty: {
                                    message: 'Email is required'
                                },
                                emailAddress: {
                                    message: 'The value is not a valid email address'
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
