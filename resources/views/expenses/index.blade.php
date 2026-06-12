@extends('layouts.web')

@section('title', 'Gastos')

@section('content-expense')
<div class="header-option">
    <div class="menu-list">
        <a href="{{ route('expenseCreate')}}" title="Agregar gastos">
            <span class="material-symbols-outlined icon-medium hover:text-green-600 duration-300">add_box</span>
        </a>
        <a href="#" id="filter-link" data-table="expenses" title="Filtrar gastos">
            <span class="material-symbols-outlined icon-medium hover:text-amber-600 duration-300">filter_list</span>
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
                    @nameCategory($expense->category_id)
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
                        <a href="{{ route('expenseEdit', ['id'=>$expense->id]) }}" title="Editar gasto">
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
<div class="alert-box">
    <div class="alert">
        <span class="material-symbols-outlined icon-head icon-medium">
            info
        </span>
        No hay gastos registrados en este mes!!!
    </div>
</div>
@endif

@endsection
