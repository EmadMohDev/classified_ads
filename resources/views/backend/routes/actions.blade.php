@if (canUser(getModel()."-edit"))
    <a href="{{ routeHelper(getModel().'.edit', $id) }}" class="btn btn-sm btn-info show-modal-form" title="@lang('buttons.assign-roles')"
        data-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top">
        <i class="fa fa-link"></i>
    </a>
@endif
