@extends('layouts.web')

@section('title', 'Pagina de inicio')

@section('content-main')
@if($balances['balancePositive'] > 0)
<div class="container-balances">
    <div class="balances-label">
        <p>Ingresos</p>
        <p>Gastos</p>
        <p class="balances-total">Total</p>
    </div>
    <div class="balances-number">
        <p>@formatCurrency($balances['balancePositive'])</p>
        <p>@formatCurrency($balances['balanceNegative'])</p>
        <hr>
        <p>@formatCurrency($balances['balanceTotal'])</p>
    </div>
</div>

@else
<div class="alert-box">
    <div class="alert alert-notice">
        <i class='bx bxs-info-square icon-head icon-medium'></i>
        No hay balance en este mes!!!
    </div>
</div>
@endif
@endsection
