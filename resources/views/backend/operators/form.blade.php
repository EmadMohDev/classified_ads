@foreach (config('languages') as $lang)
    {{-- START NAME --}}
    <div class="form-group mb-5">
        <label class=" {{ $lang == app()->getLocale() ? "required" : "" }}">@lang('inputs.name') / {{ $lang }}</label>
        <div class="input-group mb-2">
            <span class="input-group-text"> <i class="la la-pencil"></i> </span>
            <input type="text" class="form-control badge-text-maxlength" maxlength="30" name="name[{{ $lang }}]"
                value="{{ isset($row) ? $row->name($lang) : old("name.$lang") }}" placeholder="@lang('inputs.name') / {{ $lang }}" autocomplete="off" {{ $lang == app()->getLocale() ? "required" : "" }}>
        </div>
        @include('layouts.includes.backend.validation_error', ['input' => "name-$lang"])
    </div>
    {{-- START NAME --}}
@endforeach

{{-- START COUNTRIES --}}
<div class="form-group mb-5">
    <label>@lang('inputs.select-data', ['data' => trans('menu.countries')])</label>
    <select class="form-control" data-control="select2" data-dropdown-parent="#load-form" id="country_id" name="country_id" data-placeholder="--- @lang('inputs.select-data', ['data' => trans('menu.countries')]) ---">
        <option value="">@lang('inputs.please-select')</option>
        @foreach ($countries as $id => $name)
            <option value="{{ $id }}" @selected(isset($row) && $row->country_id == $id || request('country') == $id)>{{ $name }}</option>
        @endforeach
    </select>
    @include('layouts.includes.backend.validation_error', ['input' => 'country_id'])
</div>
{{-- END COUNTRIES --}}
