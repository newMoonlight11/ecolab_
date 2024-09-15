@extends('layouts.app')

@section('template_title')
    @yield('title', 'CRUD')
@endsection

@section('content')
    <section class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-white border-0 rounded-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-end">
                            <a class="btn" href="@yield('back_route')"> 
                                <i class="bi bi-arrow-left-circle-fill fs-4 text-primary"></i></a>
                        </div>
                        <h3 class="text-center">@yield('heading')</h3>
                        <form method="POST" action="@yield('form_action')"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @yield('form_content')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection