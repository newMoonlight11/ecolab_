@extends('layouts.create')

@section('title', 'Registrar préstamo')

@section('options')
   disabled
@endsection

@section('back_route')
    {{ route('prestamos.index') }}
@endsection

@section('heading', 'Registrar préstamo')

@section('form_action')
    {{ route('prestamos.store') }}
@endsection

@section('form_content')
    @csrf
    @include('prestamo.form')
@endsection


