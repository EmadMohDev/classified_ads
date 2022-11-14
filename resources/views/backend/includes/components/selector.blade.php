{{-- START SELECTOR --}}
<div class="form-group mb-5">
    <label class="required">@lang("inputs.$name")</label>
    <select class="form-control" data-control="select2" name="{{ $name }}" data-placeholder='--- @lang("inputs.$name") ---' required>
        @foreach ([1 => 'TRUE', 0 => 'FALSE'] as $index => $val)
            <option value="{{ $index }}" @selected(isset($value) && $value == $index || old($name) === $index)>{{ $val }}</option>
        @endforeach
    </select>
    @include('layouts.includes.backend.validation_error', ['input' => $name])
</div>
{{-- END SELECTOR --}}

<script>
    $(function() {
        $('[data-control="select2"]').select2();
    });
</script>
