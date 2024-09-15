<div class="row justify-content-center">
    <div class="col-md-9">
        @yield('form_content')
        <br>
        <div class="text-center">
            <button type="@yield('button_type')" class="btn btn-primary rounded-4">{{ __('GUARDAR') }}</button>
        </div>
    </div>
</div>

