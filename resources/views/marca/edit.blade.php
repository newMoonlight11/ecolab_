@extends('layouts.edit')

@section('title', 'Editar Marca')

@section('back_route')
    {{ route('marcas.index') }}
@endsection

@section('heading', 'Editar Marca')

@section('form_action')
    {{ route('marcas.update', $marca->id) }}
@endsection

@section('form_content')
    @include('marca.form')
@endsection
