@extends('back.layouts.app')

@section('title', 'Détails du programme')

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
                <i class="bi bi-calendar-event fs-4"></i>
            </div>

            <div>
                <h3 class="fw-bold mb-1">
                    Détails du programme
                </h3>

                <p class="text-muted mb-0 small">
                    Consultez toutes les informations relatives à ce programme.
                </p>
            </div>

        </div>


        <div class="d-flex flex-wrap gap-2">

            <a
                href="{{ route('admin.programmes.index') }}"
                class="btn btn-light border d-inline-flex align-items-center gap-2"
            >
                <i class="bi bi-arrow-left"></i>
                Retour
            </a>

            <a
                href="{{ route('admin.programmes.edit', $programme->id) }}"
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
                <span>{{ session('success') }}</span>
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
                <span>{{ session('error') }}</span>
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
            COLONNE GAUCHE
        ====================================================== --}}
        <div class="col-12 col-xl-4">

            {{-- =================================================
                IMAGE
            ================================================== --}}
            <div class="card border-0 shadow-sm overflow-hidden mb-4">

                @if($programme->image)

                    <img
                        src="{{ asset('storage/' . $programme->image) }}"
                        alt="{{ $programme->title }}"
                        class="w-100"
                        style="
                            height: 280px;
                            object-fit: cover;
                        "
                    >

                @else

                    <div
                        class="d-flex flex-column align-items-center justify-content-center bg-light text-muted"
                        style="height: 280px;"
                    >

                        <div
                            class="d-flex align-items-center justify-content-center rounded-circle bg-white border mb-3"
                            style="width: 70px; height: 70px;"
                        >
                            <i class="bi bi-image fs-2"></i>
                        </div>

                        <span class="small">
                            Aucune image disponible
                        </span>

                    </div>

                @endif


                <div class="card-body p-4">

                    {{-- STATUT --}}
                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <span class="text-muted small">
                            Statut
                        </span>

                        @if($programme->is_active)

                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">

                                <i
                                    class="bi bi-circle-fill me-1"
                                    style="font-size: 6px;"
                                ></i>

                                Programme actif

                            </span>

                        @else

                            <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2">

                                <i class="bi bi-pause-circle me-1"></i>

                                Programme inactif

                            </span>

                        @endif

                    </div>


                    <hr>


                    {{-- IDENTIFIANT --}}
                    <div class="d-flex justify-content-between align-items-center">

                        <span class="text-muted small">
                            Identifiant
                        </span>

                        <strong>
                            #{{ $programme->id }}
                        </strong>

                    </div>

                </div>

            </div>


            {{-- =================================================
                INFORMATIONS TECHNIQUES
            ================================================== --}}
            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white border-bottom py-3">

                    <h6 class="fw-bold mb-0">
                        <i class="bi bi-info-circle text-primary me-2"></i>
                        Informations
                    </h6>

                </div>


                <div class="card-body">

                    {{-- CRÉATION --}}
                    <div class="pb-3 mb-3 border-bottom">

                        <small class="text-muted d-block mb-1">
                            Créé le
                        </small>

                        <div class="d-flex align-items-center gap-2">

                            <i class="bi bi-calendar-plus text-primary"></i>

                            <strong>
                                {{ $programme->created_at
                                    ? $programme->created_at->format('d/m/Y à H:i')
                                    : 'Non disponible' }}
                            </strong>

                        </div>

                    </div>


                    {{-- MODIFICATION --}}
                    <div>

                        <small class="text-muted d-block mb-1">
                            Dernière modification
                        </small>

                        <div class="d-flex align-items-center gap-2">

                            <i class="bi bi-clock-history text-muted"></i>

                            <strong>
                                {{ $programme->updated_at
                                    ? $programme->updated_at->format('d/m/Y à H:i')
                                    : 'Non disponible' }}
                            </strong>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            COLONNE DROITE
        ====================================================== --}}
        <div class="col-12 col-xl-8">

            {{-- =================================================
                PRÉSENTATION
            ================================================== --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-body p-4 p-lg-5">

                    {{-- STATUT --}}
                    <div class="mb-3">

                        @if($programme->is_active)

                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                <i class="bi bi-check-circle me-1"></i>
                                Actif
                            </span>

                        @else

                            <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2">
                                <i class="bi bi-pause-circle me-1"></i>
                                Inactif
                            </span>

                        @endif

                    </div>


                    {{-- TITRE --}}
                    <h2 class="fw-bold mb-3">
                        {{ $programme->title }}
                    </h2>


                    {{-- DESCRIPTION COURTE --}}
                    @if($programme->short_description)

                        <p
                            class="lead text-muted mb-0"
                            style="line-height: 1.7;"
                        >
                            {{ $programme->short_description }}
                        </p>

                    @else

                        <p class="text-muted mb-0">
                            Aucune description courte renseignée.
                        </p>

                    @endif

                </div>

            </div>


            {{-- =================================================
                LIEU ET PÉRIODE
            ================================================== --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white border-bottom py-3">

                    <div class="d-flex align-items-center gap-3">

                        <div
                            class="d-flex align-items-center justify-content-center rounded-circle bg-warning bg-opacity-10 text-warning"
                            style="width: 40px; height: 40px;"
                        >
                            <i class="bi bi-calendar3"></i>
                        </div>

                        <div>

                            <h5 class="fw-bold mb-0">
                                Lieu et période
                            </h5>

                            <small class="text-muted">
                                Informations pratiques du programme.
                            </small>

                        </div>

                    </div>

                </div>


                <div class="card-body p-4">

                    <div class="row g-4">

                        {{-- LIEU --}}
                        <div class="col-12 col-md-4">

                            <small class="text-muted d-block mb-2">
                                Lieu
                            </small>

                            <div class="d-flex align-items-center gap-3">

                                <div
                                    class="d-flex align-items-center justify-content-center rounded-circle bg-danger bg-opacity-10 text-danger flex-shrink-0"
                                    style="width: 42px; height: 42px;"
                                >
                                    <i class="bi bi-geo-alt"></i>
                                </div>

                                <div>

                                    @if($programme->location)

                                        <strong>
                                            {{ $programme->location }}
                                        </strong>

                                    @else

                                        <span class="text-muted">
                                            Non renseigné
                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>


                        {{-- DÉBUT --}}
                        <div class="col-12 col-md-4">

                            <small class="text-muted d-block mb-2">
                                Date de début
                            </small>

                            <div class="d-flex align-items-center gap-3">

                                <div
                                    class="d-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10 text-success flex-shrink-0"
                                    style="width: 42px; height: 42px;"
                                >
                                    <i class="bi bi-calendar-check"></i>
                                </div>

                                <div>

                                    @if($programme->start_date)

                                        <strong class="d-block">
                                            {{ \Carbon\Carbon::parse($programme->start_date)->format('d/m/Y') }}
                                        </strong>

                                    @else

                                        <span class="text-muted">
                                            Non renseignée
                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>


                        {{-- FIN --}}
                        <div class="col-12 col-md-4">

                            <small class="text-muted d-block mb-2">
                                Date de fin
                            </small>

                            <div class="d-flex align-items-center gap-3">

                                <div
                                    class="d-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary flex-shrink-0"
                                    style="width: 42px; height: 42px;"
                                >
                                    <i class="bi bi-calendar-x"></i>
                                </div>

                                <div>

                                    @if($programme->end_date)

                                        <strong class="d-block">
                                            {{ \Carbon\Carbon::parse($programme->end_date)->format('d/m/Y') }}
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

            </div>


            {{-- =================================================
                DESCRIPTION COMPLÈTE
            ================================================== --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white border-bottom py-3">

                    <div class="d-flex align-items-center gap-3">

                        <div
                            class="d-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary"
                            style="width: 40px; height: 40px;"
                        >
                            <i class="bi bi-card-text"></i>
                        </div>

                        <div>

                            <h5 class="fw-bold mb-0">
                                Description du programme
                            </h5>

                            <small class="text-muted">
                                Présentation complète et objectifs.
                            </small>

                        </div>

                    </div>

                </div>


                <div class="card-body p-4">

                    @if($programme->description)

                        <div
                            class="text-dark"
                            style="
                                line-height: 1.8;
                                white-space: pre-line;
                            "
                        >{{ $programme->description }}</div>

                    @else

                        <div class="text-center py-4">

                            <i class="bi bi-file-text fs-2 text-muted"></i>

                            <p class="text-muted mt-2 mb-0">
                                Aucune description disponible.
                            </p>

                        </div>

                    @endif

                </div>

            </div>


            {{-- =================================================
                RÉSUMÉ
            ================================================== --}}
            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white border-bottom py-3">

                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-list-check text-primary me-2"></i>
                        Résumé
                    </h5>

                </div>


                <div class="card-body p-4">

                    <div class="row g-3">

                        {{-- PROGRAMME --}}
                        <div class="col-12 col-md-6">

                            <div
                                class="p-3 rounded-3 bg-light h-100"
                            >

                                <small class="text-muted d-block mb-1">
                                    Programme
                                </small>

                                <strong>
                                    {{ $programme->title }}
                                </strong>

                            </div>

                        </div>


                        {{-- LIEU --}}
                        <div class="col-12 col-md-6">

                            <div
                                class="p-3 rounded-3 bg-light h-100"
                            >

                                <small class="text-muted d-block mb-1">
                                    Lieu
                                </small>

                                <strong>
                                    {{ $programme->location ?: 'Non renseigné' }}
                                </strong>

                            </div>

                        </div>


                        {{-- DÉBUT --}}
                        <div class="col-12 col-md-6">

                            <div
                                class="p-3 rounded-3 bg-light h-100"
                            >

                                <small class="text-muted d-block mb-1">
                                    Début
                                </small>

                                <strong>

                                    @if($programme->start_date)

                                        {{ \Carbon\Carbon::parse($programme->start_date)->format('d/m/Y') }}

                                    @else

                                        Non renseigné

                                    @endif

                                </strong>

                            </div>

                        </div>


                        {{-- FIN --}}
                        <div class="col-12 col-md-6">

                            <div
                                class="p-3 rounded-3 bg-light h-100"
                            >

                                <small class="text-muted d-block mb-1">
                                    Fin
                                </small>

                                <strong>

                                    @if($programme->end_date)

                                        {{ \Carbon\Carbon::parse($programme->end_date)->format('d/m/Y') }}

                                    @else

                                        Non renseigné

                                    @endif

                                </strong>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        ACTIONS BAS DE PAGE
    ========================================================== --}}
    <div
        class="d-flex flex-column flex-sm-row justify-content-between gap-3 mt-4"
    >

        <a
            href="{{ route('admin.programmes.index') }}"
            class="btn btn-light border d-inline-flex align-items-center justify-content-center gap-2"
        >
            <i class="bi bi-arrow-left"></i>
            Retour à la liste
        </a>


        <div class="d-flex flex-column flex-sm-row gap-2">

            {{-- MODIFIER --}}
            <a
                href="{{ route('admin.programmes.edit', $programme->id) }}"
                class="btn btn-primary px-4 d-inline-flex align-items-center justify-content-center gap-2"
            >
                <i class="bi bi-pencil-square"></i>
                Modifier le programme
            </a>


            {{-- SUPPRIMER --}}
            <form
                action="{{ route('admin.programmes.destroy', $programme->id) }}"
                method="POST"
                onsubmit="return confirm('Voulez-vous vraiment supprimer le programme « {{ addslashes($programme->title) }} » ?');"
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

        </div>

    </div>

</div>

@endsection