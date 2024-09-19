@extends('layouts.edit')

@section('title', 'Editar Familia')

@section('back_route')
    {{ route('familias.index') }}
@endsection

@section('heading', 'Editar Familia')

@section('form_action')
    {{ route('familias.update', $familia->id) }}
@endsection

@section('form_content')
    @include('familia.form')
@endsection
