<div class="form-group my-5">
    <label class="required">@lang('inputs.audio')</label>
    <input type="file" class="form-control" name="data" accept="audio/*">
    @include('layouts.includes.backend.validation_error', ['input' => "data"])
</div>

@if ($row)
    {!! $row->getDataHtml() !!}
@endif
