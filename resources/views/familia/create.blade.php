@extends('layouts.create')

@section('title', 'Crear Familia')

@section('back_route')
    {{ route('familias.index') }}
@endsection

@section('heading', 'Crear Familia')

@section('form_action')
    {{ route('familias.store') }}
@endsection

@section('form_content')
    @csrf
    @include('familia.form')
@endsection
