@extends('layouts.create')

@section('title', 'Crear usuario')

@section('back_route')
    {{ route('users.index') }}
@endsection

@section('heading', 'Crear usuario')

@section('form_action')
    {{ route('users.store') }}
@endsection

@section('form_content')
    @csrf
    @include('user.form')
@endsection
