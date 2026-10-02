@extends('back.layouts.app')

@section('title', 'Détails du bénévole')

@section('content')

<div class="container-fluid">

    {{-- =====================================================
        EN-TÊTE
    ====================================================== --}}
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">

        <div>

            <a
                href="{{ route('admin.benevoles.index') }}"
                class="text-decoration-none text-muted d-inline-block mb-2"
            >
                <i class="fa-solid fa-arrow-left me-1"></i>
                Retour aux bénévoles
            </a>

            <h1 class="h3 mb-1">
                Détails du bénévole
            </h1>

            <p class="text-muted mb-0">
                Consultez les informations et la candidature de ce bénévole.
            </p>

        </div>


        <div class="d-flex gap-2">

            <a
                href="{{ route('admin.benevoles.edit', $benevole) }}"
                class="btn btn-outline-primary"
            >
                <i class="fa-solid fa-pen me-2"></i>
                Modifier
            </a>

            <form
                action="{{ route('admin.benevoles.destroy', $benevole) }}"
                method="POST"
                onsubmit="
                    return confirm(
                        'Supprimer définitivement ce bénévole ?'
                    );
                "
            >
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="btn btn-outline-danger"
                >
                    <i class="fa-regular fa-trash-can me-2"></i>
                    Supprimer
                </button>

            </form>

        </div>

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
            COLONNE PRINCIPALE
        ================================================== --}}
        <div class="col-lg-8">


            {{-- =============================================
                PROFIL
            ============================================== --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-body p-4">

                    <div class="d-flex align-items-center flex-wrap gap-3">

                        {{-- Avatar --}}
                        <div
                            class="d-flex align-items-center justify-content-center
                                   rounded-circle bg-primary bg-opacity-10
                                   text-primary fw-bold fs-3"
                            style="
                                width: 75px;
                                height: 75px;
                                min-width: 75px;
                            "
                        >
                            {{ strtoupper(
                                substr(
                                    $benevole->prenom ?: $benevole->name,
                                    0,
                                    1
                                )
                            ) }}
                        </div>


                        {{-- Identité --}}
                        <div class="flex-grow-1">

                            <h3 class="mb-1">
                                {{ $benevole->prenom }}
                                {{ $benevole->name }}
                            </h3>

                            <div class="text-muted">

                                <span class="me-3">
                                    <i class="fa-solid fa-hashtag me-1"></i>
                                    {{ $benevole->id }}
                                </span>

                                <span>
                                    <i class="fa-regular fa-calendar me-1"></i>

                                    Inscrit le
                                    {{ $benevole->created_at->format('d/m/Y') }}
                                </span>

                            </div>

                        </div>


                        {{-- Statut --}}
                        <div>

                            @if($benevole->is_approved)

                                <span
                                    class="badge bg-success bg-opacity-10
                                           text-success px-3 py-2 fs-6"
                                >
                                    <i class="fa-solid fa-circle-check me-1"></i>
                                    Approuvé
                                </span>

                            @else

                                <span
                                    class="badge bg-warning bg-opacity-10
                                           text-dark px-3 py-2 fs-6"
                                >
                                    <i class="fa-solid fa-clock me-1"></i>
                                    En attente
                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>


            {{-- =============================================
                COORDONNÉES
            ============================================== --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white py-3">

                    <div class="d-flex align-items-center gap-2">

                        <div
                            class="d-flex align-items-center justify-content-center
                                   rounded-circle bg-info bg-opacity-10 text-info"
                            style="width: 38px; height: 38px;"
                        >
                            <i class="fa-regular fa-address-card"></i>
                        </div>

                        <div>

                            <h5 class="mb-0">
                                Coordonnées
                            </h5>

                            <small class="text-muted">
                                Informations de contact
                            </small>

                        </div>

                    </div>

                </div>


                <div class="card-body">

                    <div class="row g-4">

                        {{-- Email --}}
                        <div class="col-md-6">

                            <small class="text-muted d-block mb-1">
                                Adresse e-mail
                            </small>

                            @if($benevole->email)

                                <a
                                    href="mailto:{{ $benevole->email }}"
                                    class="text-decoration-none fw-semibold"
                                >
                                    <i class="fa-regular fa-envelope me-2"></i>
                                    {{ $benevole->email }}
                                </a>

                            @else

                                <span class="text-muted">
                                    Non renseignée
                                </span>

                            @endif

                        </div>


                        {{-- Téléphone --}}
                        <div class="col-md-6">

                            <small class="text-muted d-block mb-1">
                                Téléphone
                            </small>

                            @if($benevole->telephone)

                                <a
                                    href="tel:{{ $benevole->telephone }}"
                                    class="text-decoration-none fw-semibold"
                                >
                                    <i class="fa-solid fa-phone me-2"></i>
                                    {{ $benevole->telephone }}
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


            {{-- =============================================
                LOCALISATION
            ============================================== --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white py-3">

                    <div class="d-flex align-items-center gap-2">

                        <div
                            class="d-flex align-items-center justify-content-center
                                   rounded-circle bg-warning bg-opacity-10 text-warning"
                            style="width: 38px; height: 38px;"
                        >
                            <i class="fa-solid fa-location-dot"></i>
                        </div>

                        <div>

                            <h5 class="mb-0">
                                Localisation
                            </h5>

                            <small class="text-muted">
                                Lieu de résidence du bénévole
                            </small>

                        </div>

                    </div>

                </div>


                <div class="card-body">

                    <div class="row g-4">

                        {{-- Pays --}}
                        <div class="col-md-6">

                            <small class="text-muted d-block mb-1">
                                Pays
                            </small>

                            <strong>
                                {{ $benevole->pays ?: 'Non renseigné' }}
                            </strong>

                        </div>


                        {{-- Ville --}}
                        <div class="col-md-6">

                            <small class="text-muted d-block mb-1">
                                Ville
                            </small>

                            <strong>
                                {{ $benevole->ville ?: 'Non renseignée' }}
                            </strong>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =============================================
                MOTIVATION
            ============================================== --}}
            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white py-3">

                    <div class="d-flex align-items-center gap-2">

                        <div
                            class="d-flex align-items-center justify-content-center
                                   rounded-circle bg-success bg-opacity-10 text-success"
                            style="width: 38px; height: 38px;"
                        >
                            <i class="fa-regular fa-message"></i>
                        </div>

                        <div>

                            <h5 class="mb-0">
                                Motivation
                            </h5>

                            <small class="text-muted">
                                Message envoyé avec la candidature
                            </small>

                        </div>

                    </div>

                </div>


                <div class="card-body">

                    @if($benevole->motivation)

                        <div
                            class="bg-light rounded-3 p-4"
                            style="white-space: pre-line; line-height: 1.8;"
                        >{{ $benevole->motivation }}</div>

                    @else

                        <div class="text-center py-4 text-muted">

                            <i class="fa-regular fa-message fs-3 d-block mb-2"></i>

                            Aucune motivation renseignée.

                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- =================================================
            COLONNE LATÉRALE
        ================================================== --}}
        <div class="col-lg-4">


            {{-- =============================================
                STATUT DE LA CANDIDATURE
            ============================================== --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white py-3">

                    <h5 class="mb-0">
                        Statut de la candidature
                    </h5>

                </div>


                <div class="card-body">

                    @if($benevole->is_approved)

                        <div class="d-flex gap-3">

                            <div
                                class="d-flex align-items-center justify-content-center
                                       rounded-circle bg-success bg-opacity-10
                                       text-success"
                                style="
                                    width: 45px;
                                    height: 45px;
                                    min-width: 45px;
                                "
                            >
                                <i class="fa-solid fa-user-check"></i>
                            </div>

                            <div>

                                <strong class="text-success d-block">
                                    Bénévole approuvé
                                </strong>

                                <small class="text-muted">
                                    Cette candidature a été validée
                                    par l'équipe YOULIDA.
                                </small>

                            </div>

                        </div>

                    @else

                        <div class="d-flex gap-3">

                            <div
                                class="d-flex align-items-center justify-content-center
                                       rounded-circle bg-warning bg-opacity-10
                                       text-warning"
                                style="
                                    width: 45px;
                                    height: 45px;
                                    min-width: 45px;
                                "
                            >
                                <i class="fa-solid fa-hourglass-half"></i>
                            </div>

                            <div>

                                <strong class="d-block">
                                    En attente d'approbation
                                </strong>

                                <small class="text-muted">
                                    La candidature doit encore être examinée
                                    par l'équipe YOULIDA.
                                </small>

                            </div>

                        </div>

                    @endif

                </div>

            </div>


            {{-- =============================================
                INFORMATIONS TECHNIQUES
            ============================================== --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white py-3">

                    <h5 class="mb-0">
                        Informations
                    </h5>

                </div>


                <div class="card-body">

                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Identifiant
                        </small>

                        <strong>
                            #{{ $benevole->id }}
                        </strong>

                    </div>


                    <hr>


                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Candidature reçue
                        </small>

                        <strong>
                            {{ $benevole->created_at->format('d/m/Y à H:i') }}
                        </strong>

                    </div>


                    <hr>


                    <div>

                        <small class="text-muted d-block">
                            Dernière modification
                        </small>

                        <strong>
                            {{ $benevole->updated_at->format('d/m/Y à H:i') }}
                        </strong>

                    </div>

                </div>

            </div>


            {{-- =============================================
                ACTIONS
            ============================================== --}}
            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white py-3">

                    <h5 class="mb-0">
                        Actions
                    </h5>

                </div>


                <div class="card-body">

                    <a
                        href="{{ route('admin.benevoles.edit', $benevole) }}"
                        class="btn btn-primary w-100 mb-2"
                    >
                        <i class="fa-solid fa-pen me-2"></i>
                        Modifier la candidature
                    </a>


                    <a
                        href="{{ route('admin.benevoles.index') }}"
                        class="btn btn-outline-secondary w-100"
                    >
                        <i class="fa-solid fa-arrow-left me-2"></i>
                        Retour à la liste
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
