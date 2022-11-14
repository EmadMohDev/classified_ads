@extends('backend.includes.buttons.table-buttons')

@section('table-buttons')
    @if (canUser("cities-index"))
        <a href="{{ routeHelper(getModel().'.cities.index', $id) }}" class="btn btn-info btn-sm"
            data-bs-custom-class="tooltip-dark" data-bs-placement="top" title="@lang('menu.cities')">
            <i class="fa fa-list"></i>
        </a>
    @endif
@endsection
