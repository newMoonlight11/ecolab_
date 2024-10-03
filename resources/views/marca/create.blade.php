@extends('layouts.create')

@section('title', 'Crear Marca')

@section('back_route')
    {{ route('marcas.index') }}
@endsection

@section('heading', 'Crear Marca')

@section('form_action')
    {{ route('marcas.store') }}
@endsection

@section('form_content')
    @csrf
    @include('marca.form')
@endsection
