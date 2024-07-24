@extends('layouts.app')

@section('template_title')
    {{ $user->name ?? __('Show') . " " . __('User') }}
@endsection

@section('content')
    <section class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-white border-0 rounded-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-end">
                            <a class="btn" href="{{ route('users.index') }}"> <i class="bi bi-arrow-left-circle-fill fs-4 text-primary"></i></a>
                        </div>
                        <h3 class="text-center">Usuarios</h3>
                        <br>
                        <br>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre:</strong>
                                    {{ $user->name }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Correo electrónico:</strong>
                                    {{ $user->email }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
