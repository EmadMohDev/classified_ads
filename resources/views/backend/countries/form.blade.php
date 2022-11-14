@foreach (config('languages') as $lang)
    {{-- START NAME --}}
    <div class="form-group mb-5">
        <label class=" {{ $lang == app()->getLocale() ? "required" : "" }}">@lang('inputs.name') / {{ $lang }}</label>
        <div class="input-group mb-2">
            <span class="input-group-text"> <i class="la la-pencil"></i> </span>
            <input type="text" class="form-control badge-text-maxlength" maxlength="30" name="name[{{ $lang }}]"
                value="{{ isset($row) ? $row->getName($lang) : old("name.$lang") }}" placeholder="@lang('inputs.name') / {{ $lang }}" autocomplete="off" {{ $lang == app()->getLocale() ? "required" : "" }}>
        </div>
        @include('layouts.includes.backend.validation_error', ['input' => "name-$lang"])
    </div>
    {{-- START NAME --}}
@endforeach
