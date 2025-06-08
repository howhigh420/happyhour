import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import * as Popper from '@popperjs/core';
  window.Popper = Popper;
  import 'bootstrap';
  import Chart from 'chart.js/auto';
  window.Chart = Chart;

  import axios from 'axios';
  window.axios = axios;
  window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
