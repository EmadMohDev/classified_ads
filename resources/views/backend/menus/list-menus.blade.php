<li class="list-group-item cursor-move mb-5" data-id="{{ $menu->id }}" style="border: 2px solid #1e1e2d4a;">
    <span class="order fs-3">{{ $menu->order }}</span> -
    <span class="fs-2">
        <i class="{{ $menu->icon }} fs-1 text-dark"></i> {{ $menu->getName() }}
    </span>

    @include('backend.menus.actions')

    <ul class="mt-7 nested-sortable" style="margin-right: 40px; min-height: 20px" data-parent-id="{{ $menu->id }}">
        @if ($menu->subs->count())
            @foreach ($menu->subs as $sub)
                @include('backend.menus.list-menus', ['menu' => $sub])
            @endforeach
        @endif
    </ul>
</li>
