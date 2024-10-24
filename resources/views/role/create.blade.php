@extends('layouts.create')

@section('title', 'Crear roles')

@section('back_route')
    {{ route('roles.index') }}
@endsection

@section('heading', 'Crear roles')

@section('form_action')
    {{ route('roles.store') }}
@endsection

@section('form_content')
    @csrf
    @include('role.form')
@endsection
