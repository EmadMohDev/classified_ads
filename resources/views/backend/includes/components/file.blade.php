<div class="form-group mb-5">
    <label class="required">@lang("inputs.$name")</label>
    <div class="input-group">
        @if ($value)
            <div class="input-group-prepend">
                <a href="{{ url($value) }}" id="show-file" target="_blank" class="btn btn-sm btn-darken-2 input-group-text"> Preview </a>
            </div>
        @endif

        <div class="custom-file">
            <input type="file" name="value" class="custom-file-input cursor-pointer form-control" onchange="previewFile(this)" accept="application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.csv, application/pdf, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
        </div>
    </div>
    @include('layouts.includes.backend.validation_error', ['input' => $name])
</div>
