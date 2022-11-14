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

    $('#get-emails-count').click(function(e) {
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
    getEmailsCount();
    setInterval(() => { getEmailsCount(true); page_is_loading = false }, 15000);
    function getEmailsCount(force_lood = false) {
        $.ajax({
            url: `${MAIN_ROUTE}/count`,
            type: 'POST',
            success: function(result) {
                limit = result - parseInt($('.emails-unread-count').text());
                $('.emails-unread-count').text(result);
                if (result == 0) $('#new-notification').addClass('d-none');
                else $('#new-notification').removeClass('d-none');

                if (limit > 0) {
                    if (!page_is_loading) {
                        sound = true;
                        toast("Have New Email", null, 'success');
                    }
                    let ele = '';
                    if ($('#kt_drawer_chat').hasClass('drawer-on'))
                        ele = $('#list-emails');

                    if (ele !== '')
                        loadEmails(`${MAIN_ROUTE}/new/${limit}`, ele, false);
                }
            }
        });
    } // END GET EMAILS COUNT

});

