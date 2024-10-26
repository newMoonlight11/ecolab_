@extends('layouts.edit')

@section('title', 'Editar marca')

@section('back_route')
    {{ route('marcas.index') }}
@endsection

@section('heading', 'Editar marca')

@section('form_action')
    {{ route('marcas.update', $marca->id) }}
@endsection

@section('form_content')
    @include('marca.form')
@endsection
