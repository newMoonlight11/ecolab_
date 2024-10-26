@extends('layouts.create')

@section('title', 'Registrar reactivo')

@section('back_route')
    {{ route('reactivos.index') }}
@endsection

@section('heading', 'Registrar reactivo')

@section('form_action')
    {{ route('reactivos.store') }}
@endsection

@section('form_content')
    @csrf
    @include('reactivo.form')
@endsection
