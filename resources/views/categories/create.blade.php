@extends('layouts.web')

@php
$title = isset($edit) ? 'Editar Categoria' : 'Nueva Categoria';
$route = isset($edit) ? 'categoryUpdate' : 'categorySave';
@endphp

@section('title', $title)

@section('content-create-category')
<div class="flex justify-center">
    <form action="{{ route($route)}}" method="POST" class="form-style">
        @csrf

        <div class="space-20"></div>

        <div class="subtitle underlined center">
            @isset($edit)
            Editar categoria
            @else
            Nueva categoria
            @endisset
        </div>

        <div class="space-10"></div>

        @isset($edit)
        <input type="hidden" name="id" value="{{ $edit->id }}">
        @endisset

        <label for="typeCategory" class="label-text">Tipo de categoria:</label>
        <select name="typeCategory" class="input-text">
            <option value="1" class="input-text">Gastos</option>
            <option value="2" class="input-text">Ingresos</option>
        </select>

        <label for="color" class="label-text">Color:</label>
        <input type="color" name="color" class="input-text" value="{{ $edit->color ?? '#000000' }}">

        <label for="name" class="label-text">Nombre:</label>
        <input type="text" name="name" class="input-text" value="{{ $edit->name ?? '' }}">

        <label for="description" class="label-text">Descripcion:</label>
        <textarea name="description" class="input-textarea" cols="29" rows="5">{{ $edit->description ?? '' }}</textarea>

        <div class="space-10"></div>

        <div class="button-box">
            <a href="{{ route('category') }}" title="Volver">
                <span class="material-symbols-outlined icon-medium hover:text-red-600 duration-300">
                    cancel
                </span>
            </a>
            <button type="submit">
                <span class="material-symbols-outlined icon-medium hover:text-green-600 duration-300">
                    check_circle
                </span>
            </button>
        </div>

        <div class="space-20"></div>

    </form>
</div>

@endsection
