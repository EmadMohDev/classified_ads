@push('style')
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('vendors/css/pickers/pickadate/pickadate.css') }}">
@endpush

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">




        <div class="form-group mb-5">
            <label class="required">@lang('inputs.title')</label>
            <div class="input-group mb-2">
                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                <input type="text" class="form-control" name="title" value="{{ $row->title  ?? old('title ') }}" placeholder="@lang('inputs.title ')" required>
            </div>
            @include('layouts.includes.backend.validation_error', ['input' => 'title'])
        </div>








        <div class="form-group mb-5">
            <label class="required">@lang('inputs.description')</label>
            <div class="input-group mb-2">
                <span class="input-group-text"> <i class="fa fa-id-card"></i> </span>
                <textarea class="form-control" cols="15" rows="10" class="ckeditor"  name="description"
                placeholder="@lang('inputs.description')"   required>
                {{ $row->description ?? old('description') }}</textarea>
            </div>
            @include('layouts.includes.backend.validation_error', ['input' => 'description'])
        </div>





        <div class="form-group mb-5">
            <label class="required">@lang('inputs.contact_phone_number')</label>
            <div class="input-group mb-2">
                <span class="input-group-text"> <i class="fa fa-mobile"></i> </span>
                <input type="text" class="form-control" name="contact_phone_number" value="{{ $row->contact_phone_number ?? old('contact_phone_number') }}" placeholder="@lang('inputs.contact_phone_number')" required>
            </div>
            @include('layouts.includes.backend.validation_error', ['input' => 'contact_phone_number'])
        </div>




        <div class="col-md-3">
            <label class="required">@lang('inputs.upload-image')</label>
            @include('backend.includes.forms.input-file', ['image' => isset($row) && $row->image ? url($row->image) : null, 'alt' => $row->name ?? null])
        </div>






    </div>
</div>

