@extends('layouts.web')

@section('title', 'Ingresos')

@section('content-revenue')
<div class="header-option">
    <div class="menu-list">
        <a href="{{ route('revenueCreate')}}" title="Agregar ingresos">
            <span class="material-symbols-outlined icon-medium hover:text-green-600 duration-300">
                add_box
            </span>
        </a>
        <a href="#" id="filter-link" data-table="revenues" title="Filtrar ingresos">
            <span class="material-symbols-outlined icon-medium hover:text-amber-600 duration-300">
                filter_list
            </span>
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
            @foreach($table as $revenue)
            <tr>
                <td>
                    @nameCategory($revenue->category_id)
                </td>
                <td>{{ $revenue->description }}</td>
                <td>
                    <!--NOTE: se pone la fecha que se creo dado que ahora se muestra los ingresos solo del mes actual-->
                    @formatDate($revenue->created_at)
                    <!--NOTE: creamos una directiva de blade para la funcion helper para formato de fecha -->
                </td>
                <td>
                    @formatCurrency($revenue->amount)
                    <!--NOTE: creamos directiva blade para la funcion helper para formato de moneda -->
                </td>
                <td>
                    <div class="tools">
                        <a href="{{ route('revenueEdit', ['id'=>$revenue->id]) }}" title="Editar ingreso">
                            <span class="material-symbols-outlined icon-medium hover:text-amber-600 duration-300">
                                edit
                            </span>
                        </a>
                        <button type="button" class="btn-delete" data-id="{{ $revenue->id }}" data-table="revenues" title="Eliminar ingreso">
                            <span class="material-symbols-outlined icon-medium hover:text-red-600 duration-300">
                                delete
                            </span>
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
    <div class="alert alert-notice">
        <span class="material-symbols-outlined icon-head icon-medium">
            info
        </span>
        No hay ingresos registrados en este mes!!!
    </div>
</div>
@endif

@endsection
