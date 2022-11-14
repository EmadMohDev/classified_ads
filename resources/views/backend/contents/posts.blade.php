@if (canUser("posts-index") && $content->posts_count)
    <a href="{{ routeHelper('contents.posts.index', $content) }}" class="btn btn-sm btn-success" data-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top"
        title="@lang('menu.list-rows', ['model' => trans('menu.posts')])">
        <i class="fas fa-list"></i> ({{ $content->posts_count }})
    </a>
@endif

@if (canUser("posts-create"))
    <a href="{{ routeHelper('contents.posts.create', $content) }}" class="btn btn-sm btn-dark" data-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top"
        title="@lang('menu.create-row', ['model' => trans('menu.post')])">
        <i class="fas fa-plus"></i>
    </a>
@endif
