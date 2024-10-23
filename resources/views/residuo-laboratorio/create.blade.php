@extends('layouts.create')

@section('title', 'Crear stock de residuo')

@section('back_route')
    {{ route('residuo-laboratorios.index') }}
@endsection

@section('heading', 'Crear stock de residuo')

@section('form_action')
    {{ route('residuo-laboratorios.store') }}
@endsection

@section('form_content')
    @csrf
    @include('residuo-laboratorio.form')
@endsection