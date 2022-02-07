@extends('layouts.app')

@section('content')
    <div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
        <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url('assets/media/bg/bg-image.jpg');">
            <div class="login-form text-center p-7 position-relative overflow-hidden">
                <!--begin::Login Header-->
                <div class="d-flex flex-center mb-5">
                    <a href="#">
                        <img src="{{ asset('assets/media/logos/logo.png') }}" class="max-h-125px" alt="Logo" />
                    </a>
                </div>
                <div class="">
                    <div class="mb-10">
                        <div class="text-muted font-weight-bold">Enter your details to create your account</div>
                    </div>
                    <form method="POST" action="{{ route('register') }}" id="add_user">
                        @csrf
                        <div class="form-group row">
                            <label></label>
                            <input id="name" placeholder="Name*" type="text" class="form-control h-auto form-control-solid py-3 px-8 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label></label>
                            <input id="email" placeholder="Email*" type="email" class="form-control h-auto form-control-solid py-3 px-8 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label></label>
                            <input id="cnic_no" placeholder="CNIC No.*" type="text" class="cnic_no form-control h-auto form-control-solid py-3 px-8 @error('cnic_no') is-invalid @enderror" name="cnic_no" value="{{ old('cnic_no') }}" required>
                            @error('cnic_no')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label></label>
                            <input id="password" placeholder="Password*" type="password" class="form-control h-auto form-control-solid py-3 px-8 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label></label>
                            <input id="password-confirm" placeholder="Confirm Password*" type="password" class="form-control h-auto form-control-solid py-3 px-8" name="password_confirmation" required autocomplete="new-password">
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group d-flex flex-wrap flex-center mt-10">
                            <button id="kt_login_signup_submit" type="submit" class="btn btn-primary font-weight-bold px-9 py-3 my-3 mx-2">Sign Up</button>
                            <a  class="btn btn-light-primary font-weight-bold px-9 py-3 my-3 mx-2" href="{{ route('login') }}">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('post-scripts')
    <script>
        $(document).ready(function() {
            $(".cnic_no").inputmask({
                "mask": "99999-9999999-9",
                autoUnmask: true,
                // placeholder: "xxxxx-xxxxxxx-x"
            });
            const form = document.getElementById('add_user');
            FormValidation.formValidation(
                document.getElementById('add_user'),
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
