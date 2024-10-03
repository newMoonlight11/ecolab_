@extends('layouts.create')

@section('title', 'Crear reactivo')

@section('back_route')
    {{ route('reactivos.index') }}
@endsection

@section('heading', 'Crear reactivo')

@section('form_action')
    {{ route('reactivos.store') }}
@endsection

@section('form_content')
    @csrf
    @include('reactivo.form')
@endsection
