@extends('layouts.edit')

@section('title', 'Editar familia')

@section('back_route')
    {{ route('familias.index') }}
@endsection

@section('heading', 'Editar familia')

@section('form_action')
    {{ route('familias.update', $familia->id) }}
@endsection

@section('form_content')
    @include('familia.form')
@endsection
