<div class="card-header bg-info">
    <h4 class="card-title text-white">
        {!! $title ?? trans('menu.'.getModel())." : <span id='recourds-count'>".($count ?? '')."</span>" !!}
    </h4>

    @yield('back')
</div>
