<div class="card">

    <div class="card-header bg-primary"> <h4 class="card-title text-white"> <i class="fas fa-link text-white mx-3"></i> @lang('title.make short link') </h4> </div>

    <div class="card-content collpase show">
        <div class="card-body">
            <form action="{{ routeHelper('posts.short.url', $post->id) }}" method="post" class="make-short-url">
                @csrf
                <input type="hidden" name="URL" value="{{ $post->url }}">

                {{-- START URL --}}
                <div class="form-group mb-5">
                    <label>@lang('inputs.url')</label>
                    <div class="input-group">
                        <input type="text" class="form-control" value="{{ url($post->url) }}" required readonly>
                    </div>
                </div>
                {{-- START URL --}}

                {{-- START LOCATION --}}
                <div class="form-group mb-5">
                    <label class="required">@lang('inputs.select-your-location'):</label>
                    <select class="form-control" data-control="select2" name="type" data-placeholder="--- @lang('inputs.select-your-location') ---" required>
                        <option value="in">In Egypt</option>
                        <option value="out">Out Egypt</option>
                    </select>
                </div>
                {{-- END LOCATION --}}

                {{-- START URL --}}
                <div class="form-group hidden" id="short-url-parent">
                    <label>@lang('inputs.result')</label>
                    <p class="form-control copy primary" id="display-short-url" disabled data-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top" title="@lang('buttons.copy')"></p>
                </div>
                {{-- START URL --}}

                <div class="form-actions d-flex m-0" style="justify-content: space-evenly;">
                    <button type="reset" class="btn btn-warning" data-dismiss="modal" data-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top" title="@lang('buttons.reset-form')">
                        <i class="ft-repeat"></i> @lang('buttons.reset')
                    </button>

                    <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top" title="@lang('buttons.submit-form')">
                        <i class="fa fa-link"></i> @lang('buttons.short')
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>
