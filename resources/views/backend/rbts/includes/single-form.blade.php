<div class='row'>
    {{-- START code --}}
    <div class="col-md-4">
        <div class="form-group mb-5">
            <label>@lang('inputs.code')</label>
            <div class="input-group">
                <span class="input-group-text"> <i class="fas fa-barcode"></i> </span>
                <input type="number" class="form-control" style="text-align: end" name="code" value="{{ $row->code ?? old('code') }}"  placeholder="@lang('inputs.code')">
            </div>
            @include('layouts.includes.backend.validation_error', ['input' => 'code'])
        </div>
    </div>
    {{-- END code --}}

    {{-- START ussd --}}
    <div class="col-md-4">
        <div class="form-group mb-5">
            <label>@lang('inputs.ussd')</label>
            <div class="input-group">
                <span class="input-group-text"> <i class="fas fa-hashtag"></i> </span>
                <input type="text" class="form-control" name="ussd" value="{{ $row->ussd ?? old('ussd') }}"  placeholder="@lang('inputs.ussd')">
            </div>
            @include('layouts.includes.backend.validation_error', ['input' => 'ussd'])
        </div>
    </div>
    {{-- END ussd --}}

    {{-- START operators --}}
    <div class="col-md-4">
        <div class="form-group mb-5">
            <label>@lang('inputs.select-data', ['data' => trans('menu.operators')])</label>
            <select class="form-select" data-control="select2" name="operator_id" data-placeholder="--- @lang('inputs.select-data', ['data' => trans('menu.operators')]) ---" required>
                <option value="">@lang('inputs.please-select')</option>
                @foreach ($operators as $operator)
                    <option value="{{ $operator->id }}" @selected($row->operator_id == $operator->id)>{{ $operator->fullName() }}</option>
                @endforeach
            </select>
            @include('layouts.includes.backend.validation_error', ['input' => 'operator_id'])
        </div>
    </div>
    {{-- END operators --}}
</div>
