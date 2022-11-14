{{-- START ROLE NAME --}}
<div class="form-group mb-5">
    <label class="required">@lang('inputs.name')</label>
    <div class="input-group mb-2">
        <span class="input-group-text" id="basic-addon1"><i class="la la-pencil"></i></span>
        <input type="text" class="form-control badge-text-maxlength" maxlength="40" name="name"
            value="{{ $row->name ?? old('name') }}" placeholder="@lang('inputs.name')" autocomplete="off" >
    </div>
    @include('layouts.includes.backend.validation_error', ['input' => 'name'])
</div>
{{-- START ROLE NAME --}}



