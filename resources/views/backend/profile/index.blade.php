@extends('layouts.backend')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('vendors/css/forms/selects/select2.min.css') }}">
@endsection

@section('content')

            @include('backend.profile.form', ['form_type' => 'info', 'bg' => 'bg-dark'])

            @include('backend.profile.form', ['form_type' => 'avatar', 'bg' => 'bg-dark'])

            @include('backend.profile.form', ['form_type' => 'password', 'bg' => 'bg-dark'])

            @hasanyrole(SUPERADMIN_ROLES)
                @include('backend.profile.form', ['form_type' => 'roles', 'bg' => 'bg-dark'])

                @include('backend.profile.form', ['form_type' => 'permissions', 'bg' => 'bg-dark'])
            @endhasanyrole
@endsection

@section('script')
    <script type="text/javascript" src="{{ assetHelper('customs/js/show-password.js') }}"></script>
    <script type="text/javascript" src="{{ assetHelper('js/scripts/forms/select/form-select2.js') }}"></script>
@endsection
