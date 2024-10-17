@endsection

@extends('layouts.create')

@section('title', 'Crear Item Movimiento')

@section('back_route')
    {{ route('item_movimiento.index') }}
@endsection

@section('heading', 'Crear Item Movimiento')

@section('form_action')
    {{ route('item_movimiento.store') }}
@endsection

@section('form_content')
    @csrf
    @include('item-movimiento.form')
@endsection