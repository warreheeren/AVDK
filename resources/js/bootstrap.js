import axios from 'axios';
import { Ziggy } from './ziggy';

window.Ziggy = Ziggy;
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
