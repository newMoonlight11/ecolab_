@extends('layouts.create')

@section('title', 'Registrar tipo de movimiento')

@section('back_route')
    {{ route('tipo_movimiento.index') }}
@endsection

@section('heading', 'Registrar tipo de movimiento')

@section('form_action')
    {{ route('tipo_movimiento.store') }}
@endsection

@section('form_content')
    @csrf
    @include('tipo-movimiento.form')
@endsection