@extends('back.layouts.app')

@section('title', 'Mon profil')

@section('content')

<div class="container py-4">

    <div class="mb-4">
        <h4 class="fw-bold mb-1">Mon profil</h4>
        <p class="text-muted mb-0">Consultez et mettez à jour les informations de votre compte.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row g-4">

        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Informations personnelles</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label for="name" class="form-label">Nom</label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', auth()->user()->name) }}"
                                    required
                                >
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input
                                    type="text"
                                    id="prenom"
                                    name="prenom"
                                    class="form-control @error('prenom') is-invalid @enderror"
                                    value="{{ old('prenom', auth()->user()->prenom) }}"
                                >
                                @error('prenom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">Adresse email</label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', auth()->user()->email) }}"
                                    required
                                >
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="telephone" class="form-label">Téléphone</label>
                                <input
                                    type="text"
                                    id="telephone"
                                    name="telephone"
                                    class="form-control @error('telephone') is-invalid @enderror"
                                    value="{{ old('telephone', auth()->user()->telephone) }}"
                                >
                                @error('telephone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="pays" class="form-label">Pays</label>
                                <input
                                    type="text"
                                    id="pays"
                                    name="pays"
                                    class="form-control @error('pays') is-invalid @enderror"
                                    value="{{ old('pays', auth()->user()->pays) }}"
                                >
                                @error('pays')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="ville" class="form-label">Ville</label>
                                <input
                                    type="text"
                                    id="ville"
                                    name="ville"
                                    class="form-control @error('ville') is-invalid @enderror"
                                    value="{{ old('ville', auth()->user()->ville) }}"
                                >
                                @error('ville')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                Mettre à jour le profil
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Informations du compte</h5>
                </div>

                <div class="card-body">
                    <p class="mb-2">
                        <strong>Rôle :</strong>
                        <span class="badge bg-primary">
                            {{ auth()->user()->role->name ?? 'Aucun rôle' }}
                        </span>
                    </p>

                    <p class="mb-2">
                        <strong>Statut :</strong>
                        @if(auth()->user()->is_active)
                            <span class="badge bg-success">Actif</span>
                        @else
                            <span class="badge bg-danger">Inactif</span>
                        @endif
                    </p>

                    <p class="mb-2">
                        <strong>Adresse IP :</strong>
                        {{ auth()->user()->ip_address ?? 'Non disponible' }}
                    </p>

                    <p class="mb-2">
                        <strong>Dernière connexion :</strong>
                        {{ auth()->user()->last_login_at ? auth()->user()->last_login_at->format('d/m/Y H:i') : 'Non disponible' }}
                    </p>

                    <p class="mb-0">
                        <strong>Compte créé le :</strong>
                        {{ auth()->user()->created_at ? auth()->user()->created_at->format('d/m/Y H:i') : 'Non disponible' }}
                    </p>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Sécurité</h5>
                </div>

                <div class="card-body">
                    <a href="{{ route('password.request') }}" class="btn btn-outline-secondary w-100 mb-2">
                        Mot de passe oublié
                    </a>

                    <button type="button" class="btn btn-outline-primary w-100" disabled>
                        Changer le mot de passe
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection