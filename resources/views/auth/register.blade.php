@extends('layouts.guest')

@section('title', 'Inscription')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4 p-md-5">

                    {{-- Logo YOULIDA --}}
                    <div class="text-center mb-4">
                        <img
                            src="{{ asset('images/logo.png') }}"
                            alt="Logo YOULIDA"
                            class="img-fluid"
                            style="max-height: 130px; max-width: 220px;"
                        >

                        <h3 class="mt-3 mb-1 fw-bold">
                            Créer un compte
                        </h3>

                        <p class="text-muted mb-0">
                            Créez votre compte pour accéder à votre espace YOULIDA
                        </p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row">

                            {{-- Nom --}}
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">
                                    Nom <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    class="form-control @error('name') is-invalid @enderror"
                                    autocomplete="family-name"
                                    required
                                >

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Prénom --}}
                            <div class="col-md-6 mb-3">
                                <label for="prenom" class="form-label">
                                    Prénom <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="prenom"
                                    name="prenom"
                                    value="{{ old('prenom') }}"
                                    class="form-control @error('prenom') is-invalid @enderror"
                                    autocomplete="given-name"
                                    required
                                >

                                @error('prenom')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Téléphone --}}
                            <div class="col-md-6 mb-3">
                                <label for="telephone" class="form-label">
                                    Téléphone
                                </label>

                                <input
                                    type="tel"
                                    id="telephone"
                                    name="telephone"
                                    value="{{ old('telephone') }}"
                                    class="form-control @error('telephone') is-invalid @enderror"
                                    autocomplete="tel"
                                >

                                @error('telephone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Pays --}}
                            <div class="col-md-6 mb-3">
                                <label for="pays" class="form-label">
                                    Pays
                                </label>

                                <input
                                    type="text"
                                    id="pays"
                                    name="pays"
                                    value="{{ old('pays') }}"
                                    class="form-control @error('pays') is-invalid @enderror"
                                    autocomplete="country-name"
                                >

                                @error('pays')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Ville --}}
                            <div class="col-12 mb-3">
                                <label for="ville" class="form-label">
                                    Ville
                                </label>

                                <input
                                    type="text"
                                    id="ville"
                                    name="ville"
                                    value="{{ old('ville') }}"
                                    class="form-control @error('ville') is-invalid @enderror"
                                    autocomplete="address-level2"
                                >

                                @error('ville')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="col-12 mb-3">
                                <label for="email" class="form-label">
                                    Adresse email <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    autocomplete="email"
                                    required
                                >

                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Mot de passe --}}
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">
                                    Mot de passe <span class="text-danger">*</span>
                                </label>

                                <div class="input-group">
                                    <input
                                        type="password"
                                        id="password"
                                        name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        autocomplete="new-password"
                                        required
                                    >

                                    <button
                                        type="button"
                                        class="btn btn-outline-secondary"
                                        onclick="togglePassword('password', 'passwordIcon')"
                                        aria-label="Afficher ou masquer le mot de passe"
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

                            {{-- Confirmation mot de passe --}}
                            <div class="col-md-6 mb-4">
                                <label for="password_confirmation" class="form-label">
                                    Confirmer le mot de passe
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="input-group">
                                    <input
                                        type="password"
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        class="form-control"
                                        autocomplete="new-password"
                                        required
                                    >

                                    <button
                                        type="button"
                                        class="btn btn-outline-secondary"
                                        onclick="togglePassword(
                                            'password_confirmation',
                                            'confirmationIcon'
                                        )"
                                        aria-label="Afficher ou masquer la confirmation"
                                    >
                                        <i
                                            id="confirmationIcon"
                                            class="fa-solid fa-eye"
                                        ></i>
                                    </button>
                                </div>
                            </div>

                        </div>

                        {{-- Bouton inscription --}}
                        <div class="d-grid">
                            <button
                                type="submit"
                                class="btn btn-primary btn-lg"
                            >
                                S'inscrire
                            </button>
                        </div>

                        {{-- Connexion --}}
                        @if (Route::has('login'))
                            <div class="text-center mt-4">
                                <span class="text-muted">
                                    Déjà inscrit ?
                                </span>

                                <a
                                    href="{{ route('login') }}"
                                    class="text-decoration-none fw-semibold"
                                >
                                    Se connecter
                                </a>
                            </div>
                        @endif

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function togglePassword(inputId, iconId) {

        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);

        if (input.type === 'password') {

            input.type = 'text';

            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');

        } else {

            input.type = 'password';

            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>

@endsection
