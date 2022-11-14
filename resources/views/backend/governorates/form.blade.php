<div class="row">

    <div class="col-md-12">
        @foreach (config('languages') as $name => $lang)
            <div class="form-group mb-5">
                <label class="{{ $lang == app()->getLocale() ? "required" : "" }}">@lang('inputs.name') / @lang("menu.$name")</label>
                <div class="input-group mb-2">
                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                    <input type="text" class="form-control" name="name[{{ $lang }}]" value="{{ isset($row) ? $row->getName($lang) : old("name.$lang") }}" placeholder="@lang('inputs.name') / @lang("menu.$name")" {{ $lang == app()->getLocale() ? "" : "" }}>
                </div>
                @include('layouts.includes.backend.validation_error', ['input' => "name-$lang"])
            </div>
        @endforeach
    </div>

</div>
