@if (canUser(getModel()."-edit"))
    <a href="{{ routeHelper(getModel().'.edit', $id) }}" title="@lang('buttons.edit')"
        data-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top"
        class="btn btn-primary btn-sm {{ $use_button_ajax ? 'show-modal-form' : '' }}">
        <i class="fas fa-pen-nib"></i>
    </a>
@endif

@if (canUser(getModel()."-destroy"))
    <form action="{{ routeHelper(getModel().'.destroy', $id) }}" method="POST" class="form-destroy  d-inline">
        {{ csrf_field() }}
        @method('delete')
        <button type="submit" class="btn btn-danger btn-sm delete" title="@lang('buttons.delete')"
            data-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top" >
            <i class="fas fa-trash"></i>
        </button>
    </form>
@endif

@yield('table-buttons')
