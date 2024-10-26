@extends('layouts.edit')

@section('title', 'Editar movimiento')

@section('back_route')
    {{ route('movimientos.index') }}
@endsection

@section('heading', 'Editar movimiento')

@section('form_action')
    {{ route('movimientos.update', $movimiento->id) }}
@endsection

@section('form_content')
    @include('movimiento.form')
@endsection

