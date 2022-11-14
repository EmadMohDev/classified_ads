<div class="form-group mb-5">
    <label class="required">@lang("inputs.$name")</label>
    <div class="input-group">
        <span class="input-group-text bg-blue-grey border-blue-grey white"> <i class="fa fa-link"></i> </span>
        <input type="url" class="form-control" name="{{ $name }}" placeholder="EX: www.google.com" value="{{ $value ?? old($name) }}">
    </div>
    @include('layouts.includes.backend.validation_error', ['input' => $name])
</div>


