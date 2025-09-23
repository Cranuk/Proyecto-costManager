@extends('layouts.web')

@php
$title = isset($edit) ? 'Editar Gasto' : 'Nuevo gasto';
$route = isset($edit) ? 'revenueUpdate' : 'revenueSave';
@endphp

@section('title', $title)

@section('content-create-revenue')

<form action="{{ route($route)}}" method="POST" class="form-style">
    @csrf

    <div class="space-20"></div>

    <div class="subtitle underlined center">
        @isset($edit)
        Editar ingreso
        @else
        Nuevo ingreso
        @endisset
    </div>

    <div class="space-10"></div>

    @isset($edit)
    <input type="hidden" name="id" value="{{ $edit->id }}">
    @endisset

    <label for="category" class="label-text">Categoria:</label>
    <select name="category" class="input-text">
        @foreach($categories as $category)
        @if($category->typeCategory == 2)
        <!--NOTE: Me trae las categorias asignadas para ingresos-->
        @if(isset($edit))
        <option class="input-text" value="{{ $category->id }}" {{ $edit->category_id == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
        </option>
        @else
        <option class="input-text" value="{{ $category->id }}">
            {{ $category->name }}
        </option>
        @endif
        @endif
        @endforeach
    </select>

    <label for="description" class="label-text">Descripcion:</label>
    <textarea name="description" class="input-textarea" cols="29" rows="5">{{ $edit->description ?? '' }}</textarea>

    <label for="amount" class="label-text">Cantidad:</label>
    <input type="number" name="amount" class="input-text" value="{{ $edit->amount ?? '' }}">

    <div class="button-box">
        <a href="{{ route('revenue') }}" title="Volver">
            <i class='bx bx-arrow-back icon-medium'></i>
        </a>
        <button type="submit">
            <i class='bx bxs-save icon-medium'></i>
        </button>
    </div>
</form>
@endsection
