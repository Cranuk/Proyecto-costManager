@php
$chartData = \App\Helpers\Helpers::chartExpense();
$labels = $chartData['categories'];
$totales = $chartData['total'];
@endphp

<canvas id="balanceChart"></canvas>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('balanceChart');

        new Chart(ctx, {
            type: 'bar'
            , data: {
                labels: @json($labels)
                , datasets: [{
                    label: 'Monto gastado ($)'
                    , data: @json($totales)
                    , backgroundColor: 'rgba(54, 162, 235, 0.6)'
                    , borderColor: 'rgba(54, 162, 235, 1)'
                    , borderWidth: 1
                }]
            }
            , options: {
                responsive: true
                , plugins: {
                    legend: {
                        display: false
                    }
                    , title: {
                        display: true
                        , text: 'Gastos por categoría en el mes actual'
                    }
                }
            }
        });
    });

</script>
