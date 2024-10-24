@extends('layouts.create')

@section('title', 'Crear stock reactivo')

@section('back_route')
    {{ route('stock_reactivos.index') }}
@endsection

@section('heading', 'Crear stock reactivo')

@section('form_action')
    {{ route('stock_reactivos.store') }}
@endsection

@section('form_content')
    @csrf
    @include('stock-reactivo.form')
@endsection

