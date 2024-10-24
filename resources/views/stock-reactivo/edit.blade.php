@extends('layouts.edit')

@section('title', 'Editar stock reactivo')

@section('back_route')
    {{ route('stock_reactivos.index') }}
@endsection

@section('heading', 'Editar stock reactivo')

@section('form_action')
    {{ route('stock_reactivos.update', $stockReactivo->id) }}
@endsection

@section('form_content')
    @include('stock-reactivo.form')
@endsection
