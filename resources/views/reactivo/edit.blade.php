@extends('layouts.edit')

@section('title', 'Editar reactivo')

@section('back_route')
    {{ route('reactivos.index') }}
@endsection

@section('heading', 'Editar reactivo')

@section('form_action')
    {{ route('reactivos.update', $reactivo->id) }}
@endsection

@section('form_content')
    @include('reactivo.form')
@endsection
