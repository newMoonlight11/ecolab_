@extends('layouts.edit')

@section('title', 'Editar usuario')

@section('back_route')
    {{ route('users.index') }}
@endsection

@section('heading', 'Editar usuario')

@section('form_action')
    {{ route('users.update', $user->id) }}
@endsection

@section('form_content')
    @include('user.form')
@endsection
