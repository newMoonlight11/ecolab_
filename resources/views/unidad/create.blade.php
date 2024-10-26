@extends('layouts.create')

@section('title', 'Registrar unidad')

@section('back_route')
    {{ route('unidads.index') }}
@endsection

@section('heading', 'Registrar unidad')

@section('form_action')
    {{ route('unidads.store') }}
@endsection

@section('form_content')
    @csrf
    @include('unidad.form')
@endsection
