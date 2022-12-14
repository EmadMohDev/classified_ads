function playAudio(type = 'success') {
    if (! sound) return ;
    let audio;
    switch (type) {
        case "success":
            audio = new Audio(`${URL}/${successAudio}`);
            break;
        case "error":
        case "warning":
            audio = new Audio(`${URL}/${warrningAudio}`);
            break;
        default:
            audio = new Audio(`${URL}/${successAudio}`);
            break;
    }
    sound = false;
    audio.play();
}

// Initialize query to datatable in page
function rows(form = null) {
    let data = null;
    let url  = window.location.href;
    let type = "get";

    if (form) {
        data = form.serialize();
        url  = form.attr('action');
        type = form.attr('method');
    }

    $('#load-data').addClass('load');
    $.ajax({
        url: url,
        type: type,
        data: data,
        success: function(data, textStatus, jqXHR) {
            $('#load-data').empty().append(data);
        },
        error: function(jqXHR) {
            handleErrors(jqXHR);
            $('#load-data').removeClass('load');
        },
        complete: function () { $('#load-data').removeClass('load'); initPluginElements();}
    });
} // AJAX CODE TO LOAD THE DATA TABLE

function handleErrors(jqXHR, form = null)
{
    if (jqXHR.readyState == 0) return true;

    if ([401,401,402,403,404].includes(jqXHR.status))
        toast(jqXHR.responseJSON.message, jqXHR.responseJSON.title || null, 'error');

    else if (jqXHR.status == 422) { // List Validation Error
        $.each(jqXHR.responseJSON.errors, function (key, val) {
            val = Array.isArray(val) ? val[0] : val;
            form.find(`#${key.replaceAll('.', '-')}_error`).text(val).fadeIn(300);
        });
    } else if (typeof jqXHR.responseJSON !== 'undefined' && typeof jqXHR.responseJSON.line !== 'undefined') {
            toast('File: ' + jqXHR.responseJSON.file + ' (Line: ' + jqXHR.responseJSON.line + ')', jqXHR.responseJSON.message, 'error', 6000)
    } else {
        toast(jqXHR.responseJSON || jqXHR.statusText, null, 'error', 6000);
    }
}

function initPluginElements() {
    $("[data-control='select2']").select2();
    $('[data-toggle="tooltip"], [data-bs-toggle="tooltip"]').tooltip();
}

function toast(message, title = null, icon = 'error', timer = 5000)
{
    playAudio(icon);
    const Toast = Swal.mixin({
        toast: true,
        position: $('html').attr('lang') == 'ar' ? 'top-start' : 'top-end',
        showConfirmButton: false,
        showCloseButton: true,
        timer: timer,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    Toast.fire({
        icon: icon,
        title: title,
        text: message,
    });
}

function swal (callback, title = 'Are you sure?', message = "You won't be able to revert this!") {
    playAudio('warning');
    Swal.fire({
        title: title,
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            callback();
        } else {
            $('.load').removeClass('load');
        }
    });
}

$('body').on('click', '.page-reload', function (e) {
    e.preventDefault();
    $('body').addClass('load');
    location.reload();
});

$('.badge-text-maxlength').maxlength({
    alwaysShow: true,
    separator: ' of ',
    preText: 'You have ',
    postText: ' chars remaining.',
    validate: true,
    warningClass: "badge badge-success",
    limitReachedClass: "badge badge-danger",
});

$('body').on('submit', 'form', function() {
    $(this).parent().addClass('load');
});
