@include('layouts.includes.backend.header')

    <!--begin::Aside-->
    @include('layouts.includes.backend.asidebar')
    <!--end::Aside-->

    <!--begin::Wrapper-->
    <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
        <!--begin::Header-->
        <div id="kt_header" style="" class="header align-items-stretch">
            <!--begin::Container-->
            <div class="container-fluid d-flex align-items-stretch justify-content-between">
                <!--begin::Aside mobile toggle-->
                <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show aside menu">
                    <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_aside_mobile_toggle">
                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="currentColor" />
                                <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                </div>
                <!--end::Aside mobile toggle-->
                <!--begin::Mobile logo-->
                <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                    <a href="../../demo1/dist/index.html" class="d-lg-none">
                        <img alt="Logo" src="{{ assetHelper('') }}/media/logos/logo-2.svg" class="h-30px" />
                    </a>
                </div>
                <!--end::Mobile logo-->

                <!--begin::navbar-->
                    @include('layouts.includes.backend.navbar')
                <!--end::navbar-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Header-->
        <!--begin::Content-->
        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
            <!--begin::Toolbar-->
            @include('layouts.includes.backend.breadcrumb')
            <!--end::Toolbar-->
            <!--begin::Post-->
            <div class="post d-flex flex-column-fluid" id="kt_post">
                <!--begin::Container-->
                <div id="kt_content_container" class="container-xxl">
                    @yield('content')


                    @if (Route::has('messenger'))
                        <div style="position: fixed; left: 25px; bottom: 60px; z-index: 10">
                            <div class="d-none" id='new-message' style="padding: 10px; background: #e6e6e6; border-radius: 6px; position: absolute; left: 100%; width: max-content"></div>
                            <span class="badge badge-square badge-success p-2 h-1px w-1px position-absolute" style="top: -7px; left: -5px;" id='all-unread-messages'>{{ method_exists(auth()->user(), 'unreadMessages') ? auth()->user()->unreadMessages() : '' }}</span>

                            <a href="{{ route('messenger')}}">
                                <img style="width:35px" src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/be/Facebook_Messenger_logo_2020.svg/2048px-Facebook_Messenger_logo_2020.svg.png">
                            </a>
                        </div>
                    @endif
                </div>
                <!--end::Container-->
            </div>
            <!--end::Post-->
        </div>
        <!--end::Content-->

    @include('layouts.includes.backend.modal')

@include('layouts.includes.backend.footer')
