@extends('layouts.app')

@section('content')
    <!--begin::Login-->
    <div class="login login-4 wizard row mr-0">

        <div class="col-md-6">
            <!--begin::Wrapper-->
            <div class="login-content col-md-12 my-10">

                <!--begin::Logo-->
                <p class="text-center py-10">
                    <a href="{{ route('login') }}" class="login-logo pb-xl-20 pb-15">
                        <span class="auth-logo-heading-main">SDG 5<br>GENDER EQUALITY</span><br>
                        <span class="auth-logo-slogan">REPORTING PORTAL</span>
                    </a>
                </p>
                <!--end::Logo-->

                <!--begin::Signin-->
                <div class="login-form px-32">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="mb-10">
                        <h3 class="auth-form-heading">Reset Password</h3>
                    </div>

                        <form class="form" id="kt_login_reset_form" method='post' action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <!--begin::Form group-->
                        <div class="form-group">
                            <label  for="email" class="auth-form-label">{{ __('Email') }}<span class="color-red-700">*</span></label>
                            <input id="email" type="email" class="rounded-lg border-0 form-control @error('email') is-invalid @enderror" autocomplete="off" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>
                        <!--end::Form group-->

                            <div class="form-group">
                                <label  for="password" class="auth-form-label">{{ __('Password') }}<span class="color-red-700">*</span></label>
                                <input id="password" type="password" class="rounded-lg border-0 form-control @error('password') is-invalid @enderror" autocomplete="off" name="password" value="{{ old('password') }}" required   placeholder="Password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label  for="password-confirm" class="auth-form-label">{{ __('Confirm Password') }}<span class="color-red-700">*</span></label>
                                <input id="password-confirm" type="password" class="rounded-lg border-0 form-control @error('password_confirmation') is-invalid @enderror" autocomplete="off" name="password_confirmation" value="{{ old('Confirm Password') }}" required   placeholder="Confirm Password">
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>


                        <!--begin::Action-->
                        <div class="pb-lg-0 pb-5  mt-10">
                            <button type="submit" id="kt_login_forgot_submit" class="btn btn-primary font-weight-bolder font-size-h6 w-100 auth-login-btn"> {{ __('Reset Password') }}</button>
                            <a id="kt_login_forgot_cancel" class="btn btn-light-primary font-weight-bold px-9 py-2 my-3 mx-2 " href="{{ route('login') }}">Back</a>
                        </div>
                        <!--end::Action-->

                    </form>

                </div>
            </div>
        </div>
        <div class="col-md-6"></div>
    </div>
@endsection
@push('post-scripts')
    <script>
        $(document).ready(function() {
            const form = document.getElementById('kt_login_reset_form');
            FormValidation.formValidation(
                document.getElementById('kt_login_reset_form'),
                {
                    fields: {
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
                        password: {
                            validators: {
                                notEmpty: {
                                    message: 'password is required',
                                },
                            },
                        },
                        password_confirmation: {
                            validators: {
                                notEmpty: {
                                    message: 'Confirm password is required',
                                },
                                identical: {
                                    compare: function () {
                                        return form.querySelector('[name="password"]').value;
                                    },
                                    message: 'The password and its confirm are not the same',
                                },
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

        });
    </script>
@endpush

