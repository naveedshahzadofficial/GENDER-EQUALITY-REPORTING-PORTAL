@extends('layouts.app')
@push('title', 'Login')
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
                    <!--begin::Form-->

                    <form class="form" id="kt_login_singin_form"  method="POST" action="{{ route('login') }}">
                    @csrf
                    <!--begin::Title-->
                        <!--begin::Title-->
                        <!--begin::Form group-->
                        <div class="form-group">
                            <label  for="email" class="auth-form-label">{{ __('Username') }}<span class="color-red-700">*</span></label>

                            <input id="email" type="text" class="rounded-lg border-0 form-control @error('email') is-invalid @enderror" autocomplete="off" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Username">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>
                        <!--end::Form group-->
                        <!--begin::Form group-->
                        <div class="form-group mt-10">
                            <div class="d-flex justify-content-between mt-n5">
                                <label  for="password" class="auth-form-label">{{ __('Password') }}<span class="color-red-700">*</span></label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="auth-form-a"> {{ __('Forgot Your Password?') }}</a>
                                @endif
                            </div>

                            <input id="password" type="password" class="form-control rounded-lg border-0 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror


                        </div>
                        <!--end::Form group-->
                        <!--begin::Action-->
                        <div class="pb-lg-0 pb-5  mt-10">
                            <button type="submit" id="kt_login_singin_form_submit_button" class="btn btn-primary font-weight-bolder font-size-h6 w-100 auth-login-btn"> {{ __('Login') }}</button>
                        </div>
                        <!--end::Action-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Signin-->

            </div>
            <!--end::Wrapper-->
        </div>

        <div class="col-md-6"></div>

    </div>
    <!--end::Login-->
@endsection
