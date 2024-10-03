@extends('layouts.create')

@section('title', 'Crear Laboratorio')

@section('back_route')
    {{ route('laboratorios.index') }}
@endsection

@section('heading', 'Crear Laboratorio')

@section('form_action')
    {{ route('laboratorios.store') }}
@endsection

@section('form_content')
    @csrf
    @include('laboratorio.form')
@endsection
