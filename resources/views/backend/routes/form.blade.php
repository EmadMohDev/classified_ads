@push('style')
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('vendors/css/forms/selects/select2.min.css') }}">
@endpush

{{-- START URI --}}
<div class="form-group mb-5">
    <label>@lang('inputs.uri')</label>
    <div class="input-group mb-2">
        <span class="input-group-text"> <i class="la la-anchor"></i> </span>
        <input class="form-control" value="{{ $row->uri ?? '' }}" disabled readonly>
    </div>
</div>
{{-- START URI --}}

<div class="row">
    {{-- START CONTROLLER --}}
    <div class="col-md-4">
        <div class="form-group mb-5">
            <label>@lang('inputs.controller')</label>
            <div class="input-group mb-2">
                <span class="input-group-text"> <i class="fa fa-gamepad"></i> </span>
                <input class="form-control" value="{{ $row->controller ?? '' }}" disabled readonly>
            </div>
        </div>
    </div>
    {{-- START CONTROLLER --}}

    {{-- START FUNCTION --}}
    <div class="col-md-4">
        <div class="form-group mb-5">
            <label>@lang('inputs.function')</label>
            <div class="input-group mb-2">
                <span class="input-group-text"> <i class="fa fa-hashtag"></i> </span>
                <input class="form-control" value="{{ $row->func ?? '' }}" disabled readonly>
            </div>
        </div>
    </div>
    {{-- START FUNCTION --}}

    {{-- START METHOD --}}
    <div class="col-md-4">
        <div class="form-group mb-5">
            <label>@lang('inputs.method')</label>
            <div class="input-group mb-2">
                <span class="input-group-text"> <i class="fa fa-meteor"></i> </span>
                <input class="form-control" value="{{ $row->method ?? '' }}" disabled readonly>
            </div>
        </div>
    </div>
    {{-- START METHOD --}}
</div>

{{-- START ROLES --}}
<div class="form-group mb-5">
    <label>
        @lang('inputs.access-data', ['model' => trans('menu.roles')])
    </label>
    <button type="button" class="btn btn-sm btn-info select-all-options float-end">un/select all</button>
    <select class="form-control w-100" name="roles[]" data-control="select2" data-placeholder="--- @lang('inputs.access-data', ['model' => trans('menu.roles')]) --- " multiple>
        @foreach ($roles as $id => $name)
        <option value="{{ $id }}" @selected($row->hasRole($id))>{{ $name }}</option>
        @endforeach
    </select>
    @include('layouts.includes.backend.validation_error', ['input' => 'permissions'])
</div>
{{-- END ROLES --}}

@push('script')
    <script type="text/javascript" src="{{ assetHelper('js/scripts/forms/select/form-select2.js') }}"></script>
@endpush
