@extends('layouts.edit')

@section('title', 'Editar clase de residuos')

@section('back_route')
    {{ route('clase-residuos.index') }}
@endsection

@section('heading', 'Editar clase de residuos')

@section('form_action')
    {{ route('clase-residuos.update', $claseResiduo->id) }}
@endsection

@section('form_content')
    @include('clase-residuo.form')
@endsection
