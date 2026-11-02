@extends('layouts.web')

@section('title', 'Pagina de inicio')

@section('content-main')
<div class="header-option">
    <div class="menu-list">
        <a href="#" id="filter-home-link" title="Filtrar balances">
            <span class="material-symbols-outlined icon-medium hover:text-amber-600 duration-300">
                filter_list
            </span>
        </a>
    </div>
</div>
@if($balances['balancePositive'])
<div class="flex justify-center">
    <div class="container-balances">
        <div class="balances-label">
            <p>Ingresos</p>
            <p>Gastos</p>
            <p class="balances-total">Disponible</p>
        </div>
        <div class="balances-number">
            <p>@formatCurrency($balances['balancePositive'])</p>
            <p>@formatCurrency($balances['balanceNegative'])</p>
            <hr>
            <p>@formatCurrency($balances['balanceTotal'])</p>
        </div>
    </div>
</div>


@include('chart.chartExpense')

@else
<div class="alert-box">
    <div class="alert">
        <span class="material-symbols-outlined icon-head icon-medium">
            info
        </span>
        No hay balance en este mes!!!
    </div>
</div>
@endif
@endsection
