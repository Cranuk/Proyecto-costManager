@php
$chartData = \App\Helpers\Helpers::chartExpense();
$labels = $chartData['categories'];
$color = $chartData['color'];
$totales = $chartData['total'];
@endphp

<div style="width: 400px; height: 250px; margin: auto;">
    <canvas id="balanceChart" width="400" height="250"></canvas>
</div>

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
                    , backgroundColor: @json($color)
                    , borderColor: 'rgba(40, 44, 52, 1)'
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
