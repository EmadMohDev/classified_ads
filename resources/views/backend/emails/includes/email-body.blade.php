<div class="flex-lg-row-fluid ms-lg-7 ms-xl-10" id="email-body" style="background: #fff">
    <!--begin::Card-->
    <div class="card-body">
        <a href="{{ routeHelper('emails.index') }}" class="btn btn-sm btn-light-dark float-end"> <i class="fa fa-share"></i> @lang('buttons.back')</a>

        <!--begin::Title-->
        <div class="d-flex flex-wrap gap-2 justify-content-between mb-8">
            <div class="d-flex align-items-center flex-wrap gap-2">
                <!--begin::Heading-->
                <h2 class="fw-bold me-3 my-1">{{ $email->subject }}</h2>
                <!--begin::Heading-->
            </div>
        </div>
        <!--end::Title-->
        <!--begin::Message accordion-->
        <div data-kt-inbox-message="message_wrapper">
            <!--begin::Message header-->
            <div class="d-flex flex-wrap gap-2 flex-stack cursor-pointer" data-kt-inbox-message="header">
                <!--begin::Author-->
                <div class="d-flex align-items-center">
                    <!--begin::Avatar-->
                    <div class="symbol symbol-35px me-3 symbol-circle text-center text-white bg-{{ randomColor( getFirstChars($email->notifier->name ?? "System") ) }}" style="width: 40px; height: 40px; line-height: 40px; font-size: 18px">
                        @if ($email->notifier && $email->notifier->image)
                            <img src="{{ asset($email->notifier->image) }}" alt="{{ $email->notifier->name }}"class="w-100 h-100">
                        @else
                            <span class="text-capitalize">{{ getFirstChars($email->notifier->name ?? "System") }}</span>
                        @endif
                    </div>
                    <!--end::Avatar-->
                    <div class="pe-5">
                        <!--begin::Author details-->
                        <div class="d-flex align-items-center flex-wrap gap-1">
                            <a href="#" class="fw-bolder text-dark text-hover-primary">{{ $email->notifier?->name ?? "System" }}</a>
                        </div>
                        <!--end::Author details-->
                        <!--begin::Message details-->
                        <div data-kt-inbox-message="details">
                            <span class="text-muted fw-bold">to me</span>
                            <!--begin::Menu toggle-->
                            <a href="#" class="me-1" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                <span class="svg-icon svg-icon-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </a>
                            <!--end::Menu toggle-->
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-500px p-4" data-kt-menu="true">
                                <!--begin::Table-->
                                <table class="table mb-0">
                                    <tbody>
                                        <!--begin::Subject-->
                                        <tr>
                                            <td class="text-muted">Subject</td>
                                            <td>{{ $email->subject }}</td>
                                        </tr>
                                        <!--end::Subject-->
                                        <!--begin::From-->
                                        <tr>
                                            <td class="w-75px text-muted">From</td>
                                            <td>{{ $email->notifier?->email ?? "System" }}</td>
                                        </tr>
                                        <!--end::From-->
                                        <!--begin::to-->
                                        <tr>
                                            <td class="w-75px text-muted">To</td>
                                            <td>
                                                @foreach (explode(',', $email->to) as $ro)
                                                    <li>{{ $ro }}</li>
                                                @endforeach
                                            </td>
                                        </tr>
                                        <!--end::to-->
                                        @if ($email->cc)
                                        <!--begin::cc-->
                                        <tr>
                                            <td class="w-75px text-muted">CC</td>
                                            <td>
                                                @foreach (explode(',', $email->cc) as $cc)
                                                    <li>{{ $cc }}</li>
                                                @endforeach
                                            </td>
                                        </tr>
                                        <!--end::cc-->
                                        @endif
                                        <!--begin::Date-->
                                        <tr>
                                            <td class="text-muted">Date</td>
                                            <td>{{ $email->created_at }}</td>
                                        </tr>
                                        <!--end::Date-->
                                    </tbody>
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Menu-->
                        </div>
                        <!--end::Message details-->
                        <!--begin::Preview message-->
                        <div class="text-muted fw-bold mw-450px d-none" data-kt-inbox-message="preview">With resrpect, i must disagree with Mr.Zinsser. We all know the most part of important part....</div>
                        <!--end::Preview message-->
                    </div>
                </div>
                <!--end::Author-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center flex-wrap gap-2">
                    <!--begin::Date-->
                    <span class="fw-bold text-muted text-end me-3">{{ $email->created_at }}</span>
                    <!--end::Date-->
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Message header-->
            <hr>
            <!--begin::Message content-->
            <div class="collapse fade show" data-kt-inbox-message="message">
                <div class="py-5">
                    {!! $email->body !!}

                    @if ($view)
                    {!! $view !!}
                    @endif
                </div>
            </div>
            <!--end::Message content-->
        </div>
        <!--end::Message accordion-->
    </div>
</div>


