@extends('layouts.app')

@section('content')
    <section class="container">
        <div class="row">
            <div class="col-sm ">
                <div class="card">
                    <div class="card-header h3">Iniciar sesión</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">
                                    <h6>Correo electrónico</h6>
                                </label>
                                <div class="col-md-6">
                                    <input id="email"
                                           type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           name="email"
                                           placeholder="Ingrese su correo electrónico"
                                           value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right"><h6>Contraseña</h6></label>

                                <div class="col-md-6">
                                    <input id="password"
                                           type="password"
                                           placeholder="Ingrese su contraseña"
                                           class="form-control @error('password') is-invalid @enderror"
                                           name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">Recuérdame</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4 mb-2">
                                    <button type="submit" class="btn btn-outline-dark"
                                    >Ingresar</button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            Reestablecer contraseña
                                        </a>
                                    @endif
                                </div>
                                <div class="col-md-8 offset-md-4">
                                    <a class="btn btn-outline-dark" href="{{ route('register') }}">Registrarse</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
