@extends('back.layouts.app')

@section('title', 'Témoignages')

@section('content')

    <div class="container-fluid py-4">

        {{-- =========================================================
        EN-TÊTE
        ========================================================== --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

            <div class="d-flex align-items-center gap-3">

                <div class="d-flex align-items-center justify-content-center rounded-3 bg-primary bg-opacity-10 text-primary flex-shrink-0"
                    style="width: 48px; height: 48px;">
                    <i class="bi bi-chat-quote fs-4"></i>
                </div>

                <div>
                    <h3 class="fw-bold mb-1">
                        Gestion des témoignages
                    </h3>

                    <p class="text-muted mb-0 small">
                        Gérez les témoignages et les expériences partagées avec YOULIDA.
                    </p>
                </div>

            </div>

            <a href="{{ route('admin.temoignages.create') }}"
                class="btn btn-primary d-inline-flex align-items-center justify-content-center gap-2 px-3">
                <i class="bi bi-plus-lg"></i>
                Ajouter un témoignage
            </a>

        </div>


        {{-- =========================================================
        MESSAGES
        ========================================================== --}}
        @if(session('success'))

            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">

                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>{{ session('success') }}</span>
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>

            </div>

        @endif


        @if(session('error'))

            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">

                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <span>{{ session('error') }}</span>
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>

            </div>

        @endif


        {{-- =========================================================
        STATISTIQUES
        ========================================================== --}}
        <div class="row g-3 mb-4">

            {{-- TOTAL --}}
            <div class="col-12 col-md-4">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body d-flex align-items-center justify-content-between">

                        <div>
                            <p class="text-muted small mb-1">
                                Total témoignages
                            </p>

                            <h3 class="fw-bold mb-0">
                                {{ $totalTemoignages }}
                            </h3>
                        </div>

                        <div class="d-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary"
                            style="width: 54px; height: 54px;">
                            <i class="bi bi-chat-quote fs-4"></i>
                        </div>

                    </div>

                </div>

            </div>


            {{-- PUBLIÉS --}}
            <div class="col-12 col-md-4">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body d-flex align-items-center justify-content-between">

                        <div>
                            <p class="text-muted small mb-1">
                                Publiés sur cette page
                            </p>

                            <h3 class="fw-bold text-success mb-0">
                                {{ $publishedTemoignages }}
                            </h3>
                        </div>

                        <div class="d-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10 text-success"
                            style="width: 54px; height: 54px;">
                            <i class="bi bi-check-circle fs-4"></i>
                        </div>

                    </div>

                </div>

            </div>


            {{-- NON PUBLIÉS --}}
            <div class="col-12 col-md-4">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body d-flex align-items-center justify-content-between">

                        <div>
                            <p class="text-muted small mb-1">
                                Non publiés sur cette page
                            </p>

                            <h3 class="fw-bold text-warning mb-0">
                                {{ $unpublishedTemoignages }}
                            </h3>
                        </div>

                        <div class="d-flex align-items-center justify-content-center rounded-circle bg-warning bg-opacity-10 text-warning"
                            style="width: 54px; height: 54px;">
                            <i class="bi bi-clock-history fs-4"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
        TABLEAU
        ========================================================== --}}
        <div class="card border-0 shadow-sm">

            {{-- HEADER TABLEAU --}}
            <div class="card-header bg-white border-bottom py-3">

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">

                    <div>
                        <h5 class="fw-bold mb-1">
                            Liste des témoignages
                        </h5>

                        <p class="text-muted small mb-0">
                            Consultez, publiez et gérez les témoignages enregistrés.
                        </p>
                    </div>


                    <span class="badge bg-light text-dark border px-3 py-2">

                        {{ $temoignages->total() }}

                        {{ $temoignages->total() > 1 ? 'témoignages' : 'témoignage' }}

                    </span>

                </div>

            </div>


            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>
                                <th class="ps-4 py-3">
                                    Personne
                                </th>

                                <th class="py-3">
                                    Contact
                                </th>

                                <th class="py-3">
                                    Témoignage
                                </th>

                                <th class="py-3">
                                    Statut
                                </th>

                                <th class="py-3">
                                    Date
                                </th>

                                <th class="py-3 text-end pe-4">
                                    Actions
                                </th>
                            </tr>

                        </thead>


                        <tbody>

                            @forelse($temoignages as $temoignage)

                                <tr>

                                    {{-- =========================================
                                    PHOTO + NOM
                                    ========================================== --}}
                                    <td class="ps-4">

                                        <div class="d-flex align-items-center gap-3">

                                            {{-- PHOTO RÉELLE --}}
                                            @if($temoignage->photo)

                                                <img src="{{ asset('storage/' . $temoignage->photo) }}"
                                                    alt="Photo de {{ $temoignage->name }}"
                                                    class="rounded-circle border shadow-sm flex-shrink-0" style="
                                                                width: 52px;
                                                                height: 52px;
                                                                object-fit: cover;
                                                            ">

                                            @else

                                                {{-- AVATAR SI AUCUNE PHOTO --}}
                                                <div class="d-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary fw-bold flex-shrink-0"
                                                    style="
                                                                width: 52px;
                                                                height: 52px;
                                                                font-size: 18px;
                                                            ">
                                                    {{ strtoupper(substr($temoignage->name, 0, 1)) }}
                                                </div>

                                            @endif


                                            <div style="min-width: 0;">

                                                <div class="fw-bold text-dark">
                                                    {{ $temoignage->name }}
                                                </div>

                                                <small class="text-muted">
                                                    Témoignage #{{ $temoignage->id }}
                                                </small>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- =========================================
                                    EMAIL
                                    ========================================== --}}
                                    <td>

                                        @if($temoignage->email)

                                            <a href="mailto:{{ $temoignage->email }}" class="text-decoration-none text-dark">

                                                <div class="d-flex align-items-center gap-2">

                                                    <div class="d-flex align-items-center justify-content-center rounded-circle bg-light text-muted flex-shrink-0"
                                                        style="width: 34px; height: 34px;">
                                                        <i class="bi bi-envelope"></i>
                                                    </div>

                                                    <span class="small">
                                                        {{ $temoignage->email }}
                                                    </span>

                                                </div>

                                            </a>

                                        @else

                                            <span class="text-muted small">
                                                Non renseigné
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =========================================
                                    APERÇU DU TÉMOIGNAGE
                                    ========================================== --}}
                                    <td style="max-width: 300px;">

                                        @if($temoignage->message)

                                            <div class="text-muted small" style="
                                                            display: -webkit-box;
                                                            -webkit-line-clamp: 2;
                                                            -webkit-box-orient: vertical;
                                                            overflow: hidden;
                                                            line-height: 1.5;
                                                        ">
                                                {{ $temoignage->message }}
                                            </div>

                                        @else

                                            <span class="text-muted small">
                                                Aucun contenu
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =========================================
                                    STATUT
                                    ========================================== --}}
                                    <td>

                                        @if($temoignage->is_published)

                                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                                <i class="bi bi-circle-fill me-1" style="font-size: 6px;"></i>

                                                Publié
                                            </span>

                                        @else

                                            <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2">
                                                <i class="bi bi-clock me-1"></i>
                                                Non publié
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =========================================
                                    DATE
                                    ========================================== --}}
                                    <td>

                                        <div class="d-flex align-items-center gap-2">

                                            <i class="bi bi-calendar3 text-muted"></i>

                                            <div>

                                                <div class="small fw-semibold">
                                                    {{ $temoignage->created_at->format('d/m/Y') }}
                                                </div>

                                                <small class="text-muted">
                                                    {{ $temoignage->created_at->format('H:i') }}
                                                </small>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- =========================================
                                    ACTIONS
                                    ========================================== --}}
                                    <td class="text-end pe-4">

                                        <div class="d-inline-flex align-items-center gap-1">

                                            {{-- VOIR --}}
                                            <a href="{{ route('admin.temoignages.show', $temoignage->id) }}"
                                                class="btn btn-sm btn-light border" title="Voir le témoignage">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>


                                            {{-- MODIFIER --}}
                                            <a href="{{ route('admin.temoignages.edit', $temoignage->id) }}"
                                                class="btn btn-sm btn-light border" title="Modifier le témoignage">
                                                <i class="fa-solid fa-pen-to-square text-primary"></i>
                                            </a>


                                            {{-- SUPPRIMER --}}
                                            <form action="{{ route('admin.temoignages.destroy', $temoignage->id) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Voulez-vous vraiment supprimer le témoignage de {{ addslashes($temoignage->name) }} ?');">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-light border"
                                                    title="Supprimer le témoignage">
                                                    <i class="fa-solid fa-trash text-danger"></i>
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                {{-- =========================================
                                AUCUN TÉMOIGNAGE
                                ========================================== --}}
                                <tr>

                                    <td colspan="6" class="text-center py-5">

                                        <div class="py-4">

                                            <div class="d-flex align-items-center justify-content-center rounded-circle bg-light mx-auto mb-3"
                                                style="width: 72px; height: 72px;">
                                                <i class="bi bi-chat-quote fs-2 text-muted"></i>
                                            </div>

                                            <h5 class="fw-bold">
                                                Aucun témoignage
                                            </h5>

                                            <p class="text-muted mb-3">
                                                Aucun témoignage n'a encore été enregistré.
                                            </p>

                                            <a href="{{ route('admin.temoignages.create') }}" class="btn btn-primary btn-sm">
                                                <i class="bi bi-plus-lg me-1"></i>
                                                Ajouter un témoignage
                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- =====================================================
            PAGINATION
            ====================================================== --}}
            @if($temoignages->hasPages())

                <div class="card-footer bg-white border-top py-3">

                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

                        <small class="text-muted">

                            Affichage de

                            <strong>
                                {{ $temoignages->firstItem() }}
                            </strong>

                            à

                            <strong>
                                {{ $temoignages->lastItem() }}
                            </strong>

                            sur

                            <strong>
                                {{ $temoignages->total() }}
                            </strong>

                            témoignages

                        </small>


                        <div>
                            {{ $temoignages->links() }}
                        </div>

                    </div>

                </div>

            @endif

        </div>

    </div>

@endsection