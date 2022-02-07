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
					<span class="text-dark-50 font-weight-bold" id="kt_subheader_total">Change Password</span>
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
							<h3 class="card-label font-weight-bolder text-dark">Change Password</h3>
							<span class="text-muted font-weight-bold font-size-sm mt-1">Change your account password</span>
						</div>

					</div>
					<!--end::Toolbar-->
				</div>
				<!--end::Card header-->
				<!--begin::Card body-->
				<div class="card-body px-0">
					<form class="form" id="change_password_form" action="{{ route('new_password.update') }}" method="post">
						@csrf
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                    @endif
                        <!--begin::Row-->
                        <div class="row">
                            <div class="col-xl-2"></div>
                            <div class="col-xl-7 my-2">


                                <div class="form-group row">
                                    <label class="col-form-label col-3 text-lg-right text-left">Current Password</label>
                                    <div class="col-9">
                                        <input class="form-control  mb-2" value="" name='old_password' type="password" placeholder="Current password">
                                        @error('old_password')
                            <div class="error">{{ $message }}</div>
                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-3 text-lg-right text-left">New Password</label>
                                    <div class="col-9">
                                        <input class="form-control  mb-2" value="" name='password' type="password" placeholder="New password">
                                        @error('password')
                            <div class="error">{{ $message }}</div>
                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-3 text-lg-right text-left">Verify Password</label>
                                    <div class="col-9">
                                        <input class="form-control  mb-2" value="" name='confirm_password' type="password" placeholder="Confirm password">
                                        @error('confirm_password')
                            <div class="error">{{ $message }}</div>
                        @enderror
                                    </div>
                                </div>
                                <div class="card-toolbar" style="padding-left: 25.60%;">
                                    <button type="submit" class="btn btn-success mr-2">Save Changes</button>
                                    <a href="{{ route('home') }}" type="reset" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </div>
                        <!--end::Row-->
					</form>
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
		'use strict';
		// Basic Form
		$('#change_password_form').validate({
			rules: {
				old_password: "required",

				password: "required",
				confirm_password: {
					equalTo: '[name="password"]'
				}
			},
			messages: {
				old_password: {
					required: "Old Password is required."
				},
				password: {
					required: "Password is required."
				},
				confirm_password: {
					required: "Confirm Password is required."
				}
			},
			highlight: function(element) {
				$(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
			},
			success: function(element) {
				$(element).closest('.form-group').removeClass('has-danger');
			},
			errorPlacement: function(error, element) {
				if (element.attr("type") == "radio") {
					error.insertAfter(element.parent().siblings(":last"));
				} else if (element.has('option').length) {
					error.insertAfter(element.next());
				} else {
					error.insertAfter(element);
				}
			}
		});


	});
</script>
@endpush
