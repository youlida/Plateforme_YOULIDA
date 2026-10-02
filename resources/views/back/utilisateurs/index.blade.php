@extends('back.layouts.app')

@section('title', 'Utilisateurs')

@section('content')

    <div class="container-fluid py-4">

        {{-- =========================================================
        EN-TÊTE
        ========================================================== --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

            <div class="d-flex align-items-center gap-3">

                <div class="d-flex align-items-center justify-content-center rounded-3 bg-primary bg-opacity-10 text-primary flex-shrink-0"
                    style="width: 48px; height: 48px;">
                    <i class="bi bi-people fs-4"></i>
                </div>

                <div>
                    <h3 class="fw-bold mb-1">
                        Gestion des utilisateurs
                    </h3>

                    <p class="text-muted mb-0 small">
                        Gérez les comptes, les rôles et l'accès au back-office YOULIDA.
                    </p>
                </div>

            </div>


            <a href="{{ route('admin.utilisateurs.create') }}"
                class="btn btn-primary d-inline-flex align-items-center justify-content-center gap-2 px-3">
                <i class="bi bi-person-plus"></i>
                Ajouter un utilisateur
            </a>

        </div>


        {{-- =========================================================
        MESSAGES
        ========================================================== --}}
        @if(session('success'))

            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-check-circle-fill"></i>

                    <span>
                        {{ session('success') }}
                    </span>
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>

        @endif


        @if(session('error'))

            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-exclamation-triangle-fill"></i>

                    <span>
                        {{ session('error') }}
                    </span>
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

                    <div class="card-body d-flex align-items-center justify-content-between">

                        <div>
                            <p class="text-muted small mb-1">
                                Utilisateurs
                            </p>

                            <h3 class="fw-bold mb-0">
                                {{ $totalUsers }}
                            </h3>
                        </div>

                        <div class="d-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary"
                            style="width: 52px; height: 52px;">
                            <i class="bi bi-people fs-4"></i>
                        </div>

                    </div>

                </div>

            </div>


            {{-- ACTIFS --}}
            <div class="col-12 col-sm-6 col-xl-4">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body d-flex align-items-center justify-content-between">

                        <div>
                            <p class="text-muted small mb-1">
                                Actifs sur cette page
                            </p>

                            <h3 class="fw-bold mb-0 text-success">
                                {{ $activeUsers }}
                            </h3>
                        </div>

                        <div class="d-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10 text-success"
                            style="width: 52px; height: 52px;">
                            <i class="bi bi-person-check fs-4"></i>
                        </div>

                    </div>

                </div>

            </div>


            {{-- BLOQUÉS --}}
            <div class="col-12 col-sm-6 col-xl-4">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body d-flex align-items-center justify-content-between">

                        <div>
                            <p class="text-muted small mb-1">
                                Bloqués sur cette page
                            </p>

                            <h3 class="fw-bold mb-0 text-danger">
{{ $blockedUsers }}                            </h3>
                        </div>

                        <div class="d-flex align-items-center justify-content-center rounded-circle bg-danger bg-opacity-10 text-danger"
                            style="width: 52px; height: 52px;">
                            <i class="bi bi-person-x fs-4"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
        TABLEAU
        ========================================================== --}}
        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white border-bottom py-3">

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">

                    <div>
                        <h5 class="fw-bold mb-1">
                            Liste des utilisateurs
                        </h5>

                        <p class="text-muted small mb-0">
                            Comptes actuellement enregistrés sur la plateforme.
                        </p>
                    </div>

                    <span class="badge bg-light text-dark border px-3 py-2">
                        {{ $totalUsers }}
                        {{ $users->total() > 1 ? 'utilisateurs' : 'utilisateur' }}
                    </span>

                </div>

            </div>


            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>
                                <th class="ps-4 py-3">Utilisateur</th>
                                <th class="py-3">Contact</th>
                                <th class="py-3">Localisation</th>
                                <th class="py-3">Rôle</th>
                                <th class="py-3">Statut</th>
                                <th class="py-3">Création</th>
                                <th class="py-3 text-end pe-4">Actions</th>
                            </tr>

                        </thead>


                        <tbody>

                            @forelse($users as $user)

                                <tr>

                                    {{-- =========================================
                                    PHOTO + IDENTITÉ
                                    ========================================== --}}
                                    <td class="ps-4">

                                        <div class="d-flex align-items-center gap-3">

                                            {{-- PHOTO --}}
                                            @if($user->photo)

                                                <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}"
                                                    class="rounded-circle border" style="
                                                                width: 48px;
                                                                height: 48px;
                                                                object-fit: cover;
                                                                flex-shrink: 0;
                                                            ">

                                            @else

                                                {{-- AVATAR SI PAS DE PHOTO --}}
                                                <div class="d-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary fw-bold flex-shrink-0"
                                                    style="width: 48px; height: 48px;">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </div>

                                            @endif


                                            <div style="min-width: 0;">

                                                <div class="fw-bold text-dark">
                                                    {{ $user->name }}
                                                    {{ $user->prenom }}
                                                </div>

                                                <small class="text-muted">
                                                    #{{ $user->id }}
                                                </small>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- =========================================
                                    CONTACT
                                    ========================================== --}}
                                    <td>

                                        <div class="mb-1">

                                            <i class="bi bi-envelope text-muted me-1"></i>

                                            <span class="small">
                                                {{ $user->email }}
                                            </span>

                                        </div>


                                        @if($user->telephone)

                                            <div>

                                                <i class="bi bi-telephone text-muted me-1"></i>

                                                <span class="small text-muted">
                                                    {{ $user->telephone }}
                                                </span>

                                            </div>

                                        @else

                                            <small class="text-muted">
                                                Aucun téléphone
                                            </small>

                                        @endif

                                    </td>


                                    {{-- =========================================
                                    LOCALISATION
                                    ========================================== --}}
                                    <td>

                                        @if($user->ville || $user->pays)

                                            <div class="d-flex align-items-start gap-2">

                                                <i class="bi bi-geo-alt text-muted"></i>

                                                <div>

                                                    @if($user->ville)
                                                        <div class="small fw-semibold">
                                                            {{ $user->ville }}
                                                        </div>
                                                    @endif

                                                    @if($user->pays)
                                                        <small class="text-muted">
                                                            {{ $user->pays }}
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
                                    RÔLE
                                    ========================================== --}}
                                    <td>

                                        @if($user->role)

                                            @if($user->role->slug === 'superadmin')

                                                <span class="badge bg-danger bg-opacity-10 text-danger px-2 py-2">
                                                    <i class="bi bi-shield-lock me-1"></i>
                                                    {{ $user->role->name }}
                                                </span>

                                            @elseif($user->role->slug === 'admin')

                                                <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-2">
                                                    <i class="bi bi-shield-check me-1"></i>
                                                    {{ $user->role->name }}
                                                </span>

                                            @else

                                                <span class="badge bg-secondary bg-opacity-10 text-secondary px-2 py-2">
                                                    {{ $user->role->name }}
                                                </span>

                                            @endif

                                        @else

                                            <span class="badge bg-light text-muted border">
                                                Aucun rôle
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =========================================
                                    STATUT
                                    ========================================== --}}
                                    <td>

                                        @if($user->is_active)

                                            <span class="badge bg-success bg-opacity-10 text-success px-2 py-2">
                                                <i class="bi bi-circle-fill me-1" style="font-size: 6px;"></i>
                                                Actif
                                            </span>

                                        @else

                                            <span class="badge bg-danger bg-opacity-10 text-danger px-2 py-2">
                                                <i class="bi bi-slash-circle me-1"></i>
                                                Bloqué
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =========================================
                                    DATE
                                    ========================================== --}}
                                    <td>

                                        <div class="small fw-semibold">
                                            {{ $user->created_at->format('d/m/Y') }}
                                        </div>

                                        <small class="text-muted">
                                            {{ $user->created_at->format('H:i') }}
                                        </small>

                                    </td>


                                    {{-- =========================================
                                    ACTIONS
                                    ========================================== --}}
                                    <td class="text-end pe-4">

                                        <div class="d-inline-flex align-items-center gap-1">

                                            {{-- VOIR --}}
                                            <a href="{{ route('admin.utilisateurs.show', $user->id) }}"
                                                class="btn btn-sm btn-light border" title="Voir">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>


                                            {{-- MODIFIER --}}
                                            <a href="{{ route('admin.utilisateurs.edit', $user->id) }}"
                                                class="btn btn-sm btn-light border" title="Modifier">
                                                <i class="fa-solid fa-pen-to-square text-primary"></i>
                                            </a>


                                            {{-- SUPPRIMER --}}
                                            <form action="{{ route('admin.utilisateurs.destroy', $user->id) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-light border" title="Supprimer">
                                                    <i class="fa-solid fa-trash text-danger"></i>
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                {{-- =========================================
                                AUCUN UTILISATEUR
                                ========================================== --}}
                                <tr>

                                    <td colspan="7" class="text-center py-5">

                                        <div class="py-4">

                                            <div class="d-flex align-items-center justify-content-center rounded-circle bg-light mx-auto mb-3"
                                                style="width: 72px; height: 72px;">
                                                <i class="bi bi-people fs-2 text-muted"></i>
                                            </div>

                                            <h5 class="fw-bold">
                                                Aucun utilisateur
                                            </h5>

                                            <p class="text-muted mb-3">
                                                Aucun compte utilisateur n'a encore été enregistré.
                                            </p>

                                            <a href="{{ route('admin.utilisateurs.create') }}" class="btn btn-primary btn-sm">
                                                <i class="bi bi-person-plus me-1"></i>
                                                Ajouter un utilisateur
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
            @if($users->hasPages())

                <div class="card-footer bg-white border-top py-3">

                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

                        <small class="text-muted">

                            Affichage de

                            <strong>
                                {{ $users->firstItem() }}
                            </strong>

                            à

                            <strong>
                                {{ $users->lastItem() }}
                            </strong>

                            sur

                            <strong>
                                {{ $totalUsers }}
                            </strong>

                            utilisateurs

                        </small>

                        <div>
                            {{ $users->links() }}
                        </div>

                    </div>

                </div>

            @endif

        </div>

    </div>

@endsection