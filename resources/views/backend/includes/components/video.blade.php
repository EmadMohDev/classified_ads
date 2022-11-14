<div class="form-group mb-5">
    <label class="required">@lang("inputs.". str_replace(['[', ']'], '', $name))</label>
    <div class="custom-file">
        <input type="file" class="custom-file-input cursor-pointer form-control" name="{{ $name }}" {{ $multiple ?? '' }} accept="video/*" onchange="previewFile(this)">
    </div>
    @include('layouts.includes.backend.validation_error', ['input' => "$name"])
</div>

<video controls class="w-100"> <source id="show-file" src="{{ url($value ?? '') }}"> </video>
