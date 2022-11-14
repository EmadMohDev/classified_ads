<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
    <!--begin::Navbar-->
    <div class="d-flex align-items-stretch" id="kt_header_nav">
        <!--begin::Menu wrapper-->
        <div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
            <!--begin::Menu-->
            <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch" id="#kt_header_menu" data-kt-menu="true">
                <!--begin::Email Notification-->
                <div class="d-flex align-items-center">
                    <!--begin::Menu wrapper-->
                    <div class="form-check form-switch form-check-custom" dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}">
                        <label class="form-check-label fw-bold text-uppercase mx-3" for="change-Theme"> <i class="fas fa-sun"></i></label>
                        <input class="form-check-input" type="checkbox" value="" id="change-Theme" @checked(session('theme-dark'))
                            onclick="window.location.href='{{ route('change.theme', session('theme-dark')) }}'" />
                        <label class="form-check-label fw-bold text-uppercase mx-3" for="change-Theme"> <i class="fas fa-moon"></i></label>
                    </div>
                    <!--end::Menu wrapper-->
                </div>
                <!--end::Email Notification-->
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::Navbar-->
    <!--begin::Toolbar wrapper-->
    <div class="d-flex align-items-stretch flex-shrink-0">
        <!--begin::Email Notification-->
        <div class="d-flex align-items-center">
            <!--begin::Menu wrapper-->
            <div>
                <div class="form-check form-switch form-check-custom">
                    <input class="form-check-input" type="checkbox" value="" id="change-lang" @checked(app()->isLocale('ar'))
                        onclick="window.location.href='{{ LaravelLocalization::getLocalizedURL( (app()->isLocale('ar') ? 'en' : 'ar') , null, [], true) }}'" />
                    <label class="form-check-label fw-bold text-uppercase" for="change-lang"> <i class="flag-icon flag-icon-{{ (new App\Helpers\LaravelLocalization)->getCurrentFlagName() }}"></i> {{ app()->getLocale() }}</label>
                </div>
            </div>
            <!--end::Menu wrapper-->
        </div>
        <!--end::Email Notification-->

        <!--begin::Email Notification-->
        <div class="d-flex align-items-center ms-1 ms-lg-3">
            <!--begin::Menu wrapper-->
            <div class="btn btn-icon btn-icon-muted btn-active-light btn-active-color-primary w-30px h-30px w-md-40px h-md-40px position-relative" id="kt_drawer_chat_toggle">
                <!--begin::Svg Icon | path: icons/duotune/communication/com012.svg-->
                <span class="svg-icon svg-icon-1" id="get-emails-count">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path opacity="0.3" d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z" fill="currentColor" />
                        <rect x="6" y="12" width="7" height="2" rx="1" fill="currentColor" />
                        <rect x="6" y="7" width="12" height="2" rx="1" fill="currentColor" />
                    </svg>

                    <span class="badge badge-square badge-success p-2 h-1px w-1px position-absolute emails-unread-count">0</span>
                </span>
                <!--end::Svg Icon-->
                <span class="bullet bullet-dot bg-success h-6px w-6px position-absolute translate-middle top-0 start-50 animation-blink d-none" id="new-notification"></span>
            </div>
            <!--end::Menu wrapper-->
        </div>
        <!--end::Email Notification-->

        <!--begin::User menu-->
        <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
            <!--begin::Menu wrapper-->
            <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                <b class="mx-5">{{ auth()->user()->name }}</b>

                <img src="{{ asset(auth()->user()->image) }}" alt="user" />
            </div>
            <!--begin::User account menu-->
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="{{ routeHelper('profile.index') }}" class="menu-content d-flex align-items-center px-3">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-50px me-5">
                            <img alt="{{ auth()->user()->name }}" src="{{ asset(auth()->user()->image) }}" />
                        </div>
                        <!--end::Avatar-->
                        <!--begin::Username-->
                        <div class="d-flex flex-column overflow-hidden">
                            <div class="fw-bolder d-flex align-items-center fs-5">{{ auth()->user()->name }}
                            <span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">{{ getFirstChars(auth()->user()->roles->first()->name) }}</span></div>
                            <span class="fw-bold text-muted text-hover-primary fs-7 overflow-hidden" style="text-overflow: ellipsis; {{ app()->isLocale('ar') ? 'direction: ltr;' : '' }}">{{ auth()->user()->email }}</span>
                        </div>
                        <!--end::Username-->
                    </a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu separator-->
                <div class="separator my-2"></div>
                <!--end::Menu separator-->
                <!--begin::Menu item-->
                <div class="menu-item px-5" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
                    <a href="#" class="menu-link px-5">
                        <span class="menu-title position-relative">@lang('title.change-language')
                            <span class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0 text-capitalize">
                                <i class="flag-icon flag-icon-{{ (new App\Helpers\LaravelLocalization)->getCurrentFlagName() }}"></i> {{ app()->getLocale() }}
                            </span>
                        </span>
                    </a>

                    <!--begin::Menu sub-->
                    <div class="menu-sub menu-sub-dropdown w-175px py-4">
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <div class="menu-item px-3">
                            <a href="{{ App::getLocale() !== $localeCode ? LaravelLocalization::getLocalizedURL($localeCode, null, [], true) : 'javascript:void(0)' }}"
                                class="menu-link d-flex px-5 {{ $localeCode == app()->getLocale() ? "active" : "" }}">
                                <span class="symbol symbol-20px me-4">
                                    <i class="flag-icon flag-icon-{{ $properties['flag'] }} mx-2"></i>
                                    {{ $properties['native'] }}
                                </span>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    <!--end::Menu sub-->
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-5">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="mt-5">
                        @csrf
                        <button type="submit" class="w-100 btn text-danger px-5 text-hover-white bg-hover-dark btn-block">
                            <i class="fas fa-power-off mx-2 text-danger"></i> @lang('menu.logout')
                        </button>
                    </form>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu separator-->
                <div class="separator my-2"></div>
                <!--end::Menu separator-->
                <!--begin::Menu item-->
                {{-- <div class="menu-item px-5">
                    <div class="menu-content px-5">
                        <label class="form-check form-switch form-check-custom form-check-solid pulse pulse-success" for="kt_user_menu_dark_mode_toggle">
                            <input class="form-check-input w-30px h-20px" type="checkbox" value="1" checked name="mode" id="kt_user_menu_dark_mode_toggle" data-kt-url="{{ request()->url() }}" />
                            <span class="pulse-ring ms-n1"></span>
                            <span class="form-check-label text-gray-600 fs-7">Dark Mode</span>
                        </label>
                    </div>
                </div> --}}
                <!--end::Menu item-->
            </div>
            <!--end::User account menu-->
            <!--end::Menu wrapper-->
        </div>
        <!--end::User menu-->
    </div>
    <!--end::Toolbar wrapper-->
</div>
