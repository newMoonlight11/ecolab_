@extends('layouts.edit')

@section('title', 'Editar laboratorio')

@section('back_route')
    {{ route('laboratorios.index') }}
@endsection

@section('heading', 'Editar laboratorio')

@section('form_action')
    {{ route('laboratorios.update', $laboratorio->id) }}
@endsection

@section('form_content')
    @include('laboratorio.form')
@endsection