<div class="row">
    {{-- START EMAIL --}}
    <div class="col-md-5">
        <div class="form-group mb-5">
            <label class="required">@lang('inputs.email')</label>
            <div class="input-group mb-2">
                <span class="input-group-text"> <i class="fas fa-envelope"></i> </span>
                <input type="text" name="email" class="form-control" value="{{ auth()->user()->email }}">
            </div>
            @include('layouts.includes.backend.validation_error', ['input' => 'email'])
        </div>
    </div>
    {{-- END EMAIL --}}

    {{-- START USERNAME --}}
    <div class="col-md-5">
        <div class="form-group mb-5">
            <label class="required">@lang('inputs.name')</label>
            <div class="input-group mb-2">
                <span class="input-group-text"> <i class="fas fa-user"></i> </span>
                <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}">
            </div>
            @include('layouts.includes.backend.validation_error', ['input' => 'name'])
        </div>
    </div>
    {{-- END USERNAME --}}
</div>

{{-- START ROLES --}}
<div class="form-group mb-5">
    <label>@lang('menu.roles')</label>
    <div class="input-group mb-2">
        <span class="input-group-text"> <i class="fas fa-check"></i> </span>
        <input type="text" disabled readonly class="form-control bg-secondary" value="{{ implode(' | ', auth()->user()->roles()->pluck('name')->toArray()) }}">
    </div>
</div>
{{-- END ROLES --}}

