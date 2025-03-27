import axios from 'axios';
import Highcharts from "highcharts";
window.axios = axios;
window.Highcharts = Highcharts;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

