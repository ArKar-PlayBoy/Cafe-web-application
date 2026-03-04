import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
<<<<<<< HEAD
=======

// CSRF token for all axios requests (prevents 419 errors on POST/PUT/DELETE)
const token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
}
>>>>>>> 5b466fb (more reliable and front-end changes)
