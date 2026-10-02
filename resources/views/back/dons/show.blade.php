@extends('back.layouts.app')

@section('title', 'Détails du don')

@section('content')

<div class="container-fluid">

    {{-- =====================================================
        EN-TÊTE
    ====================================================== --}}
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">

        <div>

            <a
                href="{{ route('admin.dons.index') }}"
                class="text-decoration-none text-muted d-inline-block mb-2"
            >
                <i class="fa-solid fa-arrow-left me-1"></i>
                Retour aux dons
            </a>

            <h1 class="h3 mb-1">
                Détails du don
            </h1>

            <p class="text-muted mb-0">
                Consultez les informations complètes du don enregistré.
            </p>

        </div>


        <div class="d-flex gap-2">

            <a
                href="{{ route('admin.dons.edit', $don) }}"
                class="btn btn-outline-primary"
            >
                <i class="fa-solid fa-pen me-2"></i>
                Modifier
            </a>

            <form
                action="{{ route('admin.dons.destroy', $don) }}"
                method="POST"
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
                    class="btn btn-outline-danger"
                >
                    <i class="fa-regular fa-trash-can me-2"></i>
                    Supprimer
                </button>

            </form>

        </div>

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


    <div class="row g-4">

        {{-- =================================================
            COLONNE PRINCIPALE
        ================================================== --}}
        <div class="col-lg-8">


            {{-- =============================================
                MONTANT PRINCIPAL
            ============================================== --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-body p-4">

                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-4">

                        <div class="d-flex align-items-center gap-3">

                            <div
                                class="d-flex align-items-center justify-content-center
                                       rounded-circle bg-success bg-opacity-10
                                       text-success"
                                style="
                                    width: 70px;
                                    height: 70px;
                                    min-width: 70px;
                                "
                            >
                                <i class="fa-solid fa-hand-holding-heart fs-3"></i>
                            </div>


                            <div>

                                <small class="text-muted d-block mb-1">
                                    Montant du don
                                </small>

                                <h2 class="mb-0 text-success fw-bold">

                                    {{ number_format(
                                        $don->amount,
                                        0,
                                        ',',
                                        ' '
                                    ) }}

                                    <span class="fs-5">
                                        FCFA
                                    </span>

                                </h2>

                            </div>

                        </div>


                        <div class="text-lg-end">

                            <small class="text-muted d-block mb-1">
                                Don n°
                            </small>

                            <strong class="fs-5">
                                #{{ $don->id }}
                            </strong>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =============================================
                DONATEUR
            ============================================== --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white py-3">

                    <div class="d-flex align-items-center gap-2">

                        <div
                            class="d-flex align-items-center justify-content-center
                                   rounded-circle bg-primary bg-opacity-10
                                   text-primary"
                            style="width: 38px; height: 38px;"
                        >
                            <i class="fa-regular fa-user"></i>
                        </div>

                        <div>

                            <h5 class="mb-0">
                                Donateur
                            </h5>

                            <small class="text-muted">
                                Informations du donateur
                            </small>

                        </div>

                    </div>

                </div>


                <div class="card-body">

                    <div class="row g-4">

                        {{-- Nom --}}
                        <div class="col-md-6">

                            <small class="text-muted d-block mb-1">
                                Nom du donateur
                            </small>

                            <strong class="fs-6">
                                {{ $don->donor_name }}
                            </strong>

                        </div>


                        {{-- Email --}}
                        <div class="col-md-6">

                            <small class="text-muted d-block mb-1">
                                Adresse e-mail
                            </small>

                            @if($don->email)

                                <a
                                    href="mailto:{{ $don->email }}"
                                    class="text-decoration-none fw-semibold"
                                >
                                    <i class="fa-regular fa-envelope me-1"></i>

                                    {{ $don->email }}
                                </a>

                            @else

                                <span class="text-muted">
                                    Non renseignée
                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>


            {{-- =============================================
                INFORMATIONS DU PAIEMENT
            ============================================== --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white py-3">

                    <div class="d-flex align-items-center gap-2">

                        <div
                            class="d-flex align-items-center justify-content-center
                                   rounded-circle bg-success bg-opacity-10
                                   text-success"
                            style="width: 38px; height: 38px;"
                        >
                            <i class="fa-solid fa-wallet"></i>
                        </div>

                        <div>

                            <h5 class="mb-0">
                                Informations du don
                            </h5>

                            <small class="text-muted">
                                Méthode, référence et date
                            </small>

                        </div>

                    </div>

                </div>


                <div class="card-body">

                    <div class="row g-4">

                        {{-- Méthode --}}
                        <div class="col-md-4">

                            <small class="text-muted d-block mb-2">
                                Méthode de paiement
                            </small>

                            @if($don->payment_method)

                                <span
                                    class="badge bg-secondary bg-opacity-10
                                           text-dark px-3 py-2"
                                >
                                    <i class="fa-solid fa-credit-card me-1"></i>

                                    {{ $don->payment_method }}
                                </span>

                            @else

                                <span class="text-muted">
                                    Non renseignée
                                </span>

                            @endif

                        </div>


                        {{-- Transaction --}}
                        <div class="col-md-4">

                            <small class="text-muted d-block mb-2">
                                Référence transaction
                            </small>

                            @if($don->transaction_id)

                                <code class="fs-6">
                                    {{ $don->transaction_id }}
                                </code>

                            @else

                                <span class="text-muted">
                                    Aucune référence
                                </span>

                            @endif

                        </div>


                        {{-- Date --}}
                        <div class="col-md-4">

                            <small class="text-muted d-block mb-2">
                                Date du don
                            </small>

                            @if($don->donated_at)

                                <strong>

                                    <i class="fa-regular fa-calendar me-1 text-muted"></i>

                                    {{ $don->donated_at->format('d/m/Y') }}

                                </strong>

                                @if(
                                    $don->donated_at->format('H:i') !== '00:00'
                                )

                                    <div>
                                        <small class="text-muted">
                                            à {{ $don->donated_at->format('H:i') }}
                                        </small>
                                    </div>

                                @endif

                            @else

                                <span class="text-muted">
                                    Non renseignée
                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>


            {{-- =============================================
                MESSAGE
            ============================================== --}}
            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white py-3">

                    <div class="d-flex align-items-center gap-2">

                        <div
                            class="d-flex align-items-center justify-content-center
                                   rounded-circle bg-info bg-opacity-10
                                   text-info"
                            style="width: 38px; height: 38px;"
                        >
                            <i class="fa-regular fa-message"></i>
                        </div>

                        <div>

                            <h5 class="mb-0">
                                Message
                            </h5>

                            <small class="text-muted">
                                Message ou remarque associé au don
                            </small>

                        </div>

                    </div>

                </div>


                <div class="card-body">

                    @if($don->message)

                        <div
                            class="bg-light rounded-3 p-4"
                            style="
                                white-space: pre-line;
                                line-height: 1.8;
                            "
                        >{{ $don->message }}</div>

                    @else

                        <div class="text-center py-4 text-muted">

                            <i class="fa-regular fa-message fs-3 d-block mb-2"></i>

                            Aucun message associé à ce don.

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
                RÉSUMÉ
            ============================================== --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white py-3">

                    <h5 class="mb-0">
                        Résumé du don
                    </h5>

                </div>


                <div class="card-body">

                    {{-- Montant --}}
                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Montant
                        </small>

                        <strong class="text-success fs-5">

                            {{ number_format(
                                $don->amount,
                                0,
                                ',',
                                ' '
                            ) }}
                            FCFA

                        </strong>

                    </div>

                    <hr>


                    {{-- Donateur --}}
                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Donateur
                        </small>

                        <strong>
                            {{ $don->donor_name }}
                        </strong>

                    </div>

                    <hr>


                    {{-- Méthode --}}
                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Méthode
                        </small>

                        <strong>
                            {{ $don->payment_method ?: 'Non renseignée' }}
                        </strong>

                    </div>

                    <hr>


                    {{-- Date --}}
                    <div>

                        <small class="text-muted d-block">
                            Date du don
                        </small>

                        <strong>

                            @if($don->donated_at)

                                {{ $don->donated_at->format('d/m/Y') }}

                            @else

                                Non renseignée

                            @endif

                        </strong>

                    </div>

                </div>

            </div>


            {{-- =============================================
                INFORMATIONS D'ENREGISTREMENT
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
                            #{{ $don->id }}
                        </strong>

                    </div>

                    <hr>


                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Enregistré le
                        </small>

                        <strong>
                            {{ $don->created_at->format('d/m/Y à H:i') }}
                        </strong>

                    </div>

                    <hr>


                    <div>

                        <small class="text-muted d-block">
                            Dernière modification
                        </small>

                        <strong>
                            {{ $don->updated_at->format('d/m/Y à H:i') }}
                        </strong>

                    </div>

                </div>

            </div>


            {{-- =============================================
                NOTE ADMINISTRATIVE
            ============================================== --}}
            <div class="card border-0 bg-light mb-4">

                <div class="card-body">

                    <div class="d-flex gap-3">

                        <i class="fa-solid fa-circle-info text-primary mt-1"></i>

                        <div>

                            <strong class="d-block mb-1">
                                Don enregistré
                            </strong>

                            <p class="small text-muted mb-0">
                                Cette fiche correspond à un don enregistré
                                dans l'administration YOULIDA. Les informations
                                de transaction doivent correspondre aux
                                justificatifs disponibles.
                            </p>

                        </div>

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
                        href="{{ route('admin.dons.edit', $don) }}"
                        class="btn btn-primary w-100 mb-2"
                    >
                        <i class="fa-solid fa-pen me-2"></i>
                        Modifier le don
                    </a>


                    <a
                        href="{{ route('admin.dons.index') }}"
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
