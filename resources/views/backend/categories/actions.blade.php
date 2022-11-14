@extends('backend.includes.buttons.table-buttons')

@section('table-buttons')
    @if (canUser(getModel()."-create"))
        <a href="{{ routeHelper('categories.subs.create', $id) }}" class="btn btn-info btn-sm {{ $use_form_ajax ? 'show-modal-form' : '' }}" data-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top"
            title="@lang('buttons.create-sub-category')">
            <i class="fas fa-plus"></i>
        </a>
    @endif
@endsection
