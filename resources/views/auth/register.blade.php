@extends('layouts.guest')

@section('title', 'Inscription')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card shadow-sm">
                <div class="card-body">

                    <h3 class="mb-4 text-center">Créer un compte</h3>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Nom -->
                        <div class="mb-3">
                            <label class="form-label">Nom</label>
                            <input type="text"
                                   name="name"
                                   value="{{ old('name') }}"
                                   class="form-control"
                                   required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Prénom -->
                        <div class="mb-3">
                            <label class="form-label">Prénom</label>
                            <input type="text"
                                   name="prenom"
                                   value="{{ old('prenom') }}"
                                   class="form-control"
                                   required>
                            @error('prenom')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Téléphone -->
                        <div class="mb-3">
                            <label class="form-label">Téléphone</label>
                            <input type="text"
                                   name="telephone"
                                   value="{{ old('telephone') }}"
                                   class="form-control">
                            @error('telephone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Pays -->
                        <div class="mb-3">
                            <label class="form-label">Pays</label>
                            <input type="text"
                                   name="pays"
                                   value="{{ old('pays') }}"
                                   class="form-control">
                            @error('pays')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Ville -->
                        <div class="mb-3">
                            <label class="form-label">Ville</label>
                            <input type="text"
                                   name="ville"
                                   value="{{ old('ville') }}"
                                   class="form-control">
                            @error('ville')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   class="form-control"
                                   required>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Mot de passe -->
                        <div class="mb-3">
                            <label class="form-label">Mot de passe</label>
                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   required>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Confirmation -->
                        <div class="mb-3">
                            <label class="form-label">Confirmer mot de passe</label>
                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-primary">
                                S'inscrire
                            </button>
                        </div>

                        <div class="text-center mt-3">
                            <a href="{{ route('login') }}">
                                Déjà inscrit ? Se connecter
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection