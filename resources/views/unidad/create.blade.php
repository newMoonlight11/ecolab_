@extends('layouts.create')

@section('title', 'Crear Unidad')

@section('back_route')
    {{ route('unidads.index') }}
@endsection

@section('heading', 'Crear Unidad')

@section('form_action')
    {{ route('unidads.store') }}
@endsection

@section('form_content')
    @include('unidad.form')
@endsection