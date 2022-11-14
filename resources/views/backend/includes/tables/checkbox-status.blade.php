<form method='post' action='{{ $route }}' class='submit-form'>
    @csrf

    <div class="form-switch">
        <input type="checkbox" class="form-check-input checkbox-change-status" @checked($value)>
    </div>
</form>
