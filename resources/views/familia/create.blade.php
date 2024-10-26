@extends('layouts.create')

@section('title', 'Registrar familia')

@section('back_route')
    {{ route('familias.index') }}
@endsection

@section('heading', 'Registrar familia')

@section('form_action')
    {{ route('familias.store') }}
@endsection

@section('form_content')
    @csrf
    @include('familia.form')
@endsection
