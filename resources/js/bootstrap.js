import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */

import './echo';
Echo.join('chat')
// untuk memanggil semua user yang sedang online
    .here((users) => {
        users.forEach(user => setUserOnline(user));
    })
    .joining((user) => {
        console.log(user.name + ' online');
    })

    .leaving((user) => {
        console.log(user.name + ' offline');
    });

function setUserOnline(user) {
    const statusEl = document.querySelector(`[data-user-id="${user.id}"] .status-dot`);
    if (statusEl) {
        statusEl.classList.add('online');
        statusEl.classList.remove('offline');
    }
}

function setUserOffline(user) {
    const statusEl = document.querySelector(`[data-user-id="${user.id}"] .status-dot`);
    if (statusEl) {
        statusEl.classList.add('offline');
        statusEl.classList.remove('online');
    }
}
