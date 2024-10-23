@extends('layouts.edit')

@section('title', 'Editar ítem de movimiento')

@section('back_route')
    {{ route('item_movimiento.index') }}
@endsection

@section('heading', 'Editar ítem de movimiento')

@section('form_action')
    {{ route('item_movimiento.update', $itemMovimiento->id) }}
@endsection

@section('form_content')
    @csrf
    @include('item-movimiento.form')
@endsection


