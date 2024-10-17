@extends('layouts.create')

@section('title', 'Crear Tipo Movimiento')

@section('back_route')
    {{ route('tipo_movimiento.index') }}
@endsection

@section('heading', 'Crear Tipo Movimiento')

@section('form_action')
    {{ route('tipo_movimiento.store') }}
@endsection

@section('form_content')
    @csrf
    @include('tipo-movimiento.form')
@endsection