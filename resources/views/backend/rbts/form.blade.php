<div class="row">
    {{-- START contents --}}
    <div class="col-md-12">
        <div class="form-group mb-5">
            <label>@lang('inputs.select-data', ['data' => trans('menu.contents')])</label>
            <select class="form-select" data-control="select2" name="content_id" data-placeholder="--- @lang('inputs.select-data', ['data' => trans('menu.contents')]) ---">
                <option value="">@lang('inputs.please-select')</option>
                @foreach ($contents as $id => $name)
                    <option value="{{ $id }}" @selected((isset($row) && $row->content_id == $id) || count($contents) == 1)>{{ $name }}</option>
                @endforeach
            </select>
            @include('layouts.includes.backend.validation_error', ['input' => 'content_id'])
        </div>
    </div>
    {{-- END contents --}}
</div>

@if (isset($row))
    @include('backend.rbts.includes.single-form')
@else
    @include('backend.rbts.includes.multi-form')
@endif
