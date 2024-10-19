@extends('layouts.edit')

@section('title', 'Editar Marca')

@section('back_route')
    {{ route('movimientos.index') }}
@endsection

@section('heading', 'Editar Marca')

@section('form_action')
    {{ route('movimientos.update', $movimiento->id) }}
@endsection

@section('form_content')
    @include('movimiento.form')
@endsection
