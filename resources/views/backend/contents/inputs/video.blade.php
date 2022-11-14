<div class="row">
    <div class="col-md-7">
        <div class="form-group my-5">
            <label class="required">@lang('inputs.video')</label>
            <input type="file" class="form-control" name="data" accept="video/*">
            @include('layouts.includes.backend.validation_error', ['input' => "data"])
        </div>

        @if ($row) {!! $row->getDataHtml() !!} @endif
    </div>

    <div class="offset-1 col-md-4">
        <div class="form-group my-5">
            <label>@lang('inputs.upload-image')</label>
            <input type="file" class="form-control" name="video_thumb" accept="image/*">
            @include('layouts.includes.backend.validation_error', ['input' => "video_thumb"])
        </div>

        @if ($row && $row->video_thumb)
            <img src="{{ url($row->video_thumb) }}" width="100%" class="img-border img-thumbnail preview-modal-image">
        @endif
    </div>
</div>
