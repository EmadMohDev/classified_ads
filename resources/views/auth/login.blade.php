@extends('layouts.auth')

@section('page_title', 'Login')

@section('content')
<form class="form w-100" method="post" action="{{ route('login') }}">
    @csrf
    <!--begin::Heading-->
    <div class="text-center mb-10">
        <!--begin::Title-->
        <h1 class="text-dark mb-3">Welcome to {{ setting('site_name') }}</h1>
        <!--end::Title-->
        <!--begin::Link-->
        @if(Route::has('register'))
            <div class="text-gray-400 fw-bold fs-4">New Here?
                <a href="{{ route('register') }}" class="link-primary fw-bolder">Create an Account</a>
            </div>
        @endif
        <!--end::Link-->
    </div>
    <!--begin::Heading-->
    <!--begin::Input group-->
    <div class="fv-row mb-10">
        <!--begin::Label-->
        <label class="form-label fs-6 fw-bolder text-dark">Email</label>
        <!--end::Label-->
        <!--begin::Input-->
        <input class="form-control form-control-lg form-control-solid" type="email" name="email" autocomplete="off" value="{{ old('email') ?? env('LOCAL_EMAIL') }}" autofocus placeholder="Type your email..." required />
        <!--end::Input-->
        @include('layouts.includes.backend.validation_error', ['input' => 'email'])
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="fv-row mb-10">
        <!--begin::Wrapper-->
        <div class="d-flex flex-stack mb-2">
            <!--begin::Label-->
            <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
            <!--end::Label-->
            @if (Route::has('password.request'))
            <!--begin::Link-->
            <a href="{{ route('password.request') }}" class="link-primary fs-6 fw-bolder">Forgot Password ?</a>
            <!--end::Link-->
            @endif
        </div>
        <!--end::Wrapper-->
        <!--begin::Input-->
        <input class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="off" value="{{ old('password') ?? env('LOCAL_PASSWORD') }}" placeholder="Type your password..." required />
        <!--end::Input-->
    </div>

    <div class="text-center">
        <!--begin::Submit button-->
        <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
            <span class="indicator-label">Continue</span>
            <span class="indicator-progress">Please wait...
            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
        </button>
        <!--end::Submit button-->
    </div>
</form>
@endsection
