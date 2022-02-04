$(document).ready(function() {
    function createNotificationsContent(notifications) {
        let content = '';
        if (notifications.length > 0) {
            content = `<ul class="unstyled text-start">`;
            notifications.forEach((el) => {
                content += `
                        <li>
                            <h2 class="fs-5">${el.title}</h2>
                            <p>${el.text}</p>
                        </li>
                    `;
            });
            content += '</ul>';
        } else {
            content = '<span>Non sono presenti nuove notifiche</span>';
        }
        $('#notification-dropdown>.dropdown-menu>div').html(content);
    }

    $('#notification-dropdown').on('hide.bs.dropdown', function () {
        $.post('/api/notifications/set-all-viewed');
    });

    setInterval(function () {
        $.post('/api/notifications/list', function (data) {
            if (data.notifications.length > 0) {
                $('#notification-bell>span').html(`
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        ${data.notifications.length}
                        <span class="visually-hidden">notifiche non lette</span>
                    </span>
                `);
            } else {
                $('#notification-bell>span').html('');
            }
            createNotificationsContent(data.notifications);
        });
    }, 2000);
});