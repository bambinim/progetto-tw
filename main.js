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