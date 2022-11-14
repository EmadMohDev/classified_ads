@extends('backend.includes.buttons.table-buttons')

@section('table-buttons')
    <a href="{{ routeHelper(getModel().'.short.url', $id) }}" title="@lang('buttons.short-link')"
        data-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top"
        class="btn btn-info btn-sm show-modal-form">
        <i class="fas fa-link"></i>
    </a>
@endsection
