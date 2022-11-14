<ul class="nav nav-tabs nav-pills nav-line-tabs-2x mb-5 fs-6 bg-secondary">
    @foreach (config('languages') as $name => $lang)
        <li class="nav-item">
            <a class="nav-link {{ $loop->first ? "active" : "" }}" data-bs-toggle="tab" href="#title-{{ $lang }}">{{ ucfirst($name) }}</a>
        </li>
    @endforeach
</ul>

<div class="tab-content px-1">
    @foreach (config('languages') as $name => $lang)
        <div class="tab-pane fade {{ $loop->first ? "show active" : "" }}" id="title-{{ $lang }}" role="tabpanel">
            <div class="form-group mb-5">
                <label class="{{ $lang == app()->getLocale() ? "required" : "" }}">@lang('inputs.title') / @lang("menu.$name")</label>
                <div class="input-group">
                    <span class="input-group-text"> <i class="fas fa-pen-alt"></i> </span>
                    <input type="text" class="form-control" name="title[{{ $lang }}]" value="{{ isset($row) ? $row->getTitle($lang) : old("title.$lang") }}" placeholder="@lang('inputs.title') / @lang("menu.$name")" {{ $lang == app()->getLocale() ? "" : "" }}>
                </div>
                @include('layouts.includes.backend.validation_error', ['input' => "data-$lang"])
            </div>
        </div>
    @endforeach
</div>
