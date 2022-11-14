{{-- END ROLES --}}
<div class="col-md-12">
    <div class="form-group mb-5">
        <label>@lang('inputs.select-data', ['data' => trans('menu.roles')])</label>

        <button type="button" class="btn btn-sm btn-light-danger select-all-options float-end">un/select all</button>

        <select class="form-control" data-control="select2" id="roles" name="roles[]" multiple data-placeholder="--- @lang('inputs.select-data', ['data' => trans('menu.roles')]) ---">
            {{-- <option value="">@lang('inputs.please-select')</option> --}}
            @foreach ($roles as $id => $name)
                <option value="{{ $id }}" @selected((isset($user) && $user->hasRole($name)))>{{ $name }}</option>
            @endforeach
        </select>
        @include('layouts.includes.backend.validation_error', ['input' => 'roles'])
    </div>
</div>
{{-- END ROLES --}}
