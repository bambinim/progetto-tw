function closeOffcanvas(offcanvas, backdrop) {
    $(backdrop).removeClass('show').delay(300).queue(function() {
        $(backdrop).remove();
    });
    $(offcanvas).toggleClass('open');
}

$('#navbarSideCollapse').click(function() {
    let offcanvas = $('.offcanvas-collapse');
    $(offcanvas).toggleClass('open');
    if ($(offcanvas).hasClass('open')) {
        $(offcanvas).after(`<div class="offcanvas-backdrop fade show"></div>`);
        let backdrop = $(offcanvas).next();
        $(backdrop).click(function(e) {
            closeOffcanvas(offcanvas, backdrop);
        });
    } else {
        if ($(offcanvas).next().hasClass('offcanvas-backdrop')) {
            $(offcanvas).next().remove();
        }
    }
});

$('#offcanvasCloseButton').click(function() {
    let offcanvas = $('.offcanvas-collapse');
    let backdrop = $(offcanvas).next();
    closeOffcanvas(offcanvas, backdrop);
});

$('#notification-bell').click(()=>{
    $('#notification-bell').popover({
        'title' : 'Notifiche', 
        'html' : true,
        'placement' : 'bottom',
        'content' : $("#notification-list").html()
    });
});

$('#user-icon').click(()=>{
    $('#user-icon').popover({
        'html' : true,
        'placement' : 'bottom',
        'content' : $("#user-menu").html()
    });
});

$('body').on('click', function (e) {
    $('[data-toggle=popover]').each(function () {
        // hide any open popovers when the anywhere else in the body is clicked
        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
            $(this).popover('hide');
        }
    });
});