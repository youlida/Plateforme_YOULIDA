@extends('back.layouts.app')

@section('title', 'Détails utilisateur')

@section('content')

<div class="container-fluid py-4">

    {{-- =========================================================
        EN-TÊTE
    ========================================================== --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

        <div class="d-flex align-items-center gap-3">

            <div
                class="d-flex align-items-center justify-content-center rounded-3 bg-primary bg-opacity-10 text-primary flex-shrink-0"
                style="width: 48px; height: 48px;"
            >
                <i class="bi bi-person-vcard fs-4"></i>
            </div>

            <div>
                <h3 class="fw-bold mb-1">
                    Détails de l'utilisateur
                </h3>

                <p class="text-muted mb-0 small">
                    Consultez les informations du compte et ses droits d'accès.
                </p>
            </div>

        </div>


        <div class="d-flex flex-wrap gap-2">

            <a
                href="{{ route('admin.utilisateurs.index') }}"
                class="btn btn-light border d-inline-flex align-items-center gap-2"
            >
                <i class="bi bi-arrow-left"></i>
                Retour
            </a>

            <a
                href="{{ route('admin.utilisateurs.edit', $user->id) }}"
                class="btn btn-primary d-inline-flex align-items-center gap-2"
            >
                <i class="bi bi-pencil-square"></i>
                Modifier
            </a>

        </div>

    </div>


    {{-- =========================================================
        MESSAGES
    ========================================================== --}}
    @if(session('success'))

        <div
            class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4"
            role="alert"
        >
            <div class="d-flex align-items-center gap-2">

                <i class="bi bi-check-circle-fill"></i>

                <span>
                    {{ session('success') }}
                </span>

            </div>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Fermer"
            ></button>
        </div>

    @endif


    @if(session('error'))

        <div
            class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4"
            role="alert"
        >
            <div class="d-flex align-items-center gap-2">

                <i class="bi bi-exclamation-triangle-fill"></i>

                <span>
                    {{ session('error') }}
                </span>

            </div>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Fermer"
            ></button>
        </div>

    @endif


    <div class="row g-4">

        {{-- =====================================================
            COLONNE GAUCHE : PROFIL
        ====================================================== --}}
        <div class="col-12 col-xl-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center p-4">

                    {{-- =========================================
                        PHOTO
                    ========================================== --}}
                    <div class="mb-3">

                        @if($user->photo)

                            <img
                                src="{{ asset('storage/' . $user->photo) }}"
                                alt="Photo de {{ $user->name }}"
                                class="rounded-circle border shadow-sm"
                                style="
                                    width: 145px;
                                    height: 145px;
                                    object-fit: cover;
                                "
                            >

                        @else

                            <div
                                class="d-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary mx-auto fw-bold"
                                style="
                                    width: 145px;
                                    height: 145px;
                                    font-size: 46px;
                                "
                            >
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>

                        @endif

                    </div>


                    {{-- =========================================
                        NOM
                    ========================================== --}}
                    <h4 class="fw-bold mb-1">

                        {{ $user->name }}

                        @if($user->prenom)
                            {{ $user->prenom }}
                        @endif

                    </h4>


                    <p class="text-muted mb-3">
                        {{ $user->email }}
                    </p>


                    {{-- =========================================
                        RÔLE
                    ========================================== --}}
                    <div class="mb-3">

                        @if($user->role)

                            @if($user->role->slug === 'superadmin')

                                <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2">
                                    <i class="bi bi-shield-lock me-1"></i>
                                    {{ $user->role->name }}
                                </span>

                            @elseif($user->role->slug === 'admin')

                                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                                    <i class="bi bi-shield-check me-1"></i>
                                    {{ $user->role->name }}
                                </span>

                            @else

                                <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2">
                                    <i class="bi bi-person-badge me-1"></i>
                                    {{ $user->role->name }}
                                </span>

                            @endif

                        @else

                            <span class="badge bg-light text-muted border px-3 py-2">
                                Aucun rôle
                            </span>

                        @endif

                    </div>


                    {{-- =========================================
                        STATUT
                    ========================================== --}}
                    @if($user->is_active)

                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">

                            <i
                                class="bi bi-circle-fill me-1"
                                style="font-size: 6px;"
                            ></i>

                            Compte actif

                        </span>

                    @else

                        <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2">

                            <i class="bi bi-slash-circle me-1"></i>

                            Compte bloqué

                        </span>

                    @endif


                    <hr class="my-4">


                    {{-- =========================================
                        IDENTIFIANT
                    ========================================== --}}
                    <div class="d-flex justify-content-between align-items-center">

                        <span class="text-muted small">
                            Identifiant
                        </span>

                        <strong>
                            #{{ $user->id }}
                        </strong>

                    </div>

                </div>

            </div>


            {{-- =================================================
                INFORMATIONS DU COMPTE
            ================================================== --}}
            <div class="card border-0 shadow-sm mt-4">

                <div class="card-header bg-white border-bottom py-3">

                    <h6 class="fw-bold mb-0">
                        <i class="bi bi-clock-history text-primary me-2"></i>
                        Informations du compte
                    </h6>

                </div>


                <div class="card-body">

                    {{-- CRÉATION --}}
                    <div class="pb-3 mb-3 border-bottom">

                        <small class="text-muted d-block mb-1">
                            Compte créé le
                        </small>

                        <strong>
                            {{ $user->created_at->format('d/m/Y à H:i') }}
                        </strong>

                    </div>


                    {{-- MODIFICATION --}}
                    <div>

                        <small class="text-muted d-block mb-1">
                            Dernière modification
                        </small>

                        <strong>
                            {{ $user->updated_at->format('d/m/Y à H:i') }}
                        </strong>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            COLONNE DROITE
        ====================================================== --}}
        <div class="col-12 col-xl-8">

            {{-- =================================================
                INFORMATIONS PERSONNELLES
            ================================================== --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white border-bottom py-3">

                    <div class="d-flex align-items-center gap-3">

                        <div
                            class="d-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary"
                            style="width: 40px; height: 40px;"
                        >
                            <i class="bi bi-person"></i>
                        </div>

                        <div>

                            <h5 class="fw-bold mb-0">
                                Informations personnelles
                            </h5>

                            <small class="text-muted">
                                Identité de l'utilisateur.
                            </small>

                        </div>

                    </div>

                </div>


                <div class="card-body p-4">

                    <div class="row g-4">

                        {{-- NOM --}}
                        <div class="col-12 col-md-6">

                            <small class="text-muted d-block mb-2">
                                Nom
                            </small>

                            <div class="d-flex align-items-center gap-2">

                                <i class="bi bi-person text-primary"></i>

                                <strong>
                                    {{ $user->name }}
                                </strong>

                            </div>

                        </div>


                        {{-- PRÉNOM --}}
                        <div class="col-12 col-md-6">

                            <small class="text-muted d-block mb-2">
                                Prénom
                            </small>

                            <div class="d-flex align-items-center gap-2">

                                <i class="bi bi-person text-primary"></i>

                                @if($user->prenom)

                                    <strong>
                                        {{ $user->prenom }}
                                    </strong>

                                @else

                                    <span class="text-muted">
                                        Non renseigné
                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                COORDONNÉES
            ================================================== --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white border-bottom py-3">

                    <div class="d-flex align-items-center gap-3">

                        <div
                            class="d-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10 text-success"
                            style="width: 40px; height: 40px;"
                        >
                            <i class="bi bi-address-book"></i>
                        </div>

                        <div>

                            <h5 class="fw-bold mb-0">
                                Coordonnées
                            </h5>

                            <small class="text-muted">
                                Informations permettant de contacter l'utilisateur.
                            </small>

                        </div>

                    </div>

                </div>


                <div class="card-body p-4">

                    <div class="row g-4">

                        {{-- EMAIL --}}
                        <div class="col-12 col-md-6">

                            <small class="text-muted d-block mb-2">
                                Adresse email
                            </small>

                            <div class="d-flex align-items-center gap-2">

                                <div
                                    class="d-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary flex-shrink-0"
                                    style="width: 36px; height: 36px;"
                                >
                                    <i class="bi bi-envelope"></i>
                                </div>

                                <a
                                    href="mailto:{{ $user->email }}"
                                    class="text-decoration-none text-dark fw-semibold text-break"
                                >
                                    {{ $user->email }}
                                </a>

                            </div>

                        </div>


                        {{-- TÉLÉPHONE --}}
                        <div class="col-12 col-md-6">

                            <small class="text-muted d-block mb-2">
                                Téléphone
                            </small>

                            <div class="d-flex align-items-center gap-2">

                                <div
                                    class="d-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10 text-success flex-shrink-0"
                                    style="width: 36px; height: 36px;"
                                >
                                    <i class="bi bi-telephone"></i>
                                </div>

                                @if($user->telephone)

                                    <a
                                        href="tel:{{ $user->telephone }}"
                                        class="text-decoration-none text-dark fw-semibold"
                                    >
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

            </div>


            {{-- =================================================
                LOCALISATION
            ================================================== --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white border-bottom py-3">

                    <div class="d-flex align-items-center gap-3">

                        <div
                            class="d-flex align-items-center justify-content-center rounded-circle bg-warning bg-opacity-10 text-warning"
                            style="width: 40px; height: 40px;"
                        >
                            <i class="bi bi-geo-alt"></i>
                        </div>

                        <div>

                            <h5 class="fw-bold mb-0">
                                Localisation
                            </h5>

                            <small class="text-muted">
                                Pays et ville renseignés pour cet utilisateur.
                            </small>

                        </div>

                    </div>

                </div>


                <div class="card-body p-4">

                    <div class="row g-4">

                        {{-- PAYS --}}
                        <div class="col-12 col-md-6">

                            <small class="text-muted d-block mb-2">
                                Pays
                            </small>

                            <div class="d-flex align-items-center gap-2">

                                <i class="bi bi-globe text-primary"></i>

                                @if($user->pays)

                                    <strong>
                                        {{ $user->pays }}
                                    </strong>

                                @else

                                    <span class="text-muted">
                                        Non renseigné
                                    </span>

                                @endif

                            </div>

                        </div>


                        {{-- VILLE --}}
                        <div class="col-12 col-md-6">

                            <small class="text-muted d-block mb-2">
                                Ville
                            </small>

                            <div class="d-flex align-items-center gap-2">

                                <i class="bi bi-geo-alt text-danger"></i>

                                @if($user->ville)

                                    <strong>
                                        {{ $user->ville }}
                                    </strong>

                                @else

                                    <span class="text-muted">
                                        Non renseignée
                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                ACCÈS ET SÉCURITÉ
            ================================================== --}}
            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white border-bottom py-3">

                    <div class="d-flex align-items-center gap-3">

                        <div
                            class="d-flex align-items-center justify-content-center rounded-circle bg-danger bg-opacity-10 text-danger"
                            style="width: 40px; height: 40px;"
                        >
                            <i class="bi bi-shield-lock"></i>
                        </div>

                        <div>

                            <h5 class="fw-bold mb-0">
                                Accès et sécurité
                            </h5>

                            <small class="text-muted">
                                Rôle et état actuel du compte.
                            </small>

                        </div>

                    </div>

                </div>


                <div class="card-body p-4">

                    <div class="row g-4">

                        {{-- RÔLE --}}
                        <div class="col-12 col-md-6">

                            <small class="text-muted d-block mb-2">
                                Rôle
                            </small>

                            @if($user->role)

                                <div class="d-flex align-items-center gap-3">

                                    <div
                                        class="d-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary"
                                        style="width: 42px; height: 42px;"
                                    >
                                        <i class="bi bi-shield-check"></i>
                                    </div>

                                    <div>

                                        <strong class="d-block">
                                            {{ $user->role->name }}
                                        </strong>

                                        <small class="text-muted">
                                            {{ $user->role->slug }}
                                        </small>

                                    </div>

                                </div>

                            @else

                                <span class="text-muted">
                                    Aucun rôle attribué
                                </span>

                            @endif

                        </div>


                        {{-- STATUT --}}
                        <div class="col-12 col-md-6">

                            <small class="text-muted d-block mb-2">
                                Statut du compte
                            </small>

                            @if($user->is_active)

                                <div class="d-flex align-items-center gap-3">

                                    <div
                                        class="d-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10 text-success"
                                        style="width: 42px; height: 42px;"
                                    >
                                        <i class="bi bi-person-check"></i>
                                    </div>

                                    <div>

                                        <strong class="d-block text-success">
                                            Actif
                                        </strong>

                                        <small class="text-muted">
                                            Le compte est actuellement activé.
                                        </small>

                                    </div>

                                </div>

                            @else

                                <div class="d-flex align-items-center gap-3">

                                    <div
                                        class="d-flex align-items-center justify-content-center rounded-circle bg-danger bg-opacity-10 text-danger"
                                        style="width: 42px; height: 42px;"
                                    >
                                        <i class="bi bi-person-x"></i>
                                    </div>

                                    <div>

                                        <strong class="d-block text-danger">
                                            Bloqué
                                        </strong>

                                        <small class="text-muted">
                                            Le compte est actuellement désactivé.
                                        </small>

                                    </div>

                                </div>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        ACTIONS
    ========================================================== --}}
    <div class="d-flex flex-column flex-sm-row justify-content-between gap-3 mt-4">

        <a
            href="{{ route('admin.utilisateurs.index') }}"
            class="btn btn-light border d-inline-flex align-items-center justify-content-center gap-2"
        >
            <i class="bi bi-arrow-left"></i>
            Retour à la liste
        </a>


        <div class="d-flex flex-column flex-sm-row gap-2">

            <a
                href="{{ route('admin.utilisateurs.edit', $user->id) }}"
                class="btn btn-primary px-4 d-inline-flex align-items-center justify-content-center gap-2"
            >
                <i class="bi bi-pencil-square"></i>
                Modifier l'utilisateur
            </a>


            {{-- Ne pas permettre de supprimer son propre compte --}}
            @if(auth()->id() !== $user->id)

                <form
                    action="{{ route('admin.utilisateurs.destroy', $user->id) }}"
                    method="POST"
                    onsubmit="return confirm('Voulez-vous vraiment supprimer le compte de {{ addslashes($user->name) }} ?');"
                >

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="btn btn-outline-danger px-4 d-inline-flex align-items-center justify-content-center gap-2 w-100"
                    >
                        <i class="bi bi-trash"></i>
                        Supprimer
                    </button>

                </form>

            @endif

        </div>

    </div>

</div>

@endsection