<!--begin::Repeater-->
<div id="kt_docs_repeater_advanced">
    <!--begin::Form group-->
    <div data-repeater-list="rbts">
        <div data-repeater-item>
            @include('backend.rbts.includes.form-row')
        </div>
    </div>
    <!--end::Form group-->

    <!--begin::Form group-->
    <div class="form-group">
        <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
            <i class="fas fa-plus"></i> إضافة
        </a>
    </div>
    <!--end::Form group-->
</div>
<!--end::Repeater-->

@push('script')
    <script src="{{ assetHelper('vendors/js/forms/repeater/jquery.repeater.min.js') }}" type="text/javascript"></script>

    <script>
        let data_repeater_create = $('a[data-repeater-create]');
        let submit_button = $('button[type="submit"]');

        $('#kt_docs_repeater_advanced').repeater({
            initEmpty: false,

            show: function () {
                $(this).slideDown();
                changeErrorName();
                disableButtons(true, '');
                $(this).find('[data-control="select2"]').select2();
            },

            hide: function (deleteElement) {
                let row = $(this);
                changeErrorName();
                swal(function() { row.slideUp(deleteElement); }, 'متأكد من الحذف؟', 'لن يتم حذف البيانات الا بعد عمل حفظ!');
            },

            ready: function(){
                changeErrorName();
                disableButtons(true, '');
                $('[data-control="select2"]').select2();
            }
        });

        function changeErrorName() {
            $('.error').each(function(key, val) {
                let name = $(this).closest('.form-group').find('[name]').attr('name')+'_error';
                name = name.replaceAll('[', '-');
                name = name.replaceAll(']', '');
                $(this).attr('id', name);
            });
        }

        $('body').on('keyup', 'input[data-input-group]', function() {
            let error = $(this).closest('.form-group').find('.error');
            error.empty();
            error.append(uniqueValue($(this)));
            error.append(codeOrUssd($(this)));
        });

        function uniqueValue(ele) {
            let validation = false;

            $.each($(`input[data-input-group='${ele.data('input-group')}']`).not(ele), function (indexInArray, valueOfElement) {
                if ($(this).val() == ele.val() && ele.val() !== '') validation = true;
            });

            return disableButtons(validation, 'This Value Is Exists');
        }

        function codeOrUssd(ele) {
            let validation = false;
            let parent = ele.closest('.row');

            if (ele.data('input-group') == 'code') {
                if (parent.find('input[data-input-group="ussd"]').val() != '' && ele.val() != '') validation = true;
            } else {
                if (parent.find('input[data-input-group="code"]').val() != '' && ele.val() != '') validation = true;
            }

            return disableButtons(validation, 'Please Select only one input Code Or Ussd');
        }

        function disableButtons(check, message)
        {
            if (check) {
                data_repeater_create.addClass('d-none');
                submit_button.attr('disabled', 'disabled');
                return message;
            } else {
                data_repeater_create.removeClass('d-none');
                submit_button.removeAttr('disabled');
                return '';
            }
        }
    </script>
@endpush
