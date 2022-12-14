{{-- END PERMISSIONS --}}
<div class="col-md-12">
    <div class="form-group mb-5">
        <label>@lang('inputs.select-data', ['data' => trans('menu.permissions')])</label>

        <button type="button" class="btn btn-sm btn-light-danger select-all-options float-end">un/select all</button>

        <select class="form-control" data-control="select2" id="permissions" name="permissions[]" multiple data-placeholder="--- @lang('inputs.select-data', ['data' => trans('menu.permissions')]) ---">
            {{-- <option value="">@lang('inputs.please-select')</option> --}}
            @foreach ($permissions as $id => $name)
                <option value="{{ $id }}" @selected((isset($user) && $user->haspermission($name)))>{{ $name }}</option>
            @endforeach
        </select>
        @include('layouts.includes.backend.validation_error', ['input' => 'permissions'])
    </div>
</div>
{{-- END PERMISSIONS --}}
