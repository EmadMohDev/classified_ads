@extends('layouts.backend')

@section('content')
<div class="card">
    {{-- START INCLUDE TABLE HEADER --}}
    <div class="card-header bg-info">
        <h4 class="card-title text-white">
            <i class="fa fa-paint-brush text-white mx-3"></i>
            {{ trans('menu.'.getModel()) }}
        </h4>
    </div>
    {{-- START INCLUDE TABLE HEADER --}}

    <div class="card-content collpase show">
        <div class="card-body">

            <div class="row">
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

                {{-- Quality Input Number --}}
                <fieldset class="col-md-3">
                    <div class="form-group mb-5">
                        <div class="input-group mb-2">
                            <label class="btn btn-dark btn-hover-scale input-group-text" for="image-quality">@lang('buttons.image quality')</label>
                            <input type="number" min="1" data-step="5" max="100" class="form-control bg-secondary" id="image-quality" value="90" placeholder="@lang('buttons.image quality')">
                        </div>

                    </div>
                </fieldset>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="overflow-hidden">
                        <img class="main-demo-image img-fluid" id="image-after-compresed" alt="@lang('buttons.select picture')">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    {{--
        Refreance for compressor.js:
        https://github.com/fengyuanchen/compressorjs/blob/main/README.md
        https://fengyuanchen.github.io/compressorjs/

        CDN: https://cdnjs.com/libraries/compressorjs
    --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/compressorjs/1.1.1/compressor.min.js"
        integrity="sha512-VaRptAfSxXFAv+vx33XixtIVT9A/9unb1Q8fp63y1ljF+Sbka+eMJWoDAArdm7jOYuLQHVx5v60TQ+t3EA8weA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(function() {
            let file = false;
            let quality = $('#image-quality').val();
            // Download Compresed Imaged
            $('.download-cropped').on('click',function(){
                var a = document.createElement("a");
                a.href = $('#image-after-compresed').attr('src');
                a.download = `${Math.floor(Date.now() / 1000)}.png`;
                a.click();
                a.remove;
            });

            // Change Compresed Quality
            $('#image-quality').on('change keyup', function() {
                if (quality == $(this).val()) return;
                quality = $(this).val();
                if ($(this).val() <= 100) compressor(file);
            });

            // Select Image And Compresed It
            $('#upload-image').change(function(e) {
                file = e.target.files[0];
                compressor(file);
            });

            // Compress Function
            function compressor(file)
            {
                if (!file) return;
                $('#image-after-compresed').parent('div').addClass('load');

                new Compressor(file, {
                    quality: ($('#image-quality').val() / 100),
                    success(result) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#image-after-compresed').attr('src', e.target.result);
                        }
                        reader.readAsDataURL(result);
                        $('#image-after-compresed').parent('div').removeClass('load');
                    },
                    error(err) { console.log(err.message); },
                });
            }
        });
    </script>
@endpush
