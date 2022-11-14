@if ($content->contentTypeIs('Audio'))
    @if (canUser("rbts-index") && $content->rbts_count)
        <a href="{{ routeHelper('contents.rbts.index', $content) }}" class="btn btn-sm btn-info" data-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top"
            title="@lang('menu.list-rows', ['model' => trans('menu.rbts')])">
            <i class="fas fa-list"></i> ({{ $content->rbts_count }})
        </a>
    @endif

    @if (canUser("rbts-create"))
        <a href="{{ routeHelper('contents.rbts.create', $content) }}" class="btn btn-sm btn-success" data-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top"
            title="@lang('menu.create-row', ['model' => trans('menu.rbt')])">
            <i class="fas fa-plus"></i>
        </a>
    @endif
@endif
