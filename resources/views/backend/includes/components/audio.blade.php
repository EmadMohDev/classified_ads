<div class="form-group mb-5">
    <label class="required">@lang("inputs.$name")</label>
    <div class="custom-file">
        <input type="file" class="custom-file-input cursor-pointer form-control" name="{{ $name }}" accept="audio/*" onchange="previewFile(this)">
    </div>
    @include('layouts.includes.backend.validation_error', ['input' => $name])
</div>

<audio controls class="w-100"> <source id="show-file" src="{{ url($value ?? '') }}"> </audio>
