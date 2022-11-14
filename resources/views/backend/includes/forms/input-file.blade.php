{{-- <div class="form-group mb-5">
    <label class="{{ $class ?? '' }}">@lang('inputs.upload-image')</label>
    <div id="file-preview">
        <input type="file" name="{{ $name ?? " image" }}" class="form-control input-image" accept="image/*"
            onchange="previewFile(this)" {{ isset($required) && $required ? "required" : "" }}>
        <div>
            <img src="{{ $image ?? 'https://www.lifewire.com/thmb/2KYEaloqH6P4xz3c9Ot2GlPLuds=/1920x1080/smart/filters:no_upscale()/cloud-upload-a30f385a928e44e199a62210d578375a.jpg' }}"
                class="img-border img-thumbnail" id="show-file" alt="{{ $alt ?? " Image" }}">
        </div>
    </div>
    @include('layouts.includes.backend.validation_error', ['input' => 'image'])
</div> --}}


<!--begin::Image input-->
<div class="image-input image-input-empty" data-kt-image-input="true"
    style="background-image: url(/app-assets/backend/media/svg/avatars/blank.svg)">
    <!--begin::Image preview wrapper-->
    <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ $image }})"></div>
    <!--end::Image preview wrapper-->

    <!--begin::Edit button-->
    <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
        data-kt-image-input-action="change" data-toggle="tooltip" data-bs-dismiss="click" title="Change avatar">
        <i class="bi bi-pencil-fill fs-7"></i>

        <!--begin::Inputs-->
        <input type="file" name="{{ $name ?? " image" }}" accept="image/*" />
        <input type="hidden" name="avatar_remove" />
        <!--end::Inputs-->
    </label>
    <!--end::Edit button-->

    <!--begin::Cancel button-->
    <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
        data-kt-image-input-action="cancel" data-toggle="tooltip" data-bs-dismiss="click" title="Cancel avatar">
        <i class="bi bi-x fs-2"></i>
    </span>
    <!--end::Cancel button-->

    <!--begin::Remove button-->
    <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
        data-kt-image-input-action="remove" data-toggle="tooltip" data-bs-dismiss="click" title="Remove avatar">
        <i class="bi bi-x fs-2"></i>
    </span>
    <!--end::Remove button-->
</div>
<!--end::Image input-->
