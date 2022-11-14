@extends('backend.includes.buttons.table-buttons')

@section('table-buttons')
    @if (canUser("operators-create"))
        <a href="{{ routeHelper('countries.operators.index', $id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top"
            title="@lang('buttons.list-operators')">
            <i class="fas fa-list"></i>
        </a>
    @endif
@endsection
