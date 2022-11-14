@extends('layouts.backend')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('vendors/css/forms/selects/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('vendors/css/forms/toggle/switchery.min.css') }}">
@endsection

@section('content')
    <div class="content-body">
        <div class="card">

            <div class="card-header bg-primary">
                <h4 class="card-title text-white">
                    <span class="mx-1">{{ $title ?? '' }}</span>
                </h4>

                @include('backend.includes.cards.form-header')
            </div>

            @yield('form')
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ assetHelper('vendors/js/forms/extended/maxlength/bootstrap-maxlength.js') }}"></script>
    <script type="text/javascript" src="{{ assetHelper('vendors/js/forms/spinner/jquery.bootstrap-touchspin.js') }}"></script>
@endsection
