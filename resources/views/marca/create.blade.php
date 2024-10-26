@extends('layouts.create')

@section('title', 'Registrar marca')

@section('back_route')
    {{ route('marcas.index') }}
@endsection

@section('heading', 'Registrar marca')

@section('form_action')
    {{ route('marcas.store') }}
@endsection

@section('form_content')
    @csrf
    @include('marca.form')
@endsection
