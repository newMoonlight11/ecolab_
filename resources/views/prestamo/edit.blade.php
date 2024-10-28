@extends('layouts.edit')

@section('title', 'Editar préstamo')

@section('back_route')
    {{ route('prestamos.index') }}
@endsection

@section('heading', 'Editar préstamo')

@section('form_action')
    {{ route('prestamos.update', $prestamo->id) }}
@endsection

@section('form_content')
    @include('prestamo.form')
@endsection

