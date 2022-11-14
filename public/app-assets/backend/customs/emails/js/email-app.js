// let next_page = null; // The Next Page For Email [ Using On Paginate And The Value Come From Response ] And Using On The Notification Icon
$(function () {
    let list_emails  = $('#load-emails');
    let data_filter = {search: null, type: "inbox", seen: null};

    $('body').on('click', '.group-message', function(e) {
        e.preventDefault();
        $('.group-message').removeClass('active');
        $(this).addClass('active');
        data_filter.type = $(this).data('group');
        if (data_filter.type == 'sent') {
            data_filter.seen = null;
            $('.group-seen-type').removeClass('active');
            $('.group-seen-type[data-group="null"]').addClass('active');
        }
        loadEmails(`${MAIN_ROUTE}`, list_emails, true, data_filter, true, "GET");
    });

    $('body').on('click', '.group-seen-type', function(e) {
        e.preventDefault();
        $('.group-seen-type').removeClass('active');
        $(this).addClass('active');
        data_filter.seen = $(this).data('group');
        data_filter.type = 'inbox';
        $('.group-message').removeClass('active');
        $('.group-message[data-group="inbox"]').addClass('active');
        loadEmails(`${MAIN_ROUTE}`, list_emails, true, data_filter, true, "GET");
    });

    // Load Email When Make Scroll
    $('#load-emails').closest('.card-body').scroll(function () {
        if (current_element != 'app') next_page = `${MAIN_ROUTE}`;
        current_element = "app";

        console.log($(this).scrollTop() + $(this).innerHeight() , $(this)[0].scrollHeight);
        if ( $(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight && next_page !== null )
            loadEmails(next_page, list_emails, true, data_filter, false, "GET");
    });

    $('body').on('keyup', '#search-in-email', function() {
        data_filter.search = $(this).val();
        loadEmails(`${MAIN_ROUTE}`, list_emails, true, data_filter, true, "GET");
    });

    if ($('#load-emails').length > 0) {
        getUrlQuery();
        loadEmails(`${MAIN_ROUTE}`, list_emails, true, data_filter, true, "GET");
    }

    function getUrlQuery()
    {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const group_message = urlParams.get('group-message');
        const group_seen_type = urlParams.get('group-seen-type');

        window.history.pushState({}, "", document.location.href.split("?")[0]);

        if (group_message != null) {
            $(`.group-message`).removeClass('active');
            $(`.group-message[data-group="${group_message}"]`).addClass('active');
            data_filter.type = group_message;
        }

        if (group_seen_type != null) {
            $(`.group-seen-type`).removeClass('active');
            $(`.group-seen-type[data-group="${group_seen_type}"]`).addClass('active');
            data_filter.seen = group_seen_type;
        }
    }
});

