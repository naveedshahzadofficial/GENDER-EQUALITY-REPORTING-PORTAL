@extends('layouts.main')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Subheader-->
						<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
							<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
								<!--begin::Details-->
								<div class="d-flex align-items-center flex-wrap mr-2">
									<!--begin::Title-->
									<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Dashboard</h5>
									<!--end::Title-->
									<!--begin::Separator-->
									<div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
									<!--end::Separator-->
									<!--begin::Search Form-->
									<div class="d-flex align-items-center" id="kt_subheader_search">
										<span class="text-dark-50 font-weight-bold" id="kt_subheader_total">Profile</span>
									</div>
									<!--end::Search Form-->
								</div>
								<!--end::Details-->

								<!--end::Toolbar-->
							</div>
						</div>
						<!--end::Subheader-->
						<!--begin::Entry-->
						<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container">
								<!--begin::Card-->
								<div class="card card-custom">
									<!--begin::Card header-->
									<div class="card-header card-header-tabs-line nav-tabs-line-3x">
										<!--begin::Toolbar-->
										<div class="card-toolbar">

												 <div class="card-title align-items-start flex-column">
                                                <h3 class="card-label font-weight-bolder text-dark">Update Profile</h3>
                                            </div>

										</div>
										<!--end::Toolbar-->
									</div>
									<!--end::Card header-->
									<!--begin::Card body-->
									<div class="card-body px-0">
                                        <div class="col-md-12">
                                            @if (session()->has('status'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    {{ session('status') }}
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif
										    <form class="form" id="profile_update_form" action="{{ route('profile.update') }}"  method="post" enctype="multipart/form-data"  >
											@csrf
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <div class="col-xl-2"></div>
                                                    <div class="col-xl-7 my-2">
{{--
                                                        <div class="form-group row">
                                                            <label class="col-3 text-lg-right text-left">Role<span class="text-danger">*</span></label>
                                                            <div class="col-9">
                                                                <select class="form-control select2" name="role_id">
                                                                    <option value="">Select Role</option>
                                                                @foreach($roles as $role)
                                                                    <option {{ old('role_id', $role->id)== $user->role_id ? 'selected': '' }} value="{{ $role->id }}"> {{ $role->role_name }} </option>
                                                                @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
--}}
                                                        <!--begin::Group-->
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-3 text-lg-right text-left">Name<span class="text-danger">*</span></label>
                                                            <div class="col-9">
                                                                <input class="form-control form-control-lg form-control-solid" name='name' type="text" value="{{  $user->name  }}">
                                                                @error('name')
                                                            <div class="error">{{ $message }}</div>
                                                        @enderror
                                                            </div>
                                                        </div>
                                                        <!--end::Group-->
                                                        <!--begin::Group-->
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-3 text-lg-right text-left">Email Address<span class="text-danger">*</span></label>
                                                            <div class="col-9">
                                                                <div class="input-group input-group-lg input-group-solid">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="la la-at"></i>
                                                                        </span>
                                                                    </div>
                                                                    <input type="text" class="form-control form-control-lg form-control-solid"  name='email'  value="{{  $user->email   }}" placeholder="Email">
                                                                    @error('email')
                                                            <div class="error">{{ $message }}</div>
                                                        @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end::Group-->
                                                        <!--begin::Group-->
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-3 text-lg-right text-left">CNIC No.<span class="text-danger">*</span></label>
                                                            <div class="col-9">
                                                                <div class="input-group input-group-lg input-group-solid">
                                                                    <input type="text"  class="form-control form-control-lg form-control-solid cnic_no" name="cnic_no" placeholder="cnic_no" value="{{  $user->cnic_no   }}">
                                                                    @error('cnic_no')
                                                            <div class="error">{{ $message }}</div>
                                                        @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--begin::Group-->
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-3 text-lg-right text-left">Mobile Number</label>
                                                            <div class="col-9">
                                                                <div class="input-group input-group-lg input-group-solid">
                                                                    <div class="input-group-prepend">
																			<span class="input-group-text">
																				<i class="la la-phone"></i>
																			</span>
                                                                    </div>
                                                                    <input type="text" class="form-control form-control-lg form-control-solid mobile_no" name='mobile_no'  value="{{  $user->mobile_no   }}" placeholder="Mobile No.">
                                                                    @error('mobile_no')
                                                                    <div class="error">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end::Group-->
                                                        <div class="card-toolbar" style="padding-left: 25.60%;">
                                                            <button type="submit" class="btn btn-success mr-2">Save Changes</button>
                                                            <a href="{{ route('home') }}" type="reset" class="btn btn-secondary">Cancel</a>
                                                        </div>
                                                        <!--end::Group-->
                                                    </div>
                                                </div>
                                                <!--end::Row-->
										</form>
                                        </div>
									</div>
									<!--begin::Card body-->
								</div>
								<!--end::Card-->
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
            document.getElementById('profile_update_form'),
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

