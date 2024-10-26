@extends('layouts.create')

@section('title', 'Registrar residuo')

@section('back_route')
    {{ route('residuos.index') }}
@endsection

@section('heading', 'Registrar residuo')

@section('form_action')
    {{ route('residuos.store') }}
@endsection

@section('form_content')
    @csrf
    @include('residuo.form')
@endsection