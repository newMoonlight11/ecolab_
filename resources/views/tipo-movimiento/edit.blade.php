@extends('layouts.edit')

@section('title', 'Editar tipo de movimiento')

@section('back_route')
    {{ route('tipo_movimiento.index') }}
@endsection

@section('heading', 'Editar tipo de movimiento')

@section('form_action')
    {{ route('tipo_movimiento.update', $tipoMovimiento->id) }}
@endsection

@section('form_content')
    @include('tipo-movimiento.form')
@endsection

