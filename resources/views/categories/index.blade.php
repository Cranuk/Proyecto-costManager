@extends('layouts.web')

@section('title', 'Categorias')

@section('content-category')
<div class="header-option">
    <div class="menu-list">
        <a href="{{ route('index') }}" title="Volver">
            <i class='bx bx-arrow-back icon-medium'></i>
        </a>
        <a href="{{ route('categoryCreate')}}" title="Agregar categoria">
            <i class='bx bxs-folder-plus icon-medium'></i>
        </a>
    </div>
</div>

@if( $count > 0)
<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th>Titulo</th>
                <th>Descripcion</th>
                <th>Fecha</th>
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
                    @formatDate($category->updated_at)
                </td>
                <td>
                    <div class="tools">
                        <a href="{{ route('categoryEdit', ['id'=>$category->id]) }}">
                            <i class='bx bxs-edit-alt icon-small'></i>
                        </a>
                        <button type="button" class="btn-delete" data-id="{{ $category->id }}" data-table="categories" title="Eliminar categoria">
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
        No hay categorias registradas!!!
    </div>
</div>
@endif

@endsection
