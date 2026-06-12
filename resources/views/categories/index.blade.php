@extends('layouts.web')

@section('title', 'Categorias')

@section('content-category')
<div class="header-option">
    <a href="{{ route('categoryCreate')}}" title="Agregar categoria">
        <span class="material-symbols-outlined icon-medium hover:text-green-600 duration-300">add_box</span>
    </a>
</div>

@if( $count > 0)
<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th>Titulo</th>
                <th>Descripcion</th>
                <th>Herramientas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($table as $category)
            @php
            $color = $category->typeCategory == 2 ? 'categorie-revenues' : 'categorie-expenses' // NOTE: Discriminamos la categorias segun su uso
            @endphp
            <tr>
                <td class="title">
                    <i class='bx bxs-purchase-tag-alt icon-medium {{ $color }}'></i>
                    {{ $category->name }}
                </td>
                <td>{{ $category->description }}</td>
                <td>
                    <div class="tools">
                        <a href="{{ route('categoryEdit', ['id'=>$category->id]) }}" title="Editar categoria">
                            <span class="material-symbols-outlined icon-small hover:text-amber-600 duration-300">edit</span>
                        </a>
                        <button type="button" class="btn-delete" data-id="{{ $category->id }}" data-table="categories" title="Eliminar categoria">
                            <span class="material-symbols-outlined icon-small hover:text-red-600 duration-300">delete</span>
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
        No hay categorias registradas!!!
    </div>
</div>
@endif

@endsection
