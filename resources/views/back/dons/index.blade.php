@extends('back.layouts.app')

@section('title', 'Dons')

@section('content')

<div class="container-fluid">

    {{-- =====================================================
        EN-TÊTE
    ====================================================== --}}
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">

        <div>
            <h1 class="h3 mb-1">
                Gestion des dons
            </h1>

            <p class="text-muted mb-0">
                Consultez et gérez les dons enregistrés par YOULIDA.
            </p>
        </div>

        <a
            href="{{ route('admin.dons.create') }}"
            class="btn btn-primary"
        >
            <i class="fa-solid fa-plus me-2"></i>
            Ajouter un don
        </a>

    </div>


    {{-- =====================================================
        MESSAGE SUCCÈS
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

        {{-- Nombre de dons --}}
        <div class="col-lg-4 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body d-flex align-items-center gap-3">

                    <div
                        class="d-flex align-items-center justify-content-center
                               rounded-circle bg-primary bg-opacity-10 text-primary"
                        style="
                            width: 52px;
                            height: 52px;
                            min-width: 52px;
                        "
                    >
                        <i class="fa-solid fa-hand-holding-heart fs-5"></i>
                    </div>

                    <div>

                        <small class="text-muted d-block">
                            Nombre de dons
                        </small>

                        <strong class="fs-4">
                            {{ number_format($totalDons, 0, ',', ' ') }}
                        </strong>

                    </div>

                </div>

            </div>

        </div>


        {{-- Montant total --}}
        <div class="col-lg-4 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body d-flex align-items-center gap-3">

                    <div
                        class="d-flex align-items-center justify-content-center
                               rounded-circle bg-success bg-opacity-10 text-success"
                        style="
                            width: 52px;
                            height: 52px;
                            min-width: 52px;
                        "
                    >
                        <i class="fa-solid fa-wallet fs-5"></i>
                    </div>

                    <div>

                        <small class="text-muted d-block">
                            Montant total enregistré
                        </small>

                        <strong class="fs-4">
                            {{ number_format($totalAmount, 0, ',', ' ') }}
                            FCFA
                        </strong>

                    </div>

                </div>

            </div>

        </div>


        {{-- Montant moyen --}}
        <div class="col-lg-4 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body d-flex align-items-center gap-3">

                    <div
                        class="d-flex align-items-center justify-content-center
                               rounded-circle bg-info bg-opacity-10 text-info"
                        style="
                            width: 52px;
                            height: 52px;
                            min-width: 52px;
                        "
                    >
                        <i class="fa-solid fa-chart-line fs-5"></i>
                    </div>

                    <div>

                        <small class="text-muted d-block">
                            Montant moyen
                        </small>

                        <strong class="fs-4">
                            {{ number_format($averageAmount, 0, ',', ' ') }}
                            FCFA
                        </strong>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
        FILTRES
    ====================================================== --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <form
                method="GET"
                action="{{ route('admin.dons.index') }}"
                class="row g-3"
            >

                {{-- Recherche --}}
                <div class="col-lg-4 col-md-6">

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
                            placeholder="Donateur, e-mail, transaction..."
                        >

                    </div>

                </div>


                {{-- Méthode --}}
                <div class="col-lg-2 col-md-6">

                    <label class="form-label">
                        Méthode
                    </label>

                    <select
                        name="payment_method"
                        class="form-select"
                    >

                        <option value="">
                            Toutes
                        </option>

                        @foreach($paymentMethods as $method)

                            <option
                                value="{{ $method }}"
                                @selected(
                                    request('payment_method') === $method
                                )
                            >
                                {{ $method }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Date début --}}
                <div class="col-lg-2 col-md-4">

                    <label class="form-label">
                        Du
                    </label>

                    <input
                        type="date"
                        name="date_from"
                        class="form-control"
                        value="{{ request('date_from') }}"
                    >

                </div>


                {{-- Date fin --}}
                <div class="col-lg-2 col-md-4">

                    <label class="form-label">
                        Au
                    </label>

                    <input
                        type="date"
                        name="date_to"
                        class="form-control"
                        value="{{ request('date_to') }}"
                    >

                </div>


                {{-- Actions --}}
                <div class="col-lg-2 col-md-4 d-flex align-items-end gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary flex-grow-1"
                    >
                        Filtrer
                    </button>

                    <a
                        href="{{ route('admin.dons.index') }}"
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
                        Dons enregistrés
                    </strong>

                    <span class="text-muted ms-1">
                        ({{ $dons->total() }})
                    </span>

                </div>


                @if(
                    request()->filled('search') ||
                    request()->filled('payment_method') ||
                    request()->filled('date_from') ||
                    request()->filled('date_to')
                )

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
                                Donateur
                            </th>

                            <th>
                                Montant
                            </th>

                            <th>
                                Méthode
                            </th>

                            <th>
                                Transaction
                            </th>

                            <th>
                                Date du don
                            </th>

                            <th class="text-end pe-4">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($dons as $don)

                            <tr>

                                {{-- Donateur --}}
                                <td class="ps-4">

                                    <div class="d-flex align-items-center gap-3">

                                        <div
                                            class="d-flex align-items-center justify-content-center
                                                   rounded-circle bg-primary bg-opacity-10
                                                   text-primary fw-bold"
                                            style="
                                                width: 42px;
                                                height: 42px;
                                                min-width: 42px;
                                            "
                                        >
                                            {{ strtoupper(
                                                substr(
                                                    $don->donor_name,
                                                    0,
                                                    1
                                                )
                                            ) }}
                                        </div>


                                        <div>

                                            <strong class="d-block">
                                                {{ $don->donor_name }}
                                            </strong>

                                            @if($don->email)

                                                <small class="text-muted">
                                                    {{ $don->email }}
                                                </small>

                                            @else

                                                <small class="text-muted">
                                                    Aucun e-mail
                                                </small>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- Montant --}}
                                <td>

                                    <strong class="text-success">
                                        {{ number_format(
                                            $don->amount,
                                            0,
                                            ',',
                                            ' '
                                        ) }}
                                        FCFA
                                    </strong>

                                </td>


                                {{-- Méthode --}}
                                <td>

                                    @if($don->payment_method)

                                        <span
                                            class="badge bg-secondary bg-opacity-10
                                                   text-dark px-3 py-2"
                                        >
                                            {{ $don->payment_method }}
                                        </span>

                                    @else

                                        <span class="text-muted">
                                            Non renseignée
                                        </span>

                                    @endif

                                </td>


                                {{-- Transaction --}}
                                <td>

                                    @if($don->transaction_id)

                                        <code>
                                            {{ $don->transaction_id }}
                                        </code>

                                    @else

                                        <span class="text-muted">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- Date --}}
                                <td>

                                    @if($don->donated_at)

                                        <div>
                                            {{ $don->donated_at->format('d/m/Y') }}
                                        </div>

                                        <small class="text-muted">
                                            {{ $don->donated_at->format('H:i') }}
                                        </small>

                                    @else

                                        <span class="text-muted">
                                            Non renseignée
                                        </span>

                                    @endif

                                </td>


                                {{-- Actions --}}
                                <td class="text-end pe-4">

                                    <div class="d-flex justify-content-end gap-2">

                                        <a
                                            href="{{ route(
                                                'admin.dons.show',
                                                $don
                                            ) }}"
                                            class="btn btn-sm btn-outline-primary"
                                            title="Consulter"
                                        >
                                            <i class="fa-regular fa-eye"></i>
                                        </a>


                                        <a
                                            href="{{ route(
                                                'admin.dons.edit',
                                                $don
                                            ) }}"
                                            class="btn btn-sm btn-outline-secondary"
                                            title="Modifier"
                                        >
                                            <i class="fa-solid fa-pen"></i>
                                        </a>


                                        <form
                                            action="{{ route(
                                                'admin.dons.destroy',
                                                $don
                                            ) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="
                                                return confirm(
                                                    'Supprimer définitivement ce don ?'
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

                                        <i class="fa-solid fa-hand-holding-heart fs-2 d-block mb-3"></i>

                                        <strong class="d-block mb-1">
                                            Aucun don trouvé
                                        </strong>

                                        <small>
                                            Aucun don ne correspond aux
                                            critères sélectionnés.
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
    @if($dons->hasPages())

        <div class="mt-4">
            {{ $dons->links() }}
        </div>

    @endif

</div>

@endsection
