<div class="form-actions d-flex my-5" style="justify-content: space-evenly;">
    <button type="reset" class="btn btn-dark" data-dismiss="modal" data-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top" title="@lang('buttons.reset-form')">
        <i class="fa fa-undo"></i> @lang('buttons.reset')
    </button>

    <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top" title="@lang('buttons.submit-form')">
        <i class="fa fa-save"></i> @lang('buttons.save')
    </button>

    @yield('form-buttons')
</div>
