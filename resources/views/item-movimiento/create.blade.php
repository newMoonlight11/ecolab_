@extends('layouts.create')

@section('title', 'Crear ítem de movimiento')

@section('back_route')
    {{ route('item_movimiento.index') }}
@endsection

@section('heading', 'Crear ítem de movimiento')

@section('form_action')
    {{ route('item_movimiento.store') }}
@endsection

@section('form_content')
    @csrf
    @include('item-movimiento.form')
@endsection