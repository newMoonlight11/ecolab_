@extends('layouts.create')

@section('title', 'Registrar movimiento')

@section('back_route')
    {{ route('movimientos.index') }}
@endsection

@section('heading', 'Registrar movimiento')

@section('form_action')
    {{ route('movimientos.store') }}
@endsection

@section('form_content')
    @csrf
    @include('movimiento.form')
@endsection
