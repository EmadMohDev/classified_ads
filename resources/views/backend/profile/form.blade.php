<div class="card mb-5">
    <div class="card-header {{ $bg }}">
        <h6 class="card-title text-white">@lang("title.change $form_type")</h6>
    </div>

    <div class="card-body">
        <form action="{{ routeHelper("profile.$form_type") }}" method="post" class="submit-form" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="form_type" value="{{ $form_type }}">
            @method("PUT")

            {{-- END ROLES --}}
            @include("backend.profile.$form_type")
            {{-- END ROLES --}}

            {{-- END FORM BUTTONS --}}
            @include('backend.includes.buttons.form-buttons')
            {{-- END FORM BUTTONS --}}
        </form>
    </div>

</div>
