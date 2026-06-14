@php
$chartData = \App\Helpers\Helpers::chartExpense();
$labels = $chartData['categories'];
$color = $chartData['color'];
$totales = $chartData['total'];
@endphp

<div class="flex justify-center">
    <div class="w-[500px] h-[300px] bg-white m-2" style="box-shadow: 0 1px 2px 1px rgba(0, 0, 0, 0.4);">
        <canvas id="balanceChart" width="400" height="250"></canvas>
    </div>
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
