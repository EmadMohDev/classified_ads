{{-- START DEPARTMENT TITLE --}}
<div class="form-group mb-5">
    <label class="required">@lang('inputs.title')</label>
    <div class="input-group mb-2">
        <span class="input-group-text"> <i class="fas fa-building"></i> </span>
        <input type="text" class="form-control" name="title" value="{{ $row->title ?? old('title') }}" placeholder="@lang('inputs.title')" >
    </div>
    @include('layouts.includes.backend.validation_error', ['input' => 'title'])
</div>
{{-- START DEPARTMENT TITLE --}}

{{-- START EMAIL --}}
<div class="form-group mb-5">
    <label class="required">@lang('inputs.email')</label>
    <div class="input-group mb-2">
        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
        <input type="email" class="form-control" name="email" value="{{ $row->email ?? old('email') }}" placeholder="@lang('inputs.email')" >
    </div>
    @include('layouts.includes.backend.validation_error', ['input' => 'email'])
</div>
{{-- END  EMAIL --}}

{{-- START MANAGER --}}
<div class="form-group mb-5">
    <label class="required">Select Manager</label>
    <select  data-control="select2" class="form-control w-100" name="manager_id" data-placeholder="--- @lang('inputs.select-data', ['data' => trans('inputs.manager')]) ---" >
        <option value="">@lang('inputs.please-select')</option>
        @foreach ($users as $id => $name)
            <option value="{{ $id }}" @selected(isset($row) && $row->manager_id == $id || old('manager_id') == $id)>{{ $name }}</option>
        @endforeach
    </select>
    @include('layouts.includes.backend.validation_error', ['input' => 'manager_id'])
</div>
{{-- END MANAGER --}}

{{-- START MANAGER OF MANAGER --}}
<div class="form-group mb-5">
    <label>Select Manager of Manager</label>
    <select  data-control="select2" class="form-control w-100" name="manager_of_manager_id" data-placeholder="--- @lang('inputs.select-data', ['data' => trans('inputs.manager-of-manager')]) ---">
        <option value="">@lang('inputs.please-select')</option>
        @foreach ($users as $id => $name)
            <option value="{{ $id }}" @selected(isset($row) && $row->manager_of_manager_id == $id || old('manager_of_manager_id') == $id)>{{ $name }}</option>
        @endforeach
    </select>
    @include('layouts.includes.backend.validation_error', ['input' => 'manager_of_manager_id'])
</div>
{{-- END MANAGER OF MANAGER --}}
