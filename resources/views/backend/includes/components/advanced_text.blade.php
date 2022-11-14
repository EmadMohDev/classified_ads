<script type="text/javascript" src="{{ assetHelper('vendors/js/editors/ckeditor/ckeditor.js') }}"></script>

<div class="form-group mb-5">
    <label class="{{ $required ?? '' }}">@lang("inputs.$name")</label>
    <textarea name="{{ $name }}" cols="{{ $cols ?? 15 }}" rows="{{ $rows ?? 10 }}" class="ckeditor"
                    placeholder='{{ $placeholder ?? trans("inputs.$name") }}' {{ $required ?? ''  }}>{{ $value ?? old("$name") }}</textarea>
    @include('layouts.includes.backend.validation_error', ['input' => $name])
</div>

