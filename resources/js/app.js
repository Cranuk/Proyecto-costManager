import './bootstrap';
import $ from 'jquery';

window.$ = window.jQuery = $;

// ANCHOR: mis archivos js
import './alert';
import './filter';
import './delete';

// Chart.js
import Chart from 'chart.js/auto';
window.Chart = Chart;