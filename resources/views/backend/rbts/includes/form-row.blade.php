<div class='row'>
    {{-- START code --}}
    <div class="col-md-3">
        <div class="form-group mb-5">
            <label>@lang('inputs.code')</label>
            <div class="input-group">
                <span class="input-group-text"> <i class="fas fa-barcode"></i> </span>
                <input type="number" class="form-control" data-input-group='code' style="text-align: end" name="code" value="{{ old('code') }}"  placeholder="@lang('inputs.code')">
            </div>
            @include('layouts.includes.backend.validation_error', ['input' => 'code'])
        </div>
    </div>
    {{-- END code --}}

    {{-- START ussd --}}
    <div class="col-md-3">
        <div class="form-group mb-5">
            <label>@lang('inputs.ussd')</label>
            <div class="input-group">
                <span class="input-group-text"> <i class="fas fa-hashtag"></i> </span>
                <input type="text" class="form-control" data-input-group='ussd' name="ussd" value="{{ old('ussd') }}"  placeholder="@lang('inputs.ussd')">
            </div>
            @include('layouts.includes.backend.validation_error', ['input' => 'ussd'])
        </div>
    </div>
    {{-- END ussd --}}

    {{-- START operators --}}
    <div class="col-md-4">
        <div class="form-group mb-5">
            <label>@lang('inputs.select-data', ['data' => trans('menu.operators')])</label>
            <select class="form-select" data-control="select2" name="operator_id" data-placeholder="--- @lang('inputs.select-data', ['data' => trans('menu.operators')]) ---">
                <option value="">@lang('inputs.please-select')</option>
                @foreach ($operators as $operator)
                    <option value="{{ $operator->id }}" @selected(count($operators) == 1)>{{ $operator->fullName() }}</option>
                @endforeach
            </select>
            @include('layouts.includes.backend.validation_error', ['input' => 'operator_id'])
        </div>
    </div>
    {{-- END operators --}}

    <div class="form-group col-sm-2 pt-5">
        <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-danger repeater-delete mt-3">
            <i class="la la-trash-o fs-3"></i>Delete
        </a>
    </div>
    <hr class="w-100">
</div>
