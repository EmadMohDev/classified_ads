<ul class="nav nav-tabs nav-pills nav-line-tabs-2x my-5 fs-6 bg-secondary">
    @foreach (config('languages') as $name => $lang)
        <li class="nav-item">
            <a class="nav-link {{ $loop->first ? "active" : "" }}" data-bs-toggle="tab" href="#data-{{ $lang }}">{{ ucfirst($name) }}</a>
        </li>
    @endforeach
</ul>

<div class="tab-content px-1">
    @foreach (config('languages') as $name => $lang)
        <div class="tab-pane fade show {{ $loop->first ? "show active" : "" }}" id="data-{{ $lang }}" role="tabpanel">
            <div class="form-group mb-5">
                <label class="{{ $lang == app()->getLocale() ? "required" : "" }}">@lang('inputs.content') / @lang("menu.$name")</label>
                <input type="text" class="form-control" name="data[{{ $lang }}]" value="{{ isset($row) ? $row->getData($lang) : old("data.$lang") }}" placeholder="@lang('inputs.content') / @lang("menu.$name")" {{ $lang == app()->getLocale() ? "" : "" }}>
                @include('layouts.includes.backend.validation_error', ['input' => "data-$lang"])
            </div>
        </div>
    @endforeach
</div>
