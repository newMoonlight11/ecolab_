@extends('layouts.create')

@section('title', 'Registrar clase de residuo')

@section('back_route')
    {{ route('clase-residuos.index') }}
@endsection

@section('heading', 'Registrar clase de residuos')

@section('form_action')
    {{ route('clase-residuos.store') }}
@endsection

@section('form_content')
    @csrf
    @include('clase-residuo.form')
@endsection
