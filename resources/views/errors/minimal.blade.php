<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href="../../">
		<title>@yield('title')</title>
		<meta charset="utf-8" />
		<meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
		<meta name="keywords" content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme" />
		<meta property="og:url" content="https://keenthemes.com/metronic" />
		<meta property="og:site_name" content="Keenthemes | Metronic" />
		<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
        <link rel="apple-touch-icon" href="{{ asset(setting('logo', 'media/logos/logo-1-dark.svg')) }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset(setting('logo', 'media/logos/logo-1-dark.svg')) }}">
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="{{ assetHelper('') }}/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="{{ assetHelper('') }}/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="auth-bg">
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - 404 Page-->
			<div class="d-flex flex-column flex-center flex-column-fluid p-10">
				<!--begin::Illustration-->
				<img src="{{ assetHelper('') }}/media/illustrations/sketchy-1/18.png" alt="" class="mw-100 mb-10 h-lg-450px" />
				<!--end::Illustration-->
				<!--begin::Message-->
				<h1 class="fw-bold mb-10" style="color: #A3A3C7">{{ $exception->getMessage() ?: 'This Page Not Found' }}</h1>
				<!--end::Message-->
				<!--begin::Link-->
				<div>
                    <a href="{{ routeHelper('/') }}" class="btn btn-dark"> <i class="fa fa-home"></i> @lang('buttons.return home')</a>

                    @if (auth()->check())
                    {{-- @if (auth()->check() && ! auth()->user()->getAttributes()['active']) --}}
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger px-5">
                                <i class="fa fa-power-off"></i> @lang('menu.logout')
                            </button>
                        </form>
                    @endif
                </div>

				<!--end::Link-->
			</div>
			<!--end::Authentication - 404 Page-->
		</div>
		<!--end::Root-->
		<!--end::Main-->
		<!--begin::Javascript-->
		<script>var hostUrl = "{{ assetHelper('') }}/";</script>
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="{{ assetHelper('') }}/plugins/global/plugins.bundle.js"></script>
		<script src="{{ assetHelper('') }}/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>
