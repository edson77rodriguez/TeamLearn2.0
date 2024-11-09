@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registro a TeamLearn') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="nom">{{ __('Nombre') }}</label>
                            <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom') }}" required autofocus>
                            @error('nom')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="ap">{{ __('Apellido Paterno') }}</label>
                            <input id="ap" type="text" class="form-control @error('ap') is-invalid @enderror" name="ap" value="{{ old('ap') }}" required>
                            @error('ap')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="am">{{ __('Apellido Materno') }}</label>
                            <input id="am" type="text" class="form-control @error('am') is-invalid @enderror" name="am" value="{{ old('am') }}" required>
                            @error('am')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">{{ __('Correo Electrónico') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="telefono">{{ __('Teléfono') }}</label>
                            <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" required>
                            @error('telefono')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="fecha_nac">{{ __('Fecha de Nacimiento') }}</label>
                            <input id="fecha_nac" type="date" class="form-control @error('fecha_nac') is-invalid @enderror" name="fecha_nac" value="{{ old('fecha_nac') }}" required>
                            @error('fecha_nac')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="rol_id">{{ __('Rol') }}</label>
                            <select id="rol_id" class="form-control @error('rol_id') is-invalid @enderror" name="rol_id" required>
                                <option value="">Selecciona un rol</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->rol }}</option>
                                @endforeach
                            </select>
                            @error('rol_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password">{{ __('Contraseña') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password-confirm">{{ __('Confirmar Contraseña') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Registrar') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
