{{-- START WEEKEND DAYS --}}
<div class="form-group mb-5">
    <label class="required">@lang("inputs.$name")</label>
    <select class="form-control" data-control="select2" name="{{ $name }}[]" multiple data-placeholder="--- Select Days ---" required>
        @foreach (getDays() as $index => $day)
            <option value="{{ $index }}" {{ isset($value) && in_array($index, explode(',', $value)) ? "selected" : '' }}>{{ $day }}</option>
        @endforeach
    </select>
    @include('layouts.includes.backend.validation_error', ['input' => $name])
</div>
{{-- END WEEKEND DAYS --}}

<script>
    $(function() {
        $('[data-control="select2"]').select2();
    });
</script>
