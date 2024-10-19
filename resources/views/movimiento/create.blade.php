@extends('layouts.create')

@section('title', 'Crear Movimiento')

@section('back_route')
    {{ route('movimientos.index') }}
@endsection

@section('heading', 'Crear Movimiento')

@section('form_action')
    {{ route('movimientos.store') }}
@endsection

@section('form_content')
    @csrf
    @include('movimiento.form')
@endsection

