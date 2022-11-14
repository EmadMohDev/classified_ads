@extends('layouts.backend')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('css/cropper/cropper.min.css') }}">
@endsection

@section('content')
<div class="card">
    {{-- START INCLUDE TABLE HEADER --}}
    <div class="card-header bg-info">
        <h4 class="card-title text-white">
            <i class="fa fa-crop text-white mx-3"></i>
            {{ trans('menu.'.getModel()) }}
        </h4>
    </div>
    {{-- START INCLUDE TABLE HEADER --}}

    <div class="card-content collpase show">
        <div class="card-body">

            {{-- Upload Input File --}}
            <fieldset class="col-md-9">
                <div class="input-group mb-2">
                    <button class="btn btn-dark btn-hover-rotate-end btn-sm download-cropped" type="button">
                        <i class="fa fa-download"></i> @lang('buttons.download cropped image')
                    </button>
                    <input type="file" class="form-control cursor-pointer upload-image" id="upload-image" accept="image/*">
                    <label class="btn btn-dark btn-hover-rotate-start input-group-text" for="upload-image">@lang('buttons.select picture')</label>
                </div>
            </fieldset>

            <div class="row mb-1">
                <div class="col-md-9">
                    <div class="img-container overflow-hidden">
                        <img class="main-demo-image img-fluid" src="" alt="Select Picture">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-5">
                        <div class="docs-preview clearfix">
                            <div class="img-preview preview-lg img-fluid" dir="ltr"></div>
                        </div>
                    </div>

                    <!-- <h3 class="page-header">Data:</h3> -->
                    <div class="docs-data">
                        <fieldset class="form-group mb-5">
                            <div class="input-group mb-2">
                                <span class="input-group-text">X</span>
                                <input type="number" class="form-control main-demo-dataX" placeholder="x" data-method="x">
                                <span class="input-group-text">px</span>
                            </div>
                        </fieldset>
                        <fieldset class="form-group mb-5">
                            <div class="input-group mb-2">
                                <span class="input-group-text">Y</span>
                                <input type="number" class="form-control main-demo-dataY" placeholder="y" data-method="y">
                                <span class="input-group-text">px</span>
                            </div>
                        </fieldset>
                        <fieldset class="form-group mb-5">
                            <div class="input-group mb-2">
                                <span class="input-group-text">Width</span>
                                <input type="number" class="form-control main-demo-dataWidth" placeholder="width" data-method="width">
                                <span class="input-group-text">px</span>
                            </div>
                        </fieldset>
                        <fieldset class="form-group mb-5">
                            <div class="input-group mb-2">
                                <span class="input-group-text">Height</span>
                                <input type="number" class="form-control main-demo-dataHeight" placeholder="height" data-method="height">
                                <span class="input-group-text">px</span>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button class="btn btn-dark rotate-m45-deg" type="button">
                    <i class="fas fa-undo"></i>
                    Rotate -45&deg;
                </button>

                <button class="btn btn-dark rotate-45-deg" type="button">
                    <i class="fas fa-undo"></i>
                    Rotate 45&deg;
                </button>

                <button class="btn btn-dark rotate-180-deg" type="button">
                    <i class="fas fa-sync-alt"></i>
                    Rotate 180&deg;
                </button>

                <button class="btn btn-primary flip-horizontal" type="button" data-option="1">
                    <i class="fas fa-arrows-alt-h"></i>
                    Flip
                </button>

                <button class="btn btn-primary flip-vertical" type="button" data-option="1">
                    <i class="fas fa-arrows-alt-v"></i>
                    Flip
                </button>

                <button class="btn btn-info zoom-in" type="button">
                    <i class="fas fa-search-plus"></i>
                    Zoom In
                </button>

                <button class="btn btn-info zoom-out" type="button">
                    <i class="fa fa-search-minus"></i>
                    Zoom Out
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script type="text/javascript" src="{{ assetHelper('js/cropper/cropper.min.js') }}"></script>
    <script type="text/javascript" src="{{ assetHelper('js/cropper/image-cropper.js') }}"></script>
@endpush
