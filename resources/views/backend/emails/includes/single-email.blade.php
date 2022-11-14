@forelse ($emails as $index => $email)
    <!--begin::Wrapper-->
    <div class="single-email {{ $email->isSeen() ? "" : "unseen-email" }}">
        <a href="{{ routeHelper('emails.show', $email) }}" data-id="{{ $email->id }}">
            <div class="d-flex justify-content-start py-5 px-2">

                <!--begin::Avatar-->
                <div class="symbol symbol-35px symbol-circle text-center text-white bg-{{ randomColor( getFirstChars($email->notifier->name ?? "System") ) }}" style="width: 60px; height: 60px; line-height: 60px; font-size: 25px">
                    @if ($email->notifier && $email->notifier->image)
                        <img src="{{ asset($email->notifier->image) }}" alt="{{ $email->notifier->name }}"class="w-100 h-100">
                    @else
                        <span class="text-capitalize">{{ getFirstChars($email->notifier->name ?? "System") }}</span>
                    @endif
                </div>
                <!--end::Avatar-->

                <!--begin::User-->
                <div class="w-100 mx-2">
                    <!--begin::Details-->
                    <div class="ms-3">
                        <span class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1"> {{ $email->notifier->name ?? "System" }} </span>
                        <span class="text-muted fs-7 mb-1 mx-5">{{ $email->created_at }}</span>
                    </div>
                    <!--end::Details-->

                    <!--begin::Text-->
                    <div class="p-3 rounded text-dark w-100" data-kt-element="message-text">{{ $email->subject }}</div>
                    <!--end::Text-->
                </div>
                <!--end::User-->

            </div>
        </a>
    </div>
    <!--end::Wrapper-->
@empty
    <h5 class="text-center">No Emails</h5>
@endforelse

