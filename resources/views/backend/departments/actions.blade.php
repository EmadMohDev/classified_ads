@extends('backend.includes.buttons.table-buttons')

@section('table-buttons')
    @if (canUser("users-index"))
        <a href="{{ routeHelper('departments.users.index', $id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top"
            title="@lang('menu.list-rows', ['model' => trans('menu.users')])">
            <i class="fas fa-list"></i>
        </a>
    @endif
@endsection
