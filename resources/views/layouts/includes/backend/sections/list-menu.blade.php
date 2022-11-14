{{-- START DASHBOARD LINK --}}
@if ( !$menu->route || canUser( str_replace('.', '-', $menu->route) ) )

    <div {{ $menu->visibleSubs->count() ? 'data-kt-menu-trigger="click"' : '' }} class="menu-item menu-accordion" data-id="id_{{ $menu->id }}" data-parent="id_{{ $menu->parent_id }}" data-route="{{ ROUTE_PREFIX.$menu->route }}">
            <a class="menu-link" href="{{ $menu->route ? routeHelper($menu->route) : "#"  }}">
                <span class="menu-bullet">
                    <span class="{{ $menu->icon }}"></span>
                </span>
                <span class="menu-title">{{ $menu->name }}</span>
                @if ($menu->visibleSubs->count())<span class="menu-arrow"></span>@endif
            </a>

        @if ($menu->visibleSubs->count())
            <div class="menu-sub menu-sub-accordion menu-active-bg">
                @foreach ($menu->visibleSubs as $sub)
                    @include('layouts.includes.backend.sections.list-menu', ['menu' => $sub])
                @endforeach
            </div>
        @endif

    </div>
@endif
