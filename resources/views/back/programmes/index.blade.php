@extends('back.layouts.app')

@section('title', 'Programmes')

@section('content')

    <div class="container-fluid py-4">

        {{-- =========================================================
        EN-TÊTE
        ========================================================== --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

            <div class="d-flex align-items-center gap-3">

                <div class="d-flex align-items-center justify-content-center rounded-3 bg-primary bg-opacity-10 text-primary flex-shrink-0"
                    style="width: 48px; height: 48px;">
                    <i class="bi bi-calendar-event fs-4"></i>
                </div>

                <div>
                    <h3 class="fw-bold mb-1">
                        Gestion des programmes
                    </h3>

                    <p class="text-muted mb-0 small">
                        Gérez les programmes, activités et événements proposés par YOULIDA.
                    </p>
                </div>

            </div>

            <a href="{{ route('admin.programmes.create') }}"
                class="btn btn-primary d-inline-flex align-items-center justify-content-center gap-2 px-3">
                <i class="bi bi-plus-lg"></i>
                Ajouter un programme
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
            <div class="col-12 col-sm-6 col-xl-4">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body d-flex justify-content-between align-items-center">

                        <div>
                            <p class="text-muted small mb-1">
                                Total programmes
                            </p>

                            <h3 class="fw-bold mb-0">
                                {{ $programmes->total() }}
                            </h3>
                        </div>

                        <div class="d-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary"
                            style="width: 52px; height: 52px;">
                            <i class="bi bi-calendar2-event fs-4"></i>
                        </div>

                    </div>

                </div>

            </div>


            {{-- ACTIFS SUR PAGE --}}
            <div class="col-12 col-sm-6 col-xl-4">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body d-flex justify-content-between align-items-center">

                        <div>
                            <p class="text-muted small mb-1">
                                Actifs sur cette page
                            </p>

                            <h3 class="fw-bold mb-0 text-success">
                                {{ $activeProgrammes }}
                            </h3>
                        </div>

                        <div class="d-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10 text-success"
                            style="width: 52px; height: 52px;">
                            <i class="bi bi-check-circle fs-4"></i>
                        </div>

                    </div>

                </div>

            </div>


            {{-- INACTIFS SUR PAGE --}}
            <div class="col-12 col-sm-6 col-xl-4">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body d-flex justify-content-between align-items-center">

                        <div>
                            <p class="text-muted small mb-1">
                                Inactifs sur cette page
                            </p>

                            <h3 class="fw-bold mb-0 text-secondary">
                                {{ $inactiveProgrammes }}
                            </h3>
                        </div>

                        <div class="d-flex align-items-center justify-content-center rounded-circle bg-secondary bg-opacity-10 text-secondary"
                            style="width: 52px; height: 52px;">
                            <i class="bi bi-pause-circle fs-4"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
        LISTE
        ========================================================== --}}
        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white border-bottom py-3">

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">

                    <div>

                        <h5 class="fw-bold mb-1">
                            Liste des programmes
                        </h5>

                        <p class="text-muted small mb-0">
                            Consultez et gérez les programmes enregistrés.
                        </p>

                    </div>

                    <span class="badge bg-light text-dark border px-3 py-2">

                        {{ $programmes->total() }}

                        {{ $programmes->total() > 1 ? 'programmes' : 'programme' }}

                    </span>

                </div>

            </div>


            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>
                                <th class="ps-4 py-3">Programme</th>
                                <th class="py-3">Lieu</th>
                                <th class="py-3">Début</th>
                                <th class="py-3">Fin</th>
                                <th class="py-3">Statut</th>
                                <th class="py-3 text-end pe-4">Actions</th>
                            </tr>

                        </thead>


                        <tbody>

                            @forelse($programmes as $programme)

                                <tr>

                                    {{-- =========================================
                                    IMAGE + PROGRAMME
                                    ========================================== --}}
                                    <td class="ps-4">

                                        <div class="d-flex align-items-center gap-3">

                                            {{-- IMAGE --}}
                                            @if($programme->image)

                                                                                <img src="{{ asset('storage/' . $programme->image) }}" alt="{{ $programme->title }}"
                                                                                    class="rounded-3 border" style="
                                                    width: 76px;
                                                    height: 58px;
                                                    object-fit: cover;
                                                    flex-shrink: 0;
                                                ">

                                            @else

                                                <div class="d-flex align-items-center justify-content-center rounded-3 bg-primary bg-opacity-10 text-primary flex-shrink-0"
                                                    style="
                                                                width: 76px;
                                                                height: 58px;
                                                            ">
                                                    <i class="bi bi-image fs-4"></i>
                                                </div>

                                            @endif


                                            <div style="min-width: 0;">

                                                <div class="fw-bold text-dark mb-1" style="
                                                            max-width: 280px;
                                                            overflow: hidden;
                                                            text-overflow: ellipsis;
                                                            white-space: nowrap;
                                                        " title="{{ $programme->title }}">
                                                    {{ $programme->title }}
                                                </div>

                                                <small class="text-muted">
                                                    Programme #{{ $programme->id }}
                                                </small>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- =========================================
                                    LIEU
                                    ========================================== --}}
                                    <td>

                                        @if($programme->location)

                                            <div class="d-flex align-items-center gap-2">

                                                <div class="d-flex align-items-center justify-content-center rounded-circle bg-danger bg-opacity-10 text-danger flex-shrink-0"
                                                    style="width: 34px; height: 34px;">
                                                    <i class="bi bi-geo-alt"></i>
                                                </div>

                                                <span class="small fw-semibold">
                                                    {{ $programme->location }}
                                                </span>

                                            </div>

                                        @else

                                            <span class="text-muted">
                                                Non renseigné
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =========================================
                                    DATE DÉBUT
                                    ========================================== --}}
                                    <td>

                                        @if($programme->start_date)

                                            <div class="d-flex align-items-center gap-2">

                                                <i class="bi bi-calendar-check text-success"></i>

                                                <div>

                                                    <div class="small fw-semibold">

                                                        {{ \Carbon\Carbon::parse($programme->start_date)->format('d/m/Y') }}

                                                    </div>

                                                    @if(
                                                            strlen((string) $programme->start_date) > 10
                                                        )

                                                        <small class="text-muted">
                                                            {{ \Carbon\Carbon::parse($programme->start_date)->format('H:i') }}
                                                        </small>

                                                    @endif

                                                </div>

                                            </div>

                                        @else

                                            <span class="text-muted">
                                                —
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =========================================
                                    DATE FIN
                                    ========================================== --}}
                                    <td>

                                        @if($programme->end_date)

                                            <div class="d-flex align-items-center gap-2">

                                                <i class="bi bi-calendar-x text-danger"></i>

                                                <div>

                                                    <div class="small fw-semibold">
                                                        {{ \Carbon\Carbon::parse($programme->end_date)->format('d/m/Y') }}
                                                    </div>

                                                    @if(
                                                            strlen((string) $programme->end_date) > 10
                                                        )

                                                        <small class="text-muted">
                                                            {{ \Carbon\Carbon::parse($programme->end_date)->format('H:i') }}
                                                        </small>

                                                    @endif

                                                </div>

                                            </div>

                                        @else

                                            <span class="text-muted">
                                                —
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =========================================
                                    STATUT
                                    ========================================== --}}
                                    <td>

                                        @if($programme->is_active)

                                            <span class="badge bg-success bg-opacity-10 text-success px-2 py-2">
                                                <i class="bi bi-circle-fill me-1" style="font-size: 6px;"></i>

                                                Actif
                                            </span>

                                        @else

                                            <span class="badge bg-secondary bg-opacity-10 text-secondary px-2 py-2">
                                                <i class="bi bi-pause-circle me-1"></i>
                                                Inactif
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =========================================
                                    ACTIONS
                                    ========================================== --}}
                                    <td class="text-end pe-4">

                                        <div class="d-inline-flex align-items-center gap-1">

                                            {{-- VOIR --}}
                                            <a href="{{ route('admin.programmes.show', $programme->id) }}"
                                                class="btn btn-sm btn-light border" title="Voir le programme">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>


                                            {{-- MODIFIER --}}
                                            <a href="{{ route('admin.programmes.edit', $programme->id) }}"
                                                class="btn btn-sm btn-light border" title="Modifier le programme">
                                                <i class="fa-solid fa-pen-to-square text-primary"></i>
                                            </a>


                                            {{-- SUPPRIMER --}}
                                            <form action="{{ route('admin.programmes.destroy', $programme->id) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Voulez-vous vraiment supprimer le programme « {{ addslashes($programme->title) }} » ?');">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-light border"
                                                    title="Supprimer le programme">
                                                    <i class="fa-solid fa-trash text-danger"></i>
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                {{-- =========================================
                                ÉTAT VIDE
                                ========================================== --}}
                                <tr>

                                    <td colspan="6" class="text-center py-5">

                                        <div class="py-4">

                                            <div class="d-flex align-items-center justify-content-center rounded-circle bg-light mx-auto mb-3"
                                                style="width: 72px; height: 72px;">
                                                <i class="bi bi-calendar-x fs-2 text-muted"></i>
                                            </div>

                                            <h5 class="fw-bold">
                                                Aucun programme
                                            </h5>

                                            <p class="text-muted mb-3">
                                                Aucun programme n'a encore été enregistré.
                                            </p>

                                            <a href="{{ route('admin.programmes.create') }}" class="btn btn-primary btn-sm">
                                                <i class="bi bi-plus-lg me-1"></i>
                                                Ajouter un programme
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
            @if($programmes->hasPages())

                <div class="card-footer bg-white border-top py-3">

                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

                        <small class="text-muted">

                            Affichage de

                            <strong>
                                {{ $programmes->firstItem() }}
                            </strong>

                            à

                            <strong>
                                {{ $programmes->lastItem() }}
                            </strong>

                            sur

                            <strong>
                                {{ $totalProgrammes }}
                            </strong>

                            programmes

                        </small>


                        <div>
                            {{ $programmes->links() }}
                        </div>

                    </div>

                </div>

            @endif

        </div>

    </div>

@endsection