@extends('layouts.edit')

@section('title', 'Editar roles')

@section('back_route')
    {{ route('roles.index') }}
@endsection

@section('heading', 'Editar roles')

@section('form_action')
    {{ route('roles.update', $role->id) }}
@endsection

@section('form_content')
    @include('role.form')
@endsection
