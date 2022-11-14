<div class="flex-column flex-lg-row-auto w-100 w-lg-275px mb-10 mb-lg-0">
    <!--begin::Sticky aside-->
    <div class="card card-flush mb-0" data-kt-sticky="true" data-kt-sticky-name="inbox-aside-sticky" data-kt-sticky-offset="{default: false, xl: '0px'}" data-kt-sticky-width="{lg: '275px'}" data-kt-sticky-left="auto" data-kt-sticky-top="150px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95">
        <!--begin::Aside content-->
        <div class="card-body">

            <!--begin::Button-->
            <a href="{{ routeHelper('emails.create') }}" class="btn btn-primary text-uppercase w-100 mb-10">
                <i class="fa fa-share"></i>
                @lang('inputs.compose')
            </a>
            <!--end::Button-->

            <!--begin::Menu-->
            <div class="menu menu-column menu-rounded menu-state-bg menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary">

                <!--begin::Menu item-->
                <div class="menu-item mb-3">
                    <!--begin::Inbox-->
                    <a href="{{ routeHelper('emails.index') }}" class="menu-link text-dark active group-message" data-group="inbox">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/communication/com010.svg-->
                            <span class="svg-icon svg-icon-2 me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M6 8.725C6 8.125 6.4 7.725 7 7.725H14L18 11.725V12.925L22 9.725L12.6 2.225C12.2 1.925 11.7 1.925 11.4 2.225L2 9.725L6 12.925V8.725Z" fill="currentColor" />
                                    <path opacity="0.3" d="M22 9.72498V20.725C22 21.325 21.6 21.725 21 21.725H3C2.4 21.725 2 21.325 2 20.725V9.72498L11.4 17.225C11.8 17.525 12.3 17.525 12.6 17.225L22 9.72498ZM15 11.725H18L14 7.72498V10.725C14 11.325 14.4 11.725 15 11.725Z" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title fw-bolder">@lang('inputs.inbox')</span>
                        <span class="badge badge-light-success emails-unread-count">0</span>
                    </a>
                    <!--end::Inbox-->
                </div>
                <!--end::Menu item-->


                <!--begin::Menu item-->
                <div class="menu-item mb-3">
                    <!--begin::Sent-->
                    <a href="{{ routeHelper('emails.index') }}?group-message=sent" class="menu-link text-dark group-message" data-group="sent">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen016.svg-->
                            <span class="svg-icon svg-icon-2 me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M15.43 8.56949L10.744 15.1395C10.6422 15.282 10.5804 15.4492 10.5651 15.6236C10.5498 15.7981 10.5815 15.9734 10.657 16.1315L13.194 21.4425C13.2737 21.6097 13.3991 21.751 13.5557 21.8499C13.7123 21.9488 13.8938 22.0014 14.079 22.0015H14.117C14.3087 21.9941 14.4941 21.9307 14.6502 21.8191C14.8062 21.7075 14.9261 21.5526 14.995 21.3735L21.933 3.33649C22.0011 3.15918 22.0164 2.96594 21.977 2.78013C21.9376 2.59432 21.8452 2.4239 21.711 2.28949L15.43 8.56949Z" fill="currentColor" />
                                    <path opacity="0.3" d="M20.664 2.06648L2.62602 9.00148C2.44768 9.07085 2.29348 9.19082 2.1824 9.34663C2.07131 9.50244 2.00818 9.68731 2.00074 9.87853C1.99331 10.0697 2.04189 10.259 2.14054 10.4229C2.23919 10.5869 2.38359 10.7185 2.55601 10.8015L7.86601 13.3365C8.02383 13.4126 8.19925 13.4448 8.37382 13.4297C8.54839 13.4145 8.71565 13.3526 8.85801 13.2505L15.43 8.56548L21.711 2.28448C21.5762 2.15096 21.4055 2.05932 21.2198 2.02064C21.034 1.98196 20.8409 1.99788 20.664 2.06648Z" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title fw-bolder">@lang('inputs.sent')</span>
                    </a>
                    <!--end::Sent-->
                </div>
                <!--end::Menu item-->


                <hr>


                <!--begin::Menu item-->
                <div class="menu-item mb-3">
                    <!--begin::Sent-->
                    <a href="{{ routeHelper('emails.index') }}" class="menu-link text-dark active group-seen-type" data-group="null">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen016.svg-->
                            <span class="svg-icon svg-icon-2 me-3"> <i class="fa fa-list"></i> </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title fw-bolder">@lang('inputs.all')</span>
                    </a>
                    <!--end::Sent-->
                </div>
                <!--end::Menu item-->


                <!--begin::Menu item-->
                <div class="menu-item mb-3">
                    <!--begin::Sent-->
                    <a href="{{ routeHelper('emails.index') }}?group-seen-type=1" class="menu-link text-dark group-seen-type" data-group="1">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen016.svg-->
                            <span class="svg-icon svg-icon-2 me-3"> <i class="fa fa-eye"></i> </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title fw-bolder">@lang('inputs.seen')</span>
                    </a>
                    <!--end::Sent-->
                </div>
                <!--end::Menu item-->


                <!--begin::Menu item-->
                <div class="menu-item mb-3">
                    <!--begin::Sent-->
                    <a href="{{ routeHelper('emails.index') }}?group-seen-type=0" class="menu-link text-dark group-seen-type" data-group="0">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen016.svg-->
                            <span class="svg-icon svg-icon-2 me-3"> <i class="fa fa-eye-slash"></i> </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title fw-bolder">@lang('inputs.unseen')</span>
                        <span class="badge badge-light-success emails-unread-count">0</span>
                    </a>
                    <!--end::Sent-->
                </div>
                <!--end::Menu item-->


            </div>
            <!--end::Menu-->
        </div>
        <!--end::Aside content-->
    </div>
    <!--end::Sticky aside-->
</div>
