function closeOffcanvas(offcanvas, backdrop) {
    $(backdrop).removeClass('show').delay(300).queue(function () {
        $(backdrop).remove();
    });
    $(offcanvas).toggleClass('open');
}

$('#navbarSideCollapse').click(function () {
    let offcanvas = $('.offcanvas-collapse');
    $(offcanvas).toggleClass('open');
    if ($(offcanvas).hasClass('open')) {
        $(offcanvas).after(`<div class="offcanvas-backdrop fade show"></div>`);
        let backdrop = $(offcanvas).next();
        $(backdrop).click(function (e) {
            closeOffcanvas(offcanvas, backdrop);
        });
    } else {
        if ($(offcanvas).next().hasClass('offcanvas-backdrop')) {
            $(offcanvas).next().remove();
        }
    }
});

$('#offcanvasCloseButton').click(function () {
    let offcanvas = $('.offcanvas-collapse');
    let backdrop = $(offcanvas).next();
    closeOffcanvas(offcanvas, backdrop);
});

$('.sidebar-account-button').click(function () {
    let ariaExpanded = $('.sidebar-account-button').attr('aria-expanded');
    if (ariaExpanded == 'false') {
        ariaExpanded = 'true';
    } else {
        ariaExpanded = 'false';
    }
    $('.sidebar-account-button').attr('aria-expanded', ariaExpanded);
    $('.sidebar-account-collapse').collapse('toggle');
    $('.sidebar-account-collapse-icon').toggleClass('rotate-180');
});

$(document).ready(function () {
    $('.scroll-row').each(function () {
        const scrollRow = this;
        const innerRow = $(scrollRow).find('.row')[0];
        if (innerRow.scrollWidth > innerRow.clientWidth) {
            let html = $(scrollRow).html();
            html += '<button aria-label="scorri verso sinistra"><span class="fas fa-chevron-left fa-lg"></span></button><button aria-label="scorri verso destra"><span class="fas fa-chevron-right fa-lg"></span></button>';
            $(scrollRow).html(html);
            let buttons = $(scrollRow).find('button');
            $(buttons[0]).click(function () {
                $(scrollRow).find('.row')[0].scrollLeft -= $(scrollRow).width();
            });
            $(buttons[1]).click(function () {
                $(scrollRow).find('.row')[0].scrollLeft += $(scrollRow).width();
            });
        }
    });
});