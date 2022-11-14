<div class="form-group mb-y">
    <label class="required">@lang('inputs.external-link')</label>
    <input type="url" class="form-control" name="data" placeholder="www.google.com">
    @include('layouts.includes.backend.validation_error', ['input' => "data"])
</div>
