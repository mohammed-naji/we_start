import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

let userId = 1;

Echo.private('App.Models.User.' + userId)
    .notification((notification) => {
        toastr.success(notification.msg)
    });
