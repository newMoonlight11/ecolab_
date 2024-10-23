@extends('layouts.edit')

@section('title', 'Editar stock de residuo')

@section('back_route')
    {{ route('residuo-laboratorios.index') }}
@endsection

@section('heading', 'Editar stock de residuo')

@section('form_action')
    {{ route('residuo-laboratorios.update', $residuoLaboratorio->id) }}
@endsection

@section('form_content')
    @include('residuo-laboratorio.form')
@endsection