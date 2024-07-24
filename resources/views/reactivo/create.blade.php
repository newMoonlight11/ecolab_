@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Reactivo
@endsection

@section('content')
    <section class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-white border-0 rounded-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-end">
                            <a class="btn" href="{{ route('reactivos.index') }}"> <i class="bi bi-arrow-left-circle-fill fs-4 text-primary"></i></a>
                        </div>
                        <h3 class="text-center">Crear reactivo</h3>
                        <form method="POST" action="{{ route('reactivos.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('reactivo.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
