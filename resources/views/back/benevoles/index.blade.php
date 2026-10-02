@extends('back.layouts.app')

@section('title', 'Bénévoles')

@section('content')

<div class="container-fluid">

    {{-- =====================================================
        EN-TÊTE
    ====================================================== --}}
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">

        <div>
            <h1 class="h3 mb-1">
                Gestion des bénévoles
            </h1>

            <p class="text-muted mb-0">
                Consultez, recherchez et gérez les candidatures
                de bénévolat reçues par YOULIDA.
            </p>
        </div>

        <a
            href="{{ route('admin.benevoles.create') }}"
            class="btn btn-primary"
        >
            <i class="fa-solid fa-user-plus me-2"></i>
            Ajouter un bénévole
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


    {{-- =====================================================
        STATISTIQUES
    ====================================================== --}}
    <div class="row g-3 mb-4">

        {{-- Total --}}
        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body d-flex align-items-center gap-3">

                    <div
                        class="d-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary"
                        style="width: 52px; height: 52px; min-width: 52px;"
                    >
                        <i class="fa-solid fa-users fs-5"></i>
                    </div>

                    <div>
                        <small class="text-muted d-block">
                            Total des bénévoles
                        </small>

                        <strong class="fs-4">
                            {{ $totalBenevoles }}
                        </strong>
                    </div>

                </div>

            </div>

        </div>


        {{-- En attente --}}
        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body d-flex align-items-center gap-3">

                    <div
                        class="d-flex align-items-center justify-content-center rounded-circle bg-warning bg-opacity-10 text-warning"
                        style="width: 52px; height: 52px; min-width: 52px;"
                    >
                        <i class="fa-solid fa-clock fs-5"></i>
                    </div>

                    <div>
                        <small class="text-muted d-block">
                            En attente
                        </small>

                        <strong class="fs-4">
                            {{ $pendingBenevoles }}
                        </strong>
                    </div>

                </div>

            </div>

        </div>


        {{-- Approuvés --}}
        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body d-flex align-items-center gap-3">

                    <div
                        class="d-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10 text-success"
                        style="width: 52px; height: 52px; min-width: 52px;"
                    >
                        <i class="fa-solid fa-user-check fs-5"></i>
                    </div>

                    <div>
                        <small class="text-muted d-block">
                            Approuvés
                        </small>

                        <strong class="fs-4">
                            {{ $approvedBenevoles }}
                        </strong>
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
        RECHERCHE ET FILTRES
    ====================================================== --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <form
                method="GET"
                action="{{ route('admin.benevoles.index') }}"
                class="row g-3"
            >

                {{-- Recherche --}}
                <div class="col-lg-7 col-md-6">

                    <label class="form-label">
                        Recherche
                    </label>

                    <div class="input-group">

                        <span class="input-group-text bg-white">
                            <i class="fa-solid fa-magnifying-glass text-muted"></i>
                        </span>

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            value="{{ request('search') }}"
                            placeholder="Nom, prénom, e-mail, téléphone, ville..."
                        >

                    </div>

                </div>


                {{-- Statut --}}
                <div class="col-lg-3 col-md-3">

                    <label class="form-label">
                        Statut
                    </label>

                    <select
                        name="status"
                        class="form-select"
                    >

                        <option value="">
                            Tous les statuts
                        </option>

                        <option
                            value="pending"
                            @selected(request('status') === 'pending')
                        >
                            En attente
                        </option>

                        <option
                            value="approved"
                            @selected(request('status') === 'approved')
                        >
                            Approuvés
                        </option>

                    </select>

                </div>


                {{-- Actions --}}
                <div class="col-lg-2 col-md-3 d-flex align-items-end gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary flex-grow-1"
                    >
                        Filtrer
                    </button>

                    <a
                        href="{{ route('admin.benevoles.index') }}"
                        class="btn btn-outline-secondary"
                        title="Réinitialiser"
                    >
                        <i class="fa-solid fa-rotate-left"></i>
                    </a>

                </div>

            </form>

        </div>

    </div>


    {{-- =====================================================
        TABLEAU
    ====================================================== --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-bottom py-3">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <strong>
                        Candidatures
                    </strong>

                    <span class="text-muted ms-1">
                        ({{ $benevoles->total() }})
                    </span>
                </div>

                @if(request()->filled('search') || request()->filled('status'))

                    <span class="badge bg-primary bg-opacity-10 text-primary">
                        Filtres actifs
                    </span>

                @endif

            </div>

        </div>


        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th class="ps-4">
                                Bénévole
                            </th>

                            <th>
                                Contact
                            </th>

                            <th>
                                Localisation
                            </th>

                            <th>
                                Date
                            </th>

                            <th>
                                Statut
                            </th>

                            <th class="text-end pe-4">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($benevoles as $benevole)

                            <tr>

                                {{-- Bénévole --}}
                                <td class="ps-4">

                                    <div class="d-flex align-items-center gap-3">

                                        <div
                                            class="d-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary fw-bold"
                                            style="width: 42px; height: 42px; min-width: 42px;"
                                        >
                                            {{ strtoupper(
                                                substr(
                                                    $benevole->prenom
                                                        ?: $benevole->name,
                                                    0,
                                                    1
                                                )
                                            ) }}
                                        </div>

                                        <div>

                                            <strong class="d-block">
                                                {{ $benevole->prenom }}
                                                {{ $benevole->name }}
                                            </strong>

                                            <small class="text-muted">
                                                ID #{{ $benevole->id }}
                                            </small>

                                        </div>

                                    </div>

                                </td>


                                {{-- Contact --}}
                                <td>

                                    @if($benevole->email)

                                        <div class="mb-1">

                                            <i class="fa-regular fa-envelope text-muted me-1"></i>

                                            <span>
                                                {{ $benevole->email }}
                                            </span>

                                        </div>

                                    @endif


                                    @if($benevole->telephone)

                                        <small class="text-muted">

                                            <i class="fa-solid fa-phone me-1"></i>

                                            {{ $benevole->telephone }}

                                        </small>

                                    @endif


                                    @if(!$benevole->email && !$benevole->telephone)

                                        <span class="text-muted">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- Localisation --}}
                                <td>

                                    @if($benevole->ville || $benevole->pays)

                                        <div>

                                            <i class="fa-solid fa-location-dot text-muted me-1"></i>

                                            {{ $benevole->ville ?: '' }}

                                            @if($benevole->ville && $benevole->pays)
                                                ,
                                            @endif

                                            {{ $benevole->pays ?: '' }}

                                        </div>

                                    @else

                                        <span class="text-muted">
                                            Non renseignée
                                        </span>

                                    @endif

                                </td>


                                {{-- Date --}}
                                <td>

                                    <div>
                                        {{ $benevole->created_at->format('d/m/Y') }}
                                    </div>

                                    <small class="text-muted">
                                        {{ $benevole->created_at->format('H:i') }}
                                    </small>

                                </td>


                                {{-- Statut --}}
                                <td>

                                    @if($benevole->is_approved)

                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">

                                            <i class="fa-solid fa-circle-check me-1"></i>

                                            Approuvé

                                        </span>

                                    @else

                                        <span class="badge bg-warning bg-opacity-10 text-dark px-3 py-2">

                                            <i class="fa-solid fa-clock me-1"></i>

                                            En attente

                                        </span>

                                    @endif

                                </td>


                                {{-- Actions --}}
                                <td class="text-end pe-4">

                                    <div class="d-flex justify-content-end gap-2">

                                        <a
                                            href="{{ route(
                                                'admin.benevoles.show',
                                                $benevole
                                            ) }}"
                                            class="btn btn-sm btn-outline-primary"
                                            title="Consulter"
                                        >
                                            <i class="fa-regular fa-eye"></i>
                                        </a>

                                        <a
                                            href="{{ route(
                                                'admin.benevoles.edit',
                                                $benevole
                                            ) }}"
                                            class="btn btn-sm btn-outline-secondary"
                                            title="Modifier"
                                        >
                                            <i class="fa-solid fa-pen"></i>
                                        </a>

                                        <form
                                            action="{{ route(
                                                'admin.benevoles.destroy',
                                                $benevole
                                            ) }}"
                                            method="POST"
                                            class="d-inline"
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
                                                class="btn btn-sm btn-outline-danger"
                                                title="Supprimer"
                                            >
                                                <i class="fa-regular fa-trash-can"></i>
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="text-center py-5"
                                >

                                    <div class="text-muted">

                                        <i class="fa-solid fa-users fs-2 mb-3 d-block"></i>

                                        <strong class="d-block mb-1">
                                            Aucun bénévole trouvé
                                        </strong>

                                        <small>
                                            Modifiez vos critères de recherche
                                            ou ajoutez un nouveau bénévole.
                                        </small>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- =====================================================
        PAGINATION
    ====================================================== --}}
    @if($benevoles->hasPages())

        <div class="mt-4">
            {{ $benevoles->links() }}
        </div>

    @endif

</div>

@endsection
