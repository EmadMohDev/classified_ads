@extends('backend.includes.buttons.table-buttons')

@section('table-buttons')
    @if (canUser(getModel()."-show"))
        <a href="{{ routeHelper(getModel().'.show', $id) }}" class="btn btn-info btn-sm" title="@lang('buttons.cover')"
            data-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top">
            <i class="fa fa-eye"></i>
        </a>
    @endif
@endsection
