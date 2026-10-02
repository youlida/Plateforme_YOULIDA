@extends('back.layouts.app')

@section('title', 'Détails du rôle')

@section('content')

<div class="container-fluid py-4">

    {{-- =========================================================
        EN-TÊTE
    ========================================================== --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

        <div class="d-flex align-items-center gap-3">

            <div
                class="d-flex align-items-center justify-content-center rounded-3 bg-primary bg-opacity-10 text-primary flex-shrink-0"
                style="width: 50px; height: 50px;"
            >
                <i class="bi bi-shield-check fs-4"></i>
            </div>

            <div>

                <div class="d-flex align-items-center flex-wrap gap-2">

                    <h3 class="fw-bold mb-0">
                        {{ $role->name }}
                    </h3>

                    @if(in_array($role->slug, ['admin', 'superadmin']))
                        <span class="badge bg-success bg-opacity-10 text-success">
                            Rôle système
                        </span>
                    @endif

                </div>

                <p class="text-muted mb-0 mt-1 small">
                    Consultez les informations détaillées de ce rôle.
                </p>

            </div>

        </div>


        <div class="d-flex align-items-center gap-2">

            <a
                href="{{ route('admin.roles.index') }}"
                class="btn btn-light border d-inline-flex align-items-center gap-2"
            >
                <i class="bi bi-arrow-left"></i>
                Retour
            </a>

            <a
                href="{{ route('admin.roles.edit', $role->id) }}"
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
            INFORMATIONS PRINCIPALES
        ====================================================== --}}
        <div class="col-12 col-xl-8">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-header bg-white border-bottom py-3">

                    <div class="d-flex align-items-center gap-3">

                        <div
                            class="d-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary"
                            style="width: 40px; height: 40px;"
                        >
                            <i class="bi bi-info-circle"></i>
                        </div>

                        <div>

                            <h5 class="fw-bold mb-0">
                                Informations du rôle
                            </h5>

                            <small class="text-muted">
                                Informations générales et techniques.
                            </small>

                        </div>

                    </div>

                </div>


                <div class="card-body p-4">

                    {{-- NOM --}}
                    <div class="border-bottom pb-4 mb-4">

                        <small class="text-muted d-block mb-2">
                            Nom du rôle
                        </small>

                        <div class="d-flex align-items-center gap-3">

                            <div
                                class="d-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary"
                                style="width: 44px; height: 44px;"
                            >
                                <i class="bi bi-person-lock"></i>
                            </div>

                            <h5 class="fw-bold mb-0">
                                {{ $role->name }}
                            </h5>

                        </div>

                    </div>


                    {{-- SLUG --}}
                    <div class="border-bottom pb-4 mb-4">

                        <small class="text-muted d-block mb-2">
                            Slug
                        </small>

                        <code
                            class="d-inline-block px-3 py-2 rounded bg-light text-primary border"
                        >
                            {{ $role->slug }}
                        </code>

                        <p class="text-muted small mt-2 mb-0">
                            Identifiant technique utilisé par l'application
                            pour reconnaître ce rôle.
                        </p>

                    </div>


                    {{-- DESCRIPTION --}}
                    <div>

                        <small class="text-muted d-block mb-2">
                            Description
                        </small>

                        @if($role->description)

                            <p class="mb-0 text-dark">
                                {{ $role->description }}
                            </p>

                        @else

                            <div class="text-muted fst-italic">
                                Aucune description n'a été renseignée pour ce rôle.
                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            INFORMATIONS TECHNIQUES
        ====================================================== --}}
        <div class="col-12 col-xl-4">

            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white border-bottom py-3">

                    <h6 class="fw-bold mb-0">
                        <i class="bi bi-gear me-2 text-primary"></i>
                        Informations techniques
                    </h6>

                </div>


                <div class="card-body">

                    {{-- ID --}}
                    <div class="d-flex justify-content-between align-items-center py-3 border-bottom">

                        <span class="text-muted small">
                            Identifiant
                        </span>

                        <strong>
                            #{{ $role->id }}
                        </strong>

                    </div>


                    {{-- SLUG --}}
                    <div class="d-flex justify-content-between align-items-center py-3 border-bottom gap-3">

                        <span class="text-muted small">
                            Slug
                        </span>

                        <code>
                            {{ $role->slug }}
                        </code>

                    </div>


                    {{-- DATE CREATION --}}
                    <div class="py-3 border-bottom">

                        <span class="text-muted small d-block mb-1">
                            Créé le
                        </span>

                        <strong>
                            {{ $role->created_at->format('d/m/Y à H:i') }}
                        </strong>

                    </div>


                    {{-- MODIFICATION --}}
                    <div class="py-3">

                        <span class="text-muted small d-block mb-1">
                            Dernière modification
                        </span>

                        <strong>
                            {{ $role->updated_at->format('d/m/Y à H:i') }}
                        </strong>

                    </div>

                </div>

            </div>


            {{-- =================================================
                STATUT
            ================================================== --}}
            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <small class="text-muted d-block mb-3">
                        Type de rôle
                    </small>


                    @if($role->slug === 'superadmin')

                        <div class="d-flex align-items-center gap-3">

                            <div
                                class="d-flex align-items-center justify-content-center rounded-circle bg-danger bg-opacity-10 text-danger flex-shrink-0"
                                style="width: 46px; height: 46px;"
                            >
                                <i class="bi bi-shield-lock-fill"></i>
                            </div>

                            <div>

                                <strong class="d-block">
                                    Super Administrateur
                                </strong>

                                <small class="text-muted">
                                    Rôle système sensible.
                                </small>

                            </div>

                        </div>


                    @elseif($role->slug === 'admin')

                        <div class="d-flex align-items-center gap-3">

                            <div
                                class="d-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary flex-shrink-0"
                                style="width: 46px; height: 46px;"
                            >
                                <i class="bi bi-shield-check"></i>
                            </div>

                            <div>

                                <strong class="d-block">
                                    Administrateur
                                </strong>

                                <small class="text-muted">
                                    Rôle d'administration.
                                </small>

                            </div>

                        </div>


                    @else

                        <div class="d-flex align-items-center gap-3">

                            <div
                                class="d-flex align-items-center justify-content-center rounded-circle bg-secondary bg-opacity-10 text-secondary flex-shrink-0"
                                style="width: 46px; height: 46px;"
                            >
                                <i class="bi bi-person-badge"></i>
                            </div>

                            <div>

                                <strong class="d-block">
                                    Rôle personnalisé
                                </strong>

                                <small class="text-muted">
                                    Rôle ajouté à la plateforme.
                                </small>

                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        AVERTISSEMENT RÔLES SYSTÈME
    ========================================================== --}}

    @if(in_array($role->slug, ['admin', 'superadmin']))

        <div class="alert alert-warning border-0 shadow-sm mt-4">

            <div class="d-flex align-items-start gap-3">

                <div
                    class="d-flex align-items-center justify-content-center rounded-circle bg-warning bg-opacity-10 text-warning flex-shrink-0"
                    style="width: 44px; height: 44px;"
                >
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>

                <div>

                    <h6 class="fw-bold mb-1">
                        Rôle système sensible
                    </h6>

                    <p class="mb-0 small">
                        Ce rôle participe au contrôle d'accès au back-office.
                        Sa modification doit être effectuée avec précaution,
                        notamment concernant son slug.
                    </p>

                </div>

            </div>

        </div>

    @endif


    {{-- =========================================================
        ACTIONS
    ========================================================== --}}
    <div class="d-flex flex-column flex-sm-row justify-content-between gap-3 mt-4">

        <a
            href="{{ route('admin.roles.index') }}"
            class="btn btn-light border d-inline-flex align-items-center justify-content-center gap-2"
        >
            <i class="bi bi-arrow-left"></i>
            Retour à la liste
        </a>


        <div class="d-flex flex-column flex-sm-row gap-2">

            <a
                href="{{ route('admin.roles.edit', $role->id) }}"
                class="btn btn-primary px-4 d-inline-flex align-items-center justify-content-center gap-2"
            >
                <i class="bi bi-pencil-square"></i>
                Modifier
            </a>


            {{-- Ne pas proposer visuellement la suppression
                 des rôles système sensibles --}}
            @if(!in_array($role->slug, ['admin', 'superadmin']))

                <form
                    action="{{ route('admin.roles.destroy', $role->id) }}"
                    method="POST"
                    onsubmit="return confirm(
                        'Voulez-vous vraiment supprimer le rôle « {{ addslashes($role->name) }} » ?'
                    );"
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