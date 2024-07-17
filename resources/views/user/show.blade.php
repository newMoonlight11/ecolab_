@extends('layouts.app')

@section('template_title')
    {{ $user->name ?? __('Show') . " " . __('User') }}
@endsection

@section('content')
    <section class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-white">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Mostrar') }} usuario</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('users.index') }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Name:</strong>
                                    {{ $user->name }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Email:</strong>
                                    {{ $user->email }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
