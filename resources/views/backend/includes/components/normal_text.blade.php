<div class="form-group mb-5">
    <label class="required">@lang("inputs.$name")</label>
    <div class="input-group mb-2">
        <span class="input-group-text"><i class="fas fa-pen-alt"></i></span>
        <input type="text" class="form-control" name="{{ $name }}" value="{{ $value ?? old($name) }}" placeholder='@lang("inputs.$name")' required>
    </div>
    @include('layouts.includes.backend.validation_error', ['input' => $name])
</div>
