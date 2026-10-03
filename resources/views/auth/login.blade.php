@extends('layouts.guest')

@section('title', 'Connexion')

@section('content')

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-4 p-md-5">

        {{-- Logo YOULIDA --}}
        <div class="text-center mb-4">
            <img
                src="{{ asset('images/logo.png') }}"
                alt="Logo YOULIDA"
                class="img-fluid"
                style="max-height: 140px; max-width: 220px;"
            >

            <h3 class="mt-3 mb-1 fw-bold">
                Connexion
            </h3>

            <p class="text-muted mb-0">
                Accédez à votre espace d'administration YOULIDA
            </p>
        </div>

        {{-- Message de statut --}}
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        {{-- Erreurs générales --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div class="mb-3">
                <label for="email" class="form-label">
                    Adresse email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}"
                    autocomplete="email"
                    autofocus
                    required
                >

                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Mot de passe --}}
            <div class="mb-3">
                <label for="password" class="form-label">
                    Mot de passe
                </label>

                <div class="input-group">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        autocomplete="current-password"
                        required
                    >

                    <button
                        type="button"
                        id="togglePassword"
                        class="btn btn-outline-secondary"
                        aria-label="Afficher le mot de passe"
                        aria-pressed="false"
                    >
                        <i
                            id="passwordIcon"
                            class="fa-solid fa-eye"
                        ></i>
                    </button>

                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            {{-- Se souvenir de moi --}}
            <div class="form-check mb-4">
                <input
                    type="checkbox"
                    id="remember"
                    name="remember"
                    class="form-check-input"
                    {{ old('remember') ? 'checked' : '' }}
                >

                <label
                    for="remember"
                    class="form-check-label"
                >
                    Se souvenir de moi
                </label>
            </div>

            {{-- Connexion --}}
            <div class="d-grid">
                <button
                    type="submit"
                    class="btn btn-primary btn-lg"
                >
                    <i class="fa-solid fa-right-to-bracket me-2"></i>
                    Se connecter
                </button>
            </div>

            {{-- Mot de passe oublié --}}
            @if (Route::has('password.request'))
                <div class="text-center mt-4">
                    <a
                        href="{{ route('password.request') }}"
                        class="text-decoration-none"
                    >
                        Mot de passe oublié ?
                    </a>
                </div>
            @endif

        </form>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const toggleButton = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const passwordIcon = document.getElementById('passwordIcon');

    if (!toggleButton || !passwordInput || !passwordIcon) {
        return;
    }

    toggleButton.addEventListener('click', function () {

        const passwordIsHidden = passwordInput.type === 'password';

        passwordInput.type = passwordIsHidden
            ? 'text'
            : 'password';

        passwordIcon.classList.toggle(
            'fa-eye',
            !passwordIsHidden
        );

        passwordIcon.classList.toggle(
            'fa-eye-slash',
            passwordIsHidden
        );

        toggleButton.setAttribute(
            'aria-pressed',
            passwordIsHidden ? 'true' : 'false'
        );

        toggleButton.setAttribute(
            'aria-label',
            passwordIsHidden
                ? 'Masquer le mot de passe'
                : 'Afficher le mot de passe'
        );

    });

});
</script>

@endsection
