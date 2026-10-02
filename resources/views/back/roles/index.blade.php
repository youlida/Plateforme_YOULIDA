@extends('back.layouts.app')

@section('title', 'Gestion des rôles')

@section('content')

<div class="container-fluid py-4">

    {{-- =========================================================
        EN-TÊTE
    ========================================================== --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <div
                    class="d-flex align-items-center justify-content-center rounded-3 bg-primary bg-opacity-10 text-primary"
                    style="width: 44px; height: 44px;"
                >
                    <i class="bi bi-shield-lock fs-5"></i>
                </div>

                <div>
                    <h3 class="fw-bold mb-0">
                        Gestion des rôles
                    </h3>

                    <p class="text-muted mb-0 small">
                        Gérez les rôles et les niveaux d'accès des utilisateurs de YOULIDA.
                    </p>
                </div>
            </div>
        </div>

        <a
            href="{{ route('admin.roles.create') }}"
            class="btn btn-primary d-inline-flex align-items-center gap-2 px-3"
        >
            <i class="bi bi-plus-lg"></i>
            Ajouter un rôle
        </a>

    </div>


    {{-- =========================================================
        MESSAGES
    ========================================================== --}}

    @if(session('success'))

        <div
            class="alert alert-success alert-dismissible fade show border-0 shadow-sm"
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
            class="alert alert-danger alert-dismissible fade show border-0 shadow-sm"
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


    {{-- =========================================================
        CARTE STATISTIQUE
    ========================================================== --}}

    <div class="row g-3 mb-4">

        <div class="col-12 col-sm-6 col-xl-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body d-flex align-items-center justify-content-between">

                    <div>
                        <p class="text-muted small mb-1">
                            Total des rôles
                        </p>

                        <h3 class="fw-bold mb-0">
                            {{ $roles->total() }}
                        </h3>
                    </div>

                    <div
                        class="d-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary"
                        style="width: 52px; height: 52px;"
                    >
                        <i class="bi bi-shield-check fs-4"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        TABLEAU
    ========================================================== --}}

    <div class="card border-0 shadow-sm">

        {{-- HEADER CARTE --}}
        <div class="card-header bg-white border-bottom py-3">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <h5 class="fw-bold mb-1">
                        Liste des rôles
                    </h5>

                    <p class="text-muted small mb-0">
                        Rôles actuellement disponibles dans la plateforme.
                    </p>
                </div>

                <span class="badge bg-light text-dark border px-3 py-2">
                    {{ $roles->total() }}
                    {{ $roles->total() > 1 ? 'rôles' : 'rôle' }}
                </span>

            </div>

        </div>


        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th class="ps-4 py-3">
                                #
                            </th>

                            <th class="py-3">
                                Rôle
                            </th>

                            <th class="py-3">
                                Slug
                            </th>

                            <th class="py-3">
                                Description
                            </th>

                            <th class="py-3">
                                Création
                            </th>

                            <th class="py-3 text-end pe-4">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($roles as $role)

                            <tr>

                                {{-- ID --}}
                                <td class="ps-4">

                                    <span class="text-muted fw-semibold">
                                        #{{ $role->id }}
                                    </span>

                                </td>


                                {{-- RÔLE --}}
                                <td>

                                    <div class="d-flex align-items-center gap-3">

                                        <div
                                            class="d-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary flex-shrink-0"
                                            style="width: 42px; height: 42px;"
                                        >
                                            <i class="bi bi-person-lock"></i>
                                        </div>

                                        <div>

                                            <div class="fw-bold text-dark">
                                                {{ $role->name }}
                                            </div>

                                            @if(in_array($role->slug, ['admin', 'superadmin']))

                                                <span class="badge bg-success bg-opacity-10 text-success mt-1">
                                                    Administration
                                                </span>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- SLUG --}}
                                <td>

                                    <code
                                        class="px-2 py-1 rounded bg-light text-primary border"
                                    >
                                        {{ $role->slug }}
                                    </code>

                                </td>


                                {{-- DESCRIPTION --}}
                                <td style="max-width: 320px;">

                                    @if($role->description)

                                        <span class="text-muted">
                                            {{ \Illuminate\Support\Str::limit($role->description, 80) }}
                                        </span>

                                    @else

                                        <span class="text-muted fst-italic">
                                            Aucune description
                                        </span>

                                    @endif

                                </td>


                                {{-- DATE --}}
                                <td>

                                    <div class="d-flex flex-column">

                                        <span class="fw-semibold">
                                            {{ $role->created_at->format('d/m/Y') }}
                                        </span>

                                        <small class="text-muted">
                                            {{ $role->created_at->format('H:i') }}
                                        </small>

                                    </div>

                                </td>


                                {{-- ACTIONS --}}
                                <td class="text-end pe-4">

                                    <div
                                        class="d-inline-flex align-items-center gap-1"
                                    >

                                        {{-- VOIR --}}
                                        <a
                                            href="{{ route('admin.roles.show', $role->id) }}"
                                            class="btn btn-sm btn-light border"
                                            title="Voir"
                                        >
                                            <i class="fa-solid fa-eye"></i>
                                        </a>


                                        {{-- MODIFIER --}}
                                        <a
                                            href="{{ route('admin.roles.edit', $role->id) }}"
                                            class="btn btn-sm btn-light border"
                                            title="Modifier"
                                        >
                                            <i class="fa-solid fa-pen-to-square text-primary"></i>
                                        </a>


                                        {{-- SUPPRIMER --}}
                                        <form
                                            action="{{ route('admin.roles.destroy', $role->id) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm(
                                                'Voulez-vous vraiment supprimer le rôle « {{ addslashes($role->name) }} » ?'
                                            );"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-light border"
                                                title="Supprimer"
                                            >
                                                <i class="fa-solid fa-trash text-danger"></i>
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            {{-- ÉTAT VIDE --}}
                            <tr>

                                <td
                                    colspan="6"
                                    class="text-center py-5"
                                >

                                    <div class="py-4">

                                        <div
                                            class="d-flex align-items-center justify-content-center rounded-circle bg-light mx-auto mb-3"
                                            style="width: 70px; height: 70px;"
                                        >
                                            <i class="bi bi-shield-x fs-2 text-muted"></i>
                                        </div>

                                        <h5 class="fw-bold">
                                            Aucun rôle trouvé
                                        </h5>

                                        <p class="text-muted mb-3">
                                            Aucun rôle n'a encore été enregistré.
                                        </p>

                                        <a
                                            href="{{ route('admin.roles.create') }}"
                                            class="btn btn-primary btn-sm"
                                        >
                                            <i class="bi bi-plus-lg me-1"></i>

                                            Ajouter un rôle
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

        @if($roles->hasPages())

            <div class="card-footer bg-white border-top py-3">

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

                    <small class="text-muted">

                        Affichage de

                        <strong>
                            {{ $roles->firstItem() }}
                        </strong>

                        à

                        <strong>
                            {{ $roles->lastItem() }}
                        </strong>

                        sur

                        <strong>
                            {{ $roles->total() }}
                        </strong>

                        rôles

                    </small>


                    <div>
                        {{ $roles->links() }}
                    </div>

                </div>

            </div>

        @endif

    </div>

</div>

@endsection