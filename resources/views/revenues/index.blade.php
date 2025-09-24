@extends('layouts.web')

@section('title', 'Ingresos')

@section('content-revenue')
<div class="header-option">
    <div class="menu-list">
        <a href="{{ route('index') }}" title="Volver">
            <i class='bx bx-arrow-back icon-medium'></i>
        </a>
        <a href="{{ route('revenueCreate')}}" title="Agregar ingresos">
            <i class='bx bxs-cart-add icon-medium'></i>
        </a>
    </div>
</div>


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
                    @foreach($categories as $category)
                    @if($category->id == $revenue->category_id)
                    {{ $category->name }}
                    @endif
                    @endforeach
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
                        <a href="{{ route('revenueEdit', ['id'=>$revenue->id]) }}">
                            <i class='bx bxs-edit-alt icon-small'></i>
                        </a>
                        <button type="button" class="btn-delete" data-id="{{ $revenue->id }}" data-table="revenues" title="Eliminar ingreso">
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
    <div class="alert alert-notice">
        <i class='bx bxs-info-square icon-head icon-medium'></i>
        No hay ingresos registrados en este mes!!!
    </div>
</div>
@endif

@endsection
