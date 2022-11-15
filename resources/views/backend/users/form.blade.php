<div class="row">
    <div class="col-md-9">

        {{-- START USER NAME --}}
        <div class="form-group mb-5">
            <label class="required">@lang('inputs.name')</label>
            <div class="input-group mb-2">
                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                <input type="text" class="form-control" name="name" value="{{ $row->name ?? old('name') }}" placeholder="@lang('inputs.name')" required>
            </div>
            @include('layouts.includes.backend.validation_error', ['input' => 'name'])
        </div>
        {{-- START USER NAME --}}

        {{-- START EMAIL --}}
        <div class="form-group mb-5">
            <label class="required">@lang('inputs.email')</label>
            <div class="input-group mb-2">
                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                <input type="email" class="form-control" name="email" value="{{ $row->email ?? old('email') }}" placeholder="@lang('inputs.email')" required>
            </div>
            @include('layouts.includes.backend.validation_error', ['input' => 'email'])
        </div>
        {{-- END  EMAIL --}}

        {{-- START PASSWORD --}}
        <div class="form-group mb-5">
            <label class="{{ isset($row) ? '' : 'required' }}">@lang('inputs.password')</label>
            <div class="input-group mb-2">
                <span class="input-group-text show-password"> <i class="fas fa-lock"></i> </span>
                <input type="password" class="form-control" name="password" placeholder=" @lang('inputs.password')" {{ isset($row) ? '' : 'required' }}>
            </div>
            @include('layouts.includes.backend.validation_error', ['input' => 'password'])
        </div>
        {{-- END PASSWORD --}}

    </div>

    <div class="col-md-3">
        {{-- START USER IMAGE --}}
        @include('backend.includes.forms.input-file', ['image' => isset($row) && $row->image ? url($row->image) : null, 'alt' => $row->name ?? null])
        {{-- START USER IMAGE --}}
    </div>









    <div class="col-md-12">
        {{-- START ROLES --}}
        <div class="form-group mb-5">
            <label>@lang('inputs.select-data', ['data' => trans('menu.roles')])</label>
            <select class="form-control" data-control="select2" id="roles" name="roles[]" multiple data-placeholder="--- @lang('inputs.select-data', ['data' => trans('menu.roles')]) ---">
                {{-- <option value="">@lang('inputs.please-select')</option> --}}
                @foreach ($roles as $id => $name)
                    <option value="{{ $id }}" @selected((isset($row) && $row->hasRole($name)) || (is_array(old('roles')) && in_array($id, old('roles'))))>{{ $name }}</option>
                @endforeach
            </select>
            @include('layouts.includes.backend.validation_error', ['input' => 'roles'])
        </div>
        {{-- END ROLES --}}
    </div>
</div>

@push('script')
<script type="text/javascript" src="{{ assetHelper('customs/js/show-password.js') }}"></script>
@endpush
