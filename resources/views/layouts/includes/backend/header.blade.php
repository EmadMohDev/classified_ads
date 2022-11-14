<!DOCTYPE html>
<html class="loading" lang="{{ App::getLocale() }}"
    data-textdirection="{{ LaravelLocalization::getCurrentLocaleDirection() }}"
    dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
        <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
        <meta name="author" content="PIXINVENT">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8" />
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme" />
        <meta property="og:url" content="https://keenthemes.com/metronic" />
        <meta property="og:site_name" content="Keenthemes | Metronic" />

        <title>@lang('menu.dashboard') {{ getModel() == 'dashboard' ? '' : ' | ' . trans('menu.'.getModel()) }}</title>

        {{-- ************** START ICON ************** --}}
        <link rel="apple-touch-icon" href="{{ asset(setting('logo', 'media/logos/logo-1-dark.svg')) }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset(setting('logo', 'media/logos/logo-1-dark.svg')) }}">
        {{-- ************** START ICON ************** --}}
        <!--begin::Head-->

        @php $DARK_FOLDER = session('theme-dark') == TRUE ? 'dark.' : ''; @endphp

		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		{{-- <link href="{{ assetHelper('plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" /> --}}
		<link href="{{ assetHelper('plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ assetHelper("plugins/global/plugins.{$DARK_FOLDER}bundle.css") }}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->

        @if (App::isLocale('ar'))
            <link href="{{ assetHelper("css/style.{$DARK_FOLDER}bundle.rtl.css") }}" rel="stylesheet" type="text/css" />
        @else
		    <link href="{{ assetHelper("css/style.{$DARK_FOLDER}bundle.css") }}" rel="stylesheet" type="text/css" />
        @endif

        <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/2.3.1/css/flag-icon.min.css" rel="stylesheet"/>

        @yield('style')
        @stack('style')

        {{-- ************** START CUSTOM CSS ************** --}}
        <link rel="stylesheet" type="text/css" href="{{ assetHelper('customs/css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ assetHelper('customs/css/loading.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ assetHelper('customs/css/preview-file.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ assetHelper('customs/emails/css/email.css') }}">
        {{-- ************** END CUSTOM CSS ************** --}}

        @if ($DARK_FOLDER)
            <link rel="stylesheet" type="text/css" href="{{ assetHelper('customs/css/style-dark.css') }}">
        @endif

        @if (App::isLocale('ar'))
        <link rel="stylesheet" type="text/css" href="{{ assetHelper('customs/css/style_ar.css') }}">
        @endif

        <style>
            .select2-container .select2-selection--single {
                height: 42px;
            }

            .card {
                box-shadow: 0 0 20px 0 rgb(8 8 8 / 39%);
            }

            footer {
                box-shadow: -10px 0px 8px 0px #0404044d;
            }

        </style>

    </head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="dark-mode header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">

        <div class="blockui-message" style="width: 100%; height: 100%; position: fixed; z-index: 10000000; background: #1e1e2d; text-align: center; line-height: 60">
            <span style=" border-radius: 0.475rem; box-shadow: 0 0 50px 0 rgb(82 63 105 / 15%); background-color: #fff; color: #1e1e2d; font-weight: 600; padding: 0.85rem 1.75rem!important;">
                <span class="spinner-border text-primary w-15px h-15px"></span>
                <span class="size10" style="font-size: 16px">Loading...</span>
            </span>
        </div>

		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
