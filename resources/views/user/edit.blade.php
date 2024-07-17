@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} User
@endsection

@section('content')
    <section class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-white">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-8 offset-md-2 text-center">
                                <br>
                                <p class="color-blue">Editar</p>
                            </div>
                            <form method="POST" action="{{ route('users.update', $user->id) }}" role="form"
                                enctype="multipart/form-data">
                                {{ method_field('PATCH') }}
                                @csrf

                                @include('user.form')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
