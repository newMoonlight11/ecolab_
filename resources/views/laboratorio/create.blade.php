@extends('layouts.create')

@section('title', 'Registrar laboratorio')

@section('back_route')
    {{ route('laboratorios.index') }}
@endsection

@section('heading', 'Registrar laboratorio')

@section('form_action')
    {{ route('laboratorios.store') }}
@endsection

@section('form_content')
    @csrf
    @include('laboratorio.form')
@endsection
