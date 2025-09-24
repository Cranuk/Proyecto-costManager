@extends('layouts.web')

@section('title', 'Gastos')

@section('content-expense')
<div class="header-option">
    <div class="menu-list">
        <a href="{{ route('index') }}" title="Volver">
            <i class='bx bx-arrow-back icon-medium'></i>
        </a>
        <a href="{{ route('expenseCreate')}}" title="Agregar gastos">
            <i class='bx bxs-cart-add icon-medium'></i>
        </a>
        <a href="#" id="filter-link" data-table="expenses" title="Filtrar gastos">
            <i class='bx bxs-filter-alt icon-medium'></i>
        </a>
    </div>
</div>
<br>
@if($count > 0)
<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th>Categoria</th>
                <th>Descripcion</th>
                <th>Fecha</th>
                <th>Monto</th>
                <th>Herramientas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($table as $expense)
            <tr>
                <td>
                    @foreach($categories as $category)
                    @if($category->id == $expense->category_id)
                    {{ $category->name }}
                    @endif
                    @endforeach
                </td>
                <td>{{ $expense->description }}</td>
                <td>
                    <!--NOTE: se pone la fecha que se creo dado que ahora se muestra los gastos solo del mes actual-->
                    @formatDate($expense->created_at)
                    <!--NOTE: creamos una directiva de blade para la funcion helper para formato de fecha -->
                </td>
                <td>
                    @formatCurrency($expense->amount)
                    <!--NOTE: creamos directiva blade para la funcion helper para formato de moneda -->
                </td>
                <td>
                    <div class="tools">
                        <a href="{{ route('expenseEdit', ['id'=>$expense->id]) }}">
                            <i class='bx bxs-edit-alt icon-small'></i>
                        </a>
                        <button type="button" class="btn-delete" data-id="{{ $expense->id }}" data-table="expenses" title="Eliminar gasto">
                            <i class='bx bxs-trash icon-small'></i>
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination-box">
        {{ $table->links('pagination::bootstrap-4') }}
    </div>
</div>

@else
<div class=" alert-box">
    <div class="alert alert-notice">
        <i class='bx bxs-info-square icon-head icon-medium'></i>
        No hay gastos registrados en este mes!!!
    </div>
</div>
@endif

@endsection
