@extends('layouts.guest')

@section('title','Connexion')

@section('content')

<div class="card shadow-sm border-0">
    <div class="card-body p-4">

        <h3 class="text-center mb-4">Connexion</h3>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label>Email</label>
                <input type="email"
                       name="email"
                       class="form-control"
                       value="{{ old('email') }}"
                       required>
            </div>

            <div class="mb-3">
                <label>Mot de passe</label>
                <input type="password"
                       name="password"
                       class="form-control"
                       required>
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" name="remember" class="form-check-input">
                <label class="form-check-label">Se souvenir de moi</label>
            </div>

            <button class="btn btn-primary w-100">
                Se connecter
            </button>

            <div class="text-center mt-3">
                <a href="{{ route('password.request') }}">
                    Mot de passe oublié ?
                </a>
            </div>

            <div class="text-center mt-2">
                <a href="{{ route('register') }}">
                    Créer un compte
                </a>
            </div>

        </form>

    </div>
</div>

@endsection