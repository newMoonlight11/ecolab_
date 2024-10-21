@extends('layouts.create')

@section('title', 'Crear residuo')

@section('back_route')
    {{ route('residuos.index') }}
@endsection

@section('heading', 'Crear residuo')

@section('form_action')
    {{ route('residuos.store') }}
@endsection

@section('form_content')
    @csrf
    @include('residuo.form')
@endsection