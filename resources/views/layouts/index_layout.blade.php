@extends('layouts.app')

@section('template_title')
    @yield('title', 'CRUD')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card border-0">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card-body">
                        <br>
                        <h1 class="text-center display-6">@yield('heading')</h1>
                        <br>
                        @yield('filter_content')
                    </div>
                    <br>
                    <div class="card border-0 rounded-4 bg-white">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            @yield('table_header')
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @yield('table_content')
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
                @yield('pagination')
            </div>
        </div>
    </div>
@endsection
