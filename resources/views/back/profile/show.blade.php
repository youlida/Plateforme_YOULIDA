@extends('back.layouts.app')

@section('title', 'Mon profil')

@section('content')

<div class="container-fluid">

    {{-- =====================================================
        EN-TÊTE
    ====================================================== --}}
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">

        <div>
            <h1 class="h3 mb-1">
                Mon profil
            </h1>

            <p class="text-muted mb-0">
                Consultez vos informations personnelles et les informations
                liées à votre compte.
            </p>
        </div>

        <a
            href="{{ route('admin.profile.edit') }}"
            class="btn btn-primary"
        >
            <i class="fa-solid fa-user-pen me-2"></i>
            Modifier mon profil
        </a>

    </div>


    {{-- =====================================================
        MESSAGE DE SUCCÈS
    ====================================================== --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            <i class="fa-solid fa-circle-check me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    <div class="row g-4">

        {{-- =================================================
            COLONNE GAUCHE
        ================================================== --}}
        <div class="col-lg-4">

            {{-- CARTE PROFIL --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-body text-center p-4">

                    {{-- Photo --}}
                    <div
                        class="mx-auto mb-3 rounded-circle overflow-hidden
                               d-flex align-items-center justify-content-center
                               bg-primary bg-opacity-10 text-primary"
                        style="
                            width: 130px;
                            height: 130px;
                            font-size: 42px;
                            font-weight: 700;
                        "
                    >

                        @if(
                            $user->photo &&
                            \Illuminate\Support\Facades\Storage::disk('public')
                                ->exists($user->photo)
                        )

                            <img
                                src="{{ asset('storage/' . $user->photo) }}"
                                alt="Photo de profil"
                                style="
                                    width: 100%;
                                    height: 100%;
                                    object-fit: cover;
                                "
                            >

                        @else

                            {{ strtoupper(
                                substr(
                                    $user->prenom ?: ($user->name ?? 'A'),
                                    0,
                                    1
                                )
                            ) }}

                        @endif

                    </div>


                    {{-- Nom --}}
                    <h4 class="mb-1">

                        {{ $user->prenom }}
                        {{ $user->name }}

                    </h4>


                    {{-- Email --}}
                    <p class="text-muted mb-3">
                        {{ $user->email }}
                    </p>


                    {{-- Rôle --}}
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">

                        <i class="fa-solid fa-shield-halved me-1"></i>

                        {{ $user->role->name ?? 'Administrateur' }}

                    </span>


                    <hr class="my-4">


                    {{-- Statut --}}
                    <div class="d-flex justify-content-between align-items-center">

                        <span class="text-muted">
                            Statut du compte
                        </span>

                        @if($user->is_active)

                            <span class="badge bg-success bg-opacity-10 text-success">
                                <i class="fa-solid fa-circle-check me-1"></i>
                                Actif
                            </span>

                        @else

                            <span class="badge bg-danger bg-opacity-10 text-danger">
                                <i class="fa-solid fa-circle-xmark me-1"></i>
                                Inactif
                            </span>

                        @endif

                    </div>

                </div>

            </div>


            {{-- SÉCURITÉ --}}
            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white py-3">

                    <h5 class="mb-0">
                        <i class="fa-solid fa-shield-halved me-2 text-primary"></i>
                        Sécurité
                    </h5>

                </div>

                <div class="card-body">

                    <p class="small text-muted">
                        Votre mot de passe protège l'accès à votre espace
                        d'administration.
                    </p>

                    <a
                        href="{{ route('admin.profile.edit') }}#security"
                        class="btn btn-outline-primary w-100"
                    >
                        <i class="fa-solid fa-key me-2"></i>
                        Modifier mon mot de passe
                    </a>

                </div>

            </div>

        </div>


        {{-- =================================================
            COLONNE PRINCIPALE
        ================================================== --}}
        <div class="col-lg-8">

            {{-- INFORMATIONS PERSONNELLES --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white py-3">

                    <div class="d-flex align-items-center gap-2">

                        <div
                            class="d-flex align-items-center justify-content-center
                                   rounded-circle bg-primary bg-opacity-10 text-primary"
                            style="width: 38px; height: 38px;"
                        >
                            <i class="fa-regular fa-user"></i>
                        </div>

                        <div>
                            <h5 class="mb-0">
                                Informations personnelles
                            </h5>

                            <small class="text-muted">
                                Vos informations d'identification
                            </small>
                        </div>

                    </div>

                </div>


                <div class="card-body">

                    <div class="row g-4">

                        <div class="col-md-6">

                            <small class="text-muted d-block mb-1">
                                Nom
                            </small>

                            <strong>
                                {{ $user->name ?: 'Non renseigné' }}
                            </strong>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted d-block mb-1">
                                Prénom
                            </small>

                            <strong>
                                {{ $user->prenom ?: 'Non renseigné' }}
                            </strong>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted d-block mb-1">
                                Adresse e-mail
                            </small>

                            <a
                                href="mailto:{{ $user->email }}"
                                class="text-decoration-none fw-semibold"
                            >
                                <i class="fa-regular fa-envelope me-1"></i>
                                {{ $user->email }}
                            </a>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted d-block mb-1">
                                Téléphone
                            </small>

                            @if($user->telephone)

                                <a
                                    href="tel:{{ $user->telephone }}"
                                    class="text-decoration-none fw-semibold"
                                >
                                    <i class="fa-solid fa-phone me-1"></i>
                                    {{ $user->telephone }}
                                </a>

                            @else

                                <span class="text-muted">
                                    Non renseigné
                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>


            {{-- LOCALISATION --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white py-3">

                    <div class="d-flex align-items-center gap-2">

                        <div
                            class="d-flex align-items-center justify-content-center
                                   rounded-circle bg-info bg-opacity-10 text-info"
                            style="width: 38px; height: 38px;"
                        >
                            <i class="fa-solid fa-location-dot"></i>
                        </div>

                        <div>
                            <h5 class="mb-0">
                                Localisation
                            </h5>

                            <small class="text-muted">
                                Informations géographiques du profil
                            </small>
                        </div>

                    </div>

                </div>


                <div class="card-body">

                    <div class="row g-4">

                        <div class="col-md-6">

                            <small class="text-muted d-block mb-1">
                                Pays
                            </small>

                            <strong>
                                {{ $user->pays ?: 'Non renseigné' }}
                            </strong>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted d-block mb-1">
                                Ville
                            </small>

                            <strong>
                                {{ $user->ville ?: 'Non renseignée' }}
                            </strong>

                        </div>

                    </div>

                </div>

            </div>


            {{-- INFORMATIONS DU COMPTE --}}
            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white py-3">

                    <div class="d-flex align-items-center gap-2">

                        <div
                            class="d-flex align-items-center justify-content-center
                                   rounded-circle bg-secondary bg-opacity-10 text-secondary"
                            style="width: 38px; height: 38px;"
                        >
                            <i class="fa-solid fa-user-shield"></i>
                        </div>

                        <div>
                            <h5 class="mb-0">
                                Informations du compte
                            </h5>

                            <small class="text-muted">
                                Informations administratives
                            </small>
                        </div>

                    </div>

                </div>


                <div class="card-body">

                    <div class="row g-4">

                        <div class="col-md-6">

                            <small class="text-muted d-block mb-1">
                                Identifiant utilisateur
                            </small>

                            <strong>
                                #{{ $user->id }}
                            </strong>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted d-block mb-1">
                                Rôle
                            </small>

                            <strong>
                                {{ $user->role->name ?? 'Non défini' }}
                            </strong>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted d-block mb-1">
                                Dernière connexion
                            </small>

                            @if($user->last_login_at)

                                <strong>
                                    {{ $user->last_login_at->format('d/m/Y à H:i') }}
                                </strong>

                            @else

                                <span class="text-muted">
                                    Non disponible
                                </span>

                            @endif

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted d-block mb-1">
                                Compte créé le
                            </small>

                            <strong>
                                {{ $user->created_at->format('d/m/Y à H:i') }}
                            </strong>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection