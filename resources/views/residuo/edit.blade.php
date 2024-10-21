@extends('layouts.edit')

@section('title', 'Editar residuo')

@section('back_route')
    {{ route('residuos.index') }}
@endsection

@section('heading', 'Editar residuo')

@section('form_action')
    {{ route('residuos.update', $residuo->id) }}
@endsection

@section('form_content')
    @include('residuo.form')
@endsection