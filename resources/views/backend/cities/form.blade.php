<div class="row">

    <div class="col-md-12">
        <ul class="nav nav-tabs nav-pills nav-line-tabs-2x mb-5 fs-6 bg-secondary">
            @foreach (config('languages') as $name => $lang)
                <li class="nav-item">
                    <a class="nav-link {{ $loop->first ? "active" : "" }}" data-bs-toggle="tab" href="#name-{{ $lang }}">{{ ucfirst($name) }}</a>
                </li>
            @endforeach
        </ul>

        <div class="tab-content px-1">
            @foreach (config('languages') as $name => $lang)
                <div class="tab-pane fade {{ $loop->first ? "show active" : "" }}" id="name-{{ $lang }}" role="tabpanel">
                    <div class="form-group mb-5">
                        <label class="{{ $lang == app()->getLocale() ? "required" : "" }}">@lang('inputs.name') / @lang("menu.$name")</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text"> <i class="fa fa-pen-alt"></i> </span>
                            <input type="text" class="form-control" name="name[{{ $lang }}]" value="{{ isset($row) ? $row->getName($lang) : old("name.$lang") }}" placeholder="@lang('inputs.name') / @lang("menu.$name")" {{ $lang == app()->getLocale() ? "" : "" }}>
                        </div>
                        @include('layouts.includes.backend.validation_error', ['input' => "name-$lang"])
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    <div class="col-md-12">
        {{-- START GOVERNORATE --}}
        <div class="form-group mb-5">
            <label>@lang('inputs.select-data', ['data' => trans('menu.governorate')])</label>
            <select class="form-control" data-control="select2" data-dropdown-parent="#load-form" id="governorate" name="governorate_id" data-placeholder="--- @lang('inputs.select-data', ['data' => trans('menu.governorate')]) ---">
                <option value="">@lang('inputs.please-select')</option>
                @foreach ($governorates as $id => $name)
                    <option value="{{ $id }}" @selected( (isset($row) && $row->governorate_id == $id) || count($governorates) == 1 )>{{ $name }}</option>
                @endforeach
            </select>
            @include('layouts.includes.backend.validation_error', ['input' => 'governorate_id'])
        </div>
        {{-- END GOVERNORATE --}}
    </div>

</div>

