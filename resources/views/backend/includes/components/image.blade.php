<div class="form-group mb-5">
    <label class="required">@lang("inputs.". str_replace(['[', ']'], '', $name))</label>
    <div class="custom-file">
        <input type="file" class="custom-file-input cursor-pointer form-control" name="{{ $name }}" {{ $multiple ?? '' }} accept="image/*" onchange="previewFile(this)">
    </div>
    @include('layouts.includes.backend.validation_error', ['input' => $name])
</div>

<img src="{{ $value ? url($value) : 'https://www.lifewire.com/thmb/2KYEaloqH6P4xz3c9Ot2GlPLuds=/1920x1080/smart/filters:no_upscale()/cloud-upload-a30f385a928e44e199a62210d578375a.jpg' }}"
            class="img-border img-thumbnail" id="show-file">
