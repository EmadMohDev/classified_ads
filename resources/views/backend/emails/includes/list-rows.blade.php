@forelse ($emails as $email)
    <tr class="{{ $email->isSeen() ? "" : "unseen-email" }} single-email">
        {{-- <td class="ps-9 w-30px">
            <!--begin::Checkbox-->
            <div class="form-check form-check-sm form-check-custom form-check-solid mt-3">
                <input type="checkbox" class="form-check-input check-box-id" value="{{ $email->id }}">
            </div>

            <!--end::Checkbox-->
        </td> --}}
        <!--begin::Author-->
        <td class="w-150px w-md-175px px-2">
            <a href="{{ routeHelper('emails.show', $email) }}" class="d-flex align-items-center text-dark">
                <!--begin::Avatar-->
                <div class="symbol symbol-35px me-3 symbol-circle text-center text-white bg-{{ randomColor( getFirstChars($email->notifier->name ?? "System") ) }}" style="width: 40px; height: 40px; line-height: 40px; font-size: 18px">
                    @if ($email->notifier && $email->notifier->image)
                        <img src="{{ asset($email->notifier->image) }}" alt="{{ $email->notifier->name }}"class="w-100 h-100">
                    @else
                        <span class="text-capitalize">{{ getFirstChars($email->notifier->name ?? "System") }}</span>
                    @endif
                </div>
                <!--end::Avatar-->

                <!--begin::Name-->
                <span class="fw-bold text-dark">{{ $email->notifier?->name ?? "System" }}</span>
                <!--end::Name-->
            </a>
        </td>
        <!--end::Author-->
        <!--begin::Title-->
        <td class="px-2">
            <div class="text-dark mb-1 mt-3">
                <!--begin::Heading-->
                <a href="{{ routeHelper('emails.show', $email) }}" class="text-dark">
                    <span class="fw-bolder">{{ $email->subject }}</span>
                </a>
                <!--end::Heading-->
            </div>
        </td>
        <!--end::Title-->
        <!--begin::Date-->
        <td class="w-150px text-end fs-7 pe-9 text-center px-2">
            <span class="fw-bold">{{ $email->created_at }}</span>
        </td>
        <!--end::Date-->
    </tr>

@empty
    <tr> <td colspan="5"> <h3 class="text-center"> No Emails </h3> </td> </tr>
@endforelse
