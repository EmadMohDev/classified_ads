<div class="form-group mb-5">
    {{-- <label class="control-label required">@lang('inputs.to')</label><br> --}}
    <i class="text-info"> <small>you can select multi emails</small> </i>
    <div class="input-group flex-nowrap">
        <span class="input-group-text"> <small>@lang('inputs.to')</small> </span>
        <div class="overflow-hidden flex-grow-1">
            <select class="form-control rounded-start-0 form-select-solid" data-control="select2" data-placeholder="Choose a Send To" id="to_select" name="to[]" data-allow-clear="true" multiple required>
                @foreach ($users as $email)
                    <option value="{{ $email }}"> {{ $email }} </option>
                @endforeach
                </select>
        </div>
    </div>
    @include('layouts.includes.backend.validation_error', ['input' => "to"])
</div>

<div class="form-group mb-5">
    {{-- <label class="control-label">@lang('inputs.cc')</label><br> --}}
    <i class="text-info"> <small>you can select multi emails</small> </i>
    <div class="input-group flex-nowrap">
        <span class="input-group-text"> <small>@lang('inputs.cc')</small> </span>
        <div class="overflow-hidden flex-grow-1">
            <select class="form-control rounded-start-0 form-select-solid" data-control="select2" data-placeholder="Choose a Send To" id="cc_select" name="cc[]" data-allow-clear="true" multiple>
                @foreach ($users as $email)
                    <option value="{{ $email }}"> {{ $email }} </option>
                @endforeach
            </select>
        </div>
    </div>
    @include('layouts.includes.backend.validation_error', ['input' => "cc"])
</div>

<div class="form-group mb-5">
    {{-- <label class="control-label required">@lang('inputs.subject')</label><br> --}}
    <div class="input-group">
        <span class="input-group-text"> <i class="fas fa-heading"></i> </span>
        <input type="text" class="form-control" minlength="3" name="subject" placeholder="Email Subject">
    </div>
    @include('layouts.includes.backend.validation_error', ['input' => "subject"])
</div>

@include('backend.includes.components.advanced_text', ['required' => 'required', 'name' => 'body'])

@push('script')
    <script>
        $(function() {
                $('[data-control="select2"]').select2({
                    tags: true,
                    tokenSeparators: [',', ' '],
                    createTag: function (params) {
                        if (params.term.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/))
                            return { id: params.term, text: params.term };
                    }
                });

                $('body').on('change', '#cc_select, #to_select', function() {
                    let send_to_emails = $(this).val();
                    let another_select = $(`#to_select`);
                    if($(this).attr('id') == 'to_select')
                        another_select = $(`#cc_select`);

                    another_select.select2('destroy').find('option').attr('disabled', false);
                    $(this).find('option').attr('disabled', false);
                    if (send_to_emails)
                        send_to_emails.forEach(element => { another_select.find(`option[value="${element}"]`).attr('disabled', true);});

                    another_select.select2();
                });
        });
    </script>
@endpush
