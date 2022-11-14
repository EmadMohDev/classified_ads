@push('style')
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('vendors/css/pickers/pickadate/pickadate.css') }}">
@endpush

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">

        {{-- START CONTENT --}}
        <div class="form-group mb-5">
            <label class="required">@lang('inputs.select-data', ['data' => trans('menu.content')])</label>
            <select class="form-control" data-control="select2" name="content_id" data-placeholder="--- @lang('inputs.select-data', ['data' => trans('menu.content')]) ---" >
                @if (count($contents) != 1)<option value="">@lang('inputs.please-select')</option> @endif
                @foreach ($contents as $id => $title)
                    <option value="{{ $id }}" @selected(isset($row) && $row->content_id == $id || old('content_id') == $id)>{{ $title }}</option>
                @endforeach
            </select>
            @include('layouts.includes.backend.validation_error', ['input' => 'content_id'])
        </div>
        {{-- END CONTENT --}}

        {{-- START OPERATOR --}}
        <div class="form-group mb-5">
            <label class="required">@lang('inputs.select-data', ['data' => trans('menu.operator')])</label>
            <select class="form-control" data-control="select2" name="operator_id[]" {{ isset($row) ?: "multiple" }} data-placeholder="--- @lang('inputs.select-data', ['data' => trans('menu.operator')]) ---" required>
                <option value="">@lang('inputs.please-select')</option>
                @foreach ($operators as $operator)
                    <option value="{{ $operator->id }}" @selected(isset($row) && $row->operator_id == $operator->id || old('operator_id') == $operator->id)>{{ "$operator->name - {$operator->country->name}" }}</option>
                @endforeach
            </select>
            @include('layouts.includes.backend.validation_error', ['input' => 'operator_id'])
        </div>
        {{-- END OPERATOR --}}

        {{-- START PUBLISHED DATE --}}
        <div class="form-group mb-5">
            <label class="required">@lang('inputs.published_date')</label>
            <div class="input-group mb-2">
                <span class="input-group-text"> <i class="fas fa-share"></i> </span>
                <input type="text" class="form-control pickadate-selectors" name="published_date" placeholder=" @lang('inputs.published_date')" value="{{ $row->published_date ?? (old('published_date') ?? date('Y-m-d')) }}" required>
            </div>
            @include('layouts.includes.backend.validation_error', ['input' => 'published_date'])
        </div>
        {{-- END PUBLISHED DATE --}}

        {{-- START ACTIVE --}}
        <div class="form-group mb-5">
            <div>
                <div class="form-check form-switch form-check-custom">
                    <label class="required" for="active">@lang('inputs.active')</label>
                    <input type="checkbox" name="active" id="active" class="form-check-input cursor-pointer" value="1" @checked(isset($row) ? $row->active : true)>
                </div>
            </div>
            @include('layouts.includes.backend.validation_error', ['input' => 'active'])
        </div>
        {{-- END ACTIVE --}}

    </div>
</div>

@push('script')
    <script src="{{ assetHelper('vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ assetHelper('vendors/js/pickers/pickadate/picker.date.js') }}"></script>

    <script>
        $(function() {
            let min = '2022-06-20';
            let max = '2022-08-24';
            $('.pickadate-selectors').pickadate({
                labelMonthNext: 'Next month',
                labelMonthPrev: 'Previous month',
                labelMonthSelect: 'Pick a Month',
                labelYearSelect: 'Pick a Year',
                selectMonths: true,
                selectYears: true,
                format: 'yyyy-mm-dd',
                min: min,
                max: max,
                today: 'Today',
                close: 'Close',
                clear: 'Clear'
            });
        });
    </script>
@endpush