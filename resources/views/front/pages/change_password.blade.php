@extends('front.layout.layout')

@section('content')
    <div class="cart_single_wrapper clv_section woocommerce-cart">
        <div class="container">
            
            @if(Session::has('success'))
                <div class="container">
                    <div class="alert alert-success" role="alert">
                        <em> {!! session('success') !!}</em>
                    </div>
                </div>
            @endif

            <h1 class="text-center font-weight-bold pb-4">Cambio de Contraseña</h1>

            <form method="POST" action="{{ url('/logoutOthers') }}">
                @csrf
                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña actual</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password_current') is-invalid @enderror" name="password_current" required>

                        @error('password_current')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            Cambiar la Contraseña
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
