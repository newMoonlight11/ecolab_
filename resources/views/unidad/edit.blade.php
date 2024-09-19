@extends('layouts.edit')

@section('title', 'Editar Unidad')

@section('back_route')
    {{ route('unidads.index') }}
@endsection

@section('heading', 'Editar Unidad')

@section('form_action')
    {{ route('unidads.update', $unidad->id) }}
@endsection

@section('form_content')
    @include('unidad.form')
@endsection
