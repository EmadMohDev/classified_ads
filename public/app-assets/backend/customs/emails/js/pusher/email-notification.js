$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
}); // TO SEND THE CSRF TOKEN WITH AJAX REQUEST

const MAIN_ROUTE = `${ENDPOINT}/emails`;
let limit = 0;
let jqxhr = {abort: function () {}}; // to cancel previous ajax request if still running
let next_page = `${MAIN_ROUTE}/list`;
let page_is_loading = true;
let current_element = "notification";

/***************************************** Load New Emails In Notification Section *************************************************/
function loadEmails(page, ele, append = true, data = {}, empty = true, method = "POST") {
    if (typeof ele === 'string') ele = $(`${ele}`);
    ele.parent().addClass('load');
    jqxhr.abort();
    jqxhr = $.ajax({
        url: page,
        method: method,
        data: data,
        success: function (response) {
            next_page = response.next_page ?? null;

            if(empty && !$.isEmptyObject(data)) $(ele).empty();

            if (append) $(ele).append(response.emails);
            else $(ele).prepend(response.emails);
        },
        complete: function() { ele.parent().removeClass('load'); }
    });
} // END

/*****************************************************************************************************
 *****************************************************************************************************
 ****************************** For Email Notification Icon ******************************************
 *****************************************************************************************************
 *****************************************************************************************************/

$(function () {
    let list_notifications  = $('#list-emails');

    $('#get-emails-count').one('click', function(e) {
        e.preventDefault();
        if (! $(this).closest('li').hasClass('show')) {
            list_notifications.empty();
            loadEmails(`${MAIN_ROUTE}/list`, list_notifications);
        }
    });

    // Load Email When Make Scroll
    list_notifications.scroll(function () {
        if (current_element != 'notification') next_page = `${MAIN_ROUTE}/list`;
        current_element = "notification";

        if ( $(this).scrollTop() + $(this).innerHeight() + 1 >= $(this)[0].scrollHeight && next_page !== null)
            loadEmails(next_page, $(this));
    });

    /********************************************* To Get The Email UnReaded Count *****************************************************/

    window.Echo.channel(`private-new-email.${AUTH_ID}`).listen('NewEmail', (data) => {
        toast(data.message, null, 'success');
        let count = parseInt($('.emails-unread-count:first').text());
        $('.emails-unread-count').text(count + 1);
        list_notifications.prepend(EmailTemplate(data.email));
    });

    getEmailsCount();
    function getEmailsCount(force_lood = false) {
        $.ajax({
            url: `${MAIN_ROUTE}/count`,
            type: 'POST',
            success: function(result) {
                limit = result - parseInt($('.emails-unread-count').text());
                $('.emails-unread-count').text(result);
                if (result == 0) $('#new-notification').addClass('d-none');
                else $('#new-notification').removeClass('d-none');
            }
        });
    } // END GET EMAILS COUNT


    function EmailTemplate(email) {
        let image = email.notifier.image
                    ? `<img src="${email.notifier.image}" alt="${email.notifier.name }"class="w-100 h-100">`
                    : `<span class="text-capitalize">${email.notifier.name[0] ?? 'S'}</span>`;
        return `<div class="single-email unseen-email">
                        <a href="${window.location.href}'/emails/'${email.id}" data-id="${email.id}">
                            <div class="d-flex justify-content-start py-5 px-2">

                                <!--begin::Avatar-->
                                <div class="symbol symbol-35px symbol-circle text-center text-white bg-red" style="width: 60px; height: 60px; line-height: 60px; font-size: 25px">${image}</div>
                                <!--end::Avatar-->

                                <!--begin::User-->
                                <div class="w-100 mx-2">
                                    <!--begin::Details-->
                                    <div class="ms-3">
                                        <span class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1"> ${email.notifier.name ?? "System"} </span>
                                        <span class="text-muted fs-7 mb-1 mx-5">${email.created_at}</span>
                                    </div>
                                    <!--end::Details-->

                                    <!--begin::Text-->
                                    <div class="p-3 rounded text-dark w-100" data-kt-element="message-text">${email.subject}</div>
                                    <!--end::Text-->
                                </div>
                                <!--end::User-->

                            </div>
                        </a>
                    </div>`;
    }

});

