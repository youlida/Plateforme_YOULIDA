@extends('back.layouts.app')

@section('title', 'Enregistrer un don')

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
                Enregistrer un don
            </h1>

            <p class="text-muted mb-0">
                Ajoutez manuellement un don reçu par YOULIDA.
            </p>

        </div>

    </div>


    {{-- =====================================================
        ERREURS DE VALIDATION
    ====================================================== --}}
    @if($errors->any())

        <div class="alert alert-danger">

            <div class="d-flex align-items-center mb-2">

                <i class="fa-solid fa-circle-exclamation me-2"></i>

                <strong>
                    Certaines informations doivent être corrigées.
                </strong>

            </div>

            <ul class="mb-0 ps-4">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        action="{{ route('admin.dons.store') }}"
        method="POST"
    >

        @csrf


        <div class="row g-4">

            {{-- =================================================
                COLONNE PRINCIPALE
            ================================================== --}}
            <div class="col-lg-8">


                {{-- =============================================
                    DONATEUR
                ============================================== --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <div class="d-flex align-items-center gap-2">

                            <div
                                class="d-flex align-items-center justify-content-center
                                       rounded-circle bg-primary bg-opacity-10 text-primary"
                                style="width: 38px; height: 38px;"
                            >
                                <i class="fa-regular fa-user"></i>
                            </div>

                            <div>

                                <h5 class="mb-0">
                                    Informations du donateur
                                </h5>

                                <small class="text-muted">
                                    Identité et coordonnées du donateur
                                </small>

                            </div>

                        </div>

                    </div>


                    <div class="card-body">

                        <div class="row g-3">

                            {{-- Nom --}}
                            <div class="col-md-6">

                                <label
                                    for="donor_name"
                                    class="form-label"
                                >
                                    Nom du donateur
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="donor_name"
                                    name="donor_name"
                                    class="form-control @error('donor_name') is-invalid @enderror"
                                    value="{{ old('donor_name') }}"
                                    placeholder="Nom complet du donateur"
                                    required
                                >

                                @error('donor_name')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- Email --}}
                            <div class="col-md-6">

                                <label
                                    for="email"
                                    class="form-label"
                                >
                                    Adresse e-mail
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text bg-white">

                                        <i class="fa-regular fa-envelope text-muted"></i>

                                    </span>

                                    <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}"
                                        placeholder="exemple@email.com"
                                    >

                                    @error('email')

                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =============================================
                    PAIEMENT
                ============================================== --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <div class="d-flex align-items-center gap-2">

                            <div
                                class="d-flex align-items-center justify-content-center
                                       rounded-circle bg-success bg-opacity-10 text-success"
                                style="width: 38px; height: 38px;"
                            >
                                <i class="fa-solid fa-wallet"></i>
                            </div>

                            <div>

                                <h5 class="mb-0">
                                    Informations du don
                                </h5>

                                <small class="text-muted">
                                    Montant et moyen de paiement utilisé
                                </small>

                            </div>

                        </div>

                    </div>


                    <div class="card-body">

                        <div class="row g-3">

                            {{-- Montant --}}
                            <div class="col-md-6">

                                <label
                                    for="amount"
                                    class="form-label"
                                >
                                    Montant
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="input-group input-group-lg">

                                    <span class="input-group-text">
                                        <i class="fa-solid fa-money-bill-wave"></i>
                                    </span>

                                    <input
                                        type="number"
                                        id="amount"
                                        name="amount"
                                        class="form-control fw-bold @error('amount') is-invalid @enderror"
                                        value="{{ old('amount') }}"
                                        min="0"
                                        step="0.01"
                                        placeholder="0"
                                        required
                                    >

                                    <span class="input-group-text fw-semibold">
                                        FCFA
                                    </span>

                                    @error('amount')

                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>

                                <small class="text-muted">
                                    Montant effectivement reçu.
                                </small>

                            </div>


                            {{-- Méthode --}}
                            <div class="col-md-6">

                                <label
                                    for="payment_method"
                                    class="form-label"
                                >
                                    Méthode de paiement
                                </label>

                                <input
                                    type="text"
                                    id="payment_method"
                                    name="payment_method"
                                    class="form-control @error('payment_method') is-invalid @enderror"
                                    value="{{ old('payment_method') }}"
                                    placeholder="Ex. Mobile Money, virement, espèces..."
                                >

                                @error('payment_method')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                                <small class="text-muted">
                                    Indiquez le moyen par lequel le don a été reçu.
                                </small>

                            </div>


                            {{-- Transaction --}}
                            <div class="col-md-6">

                                <label
                                    for="transaction_id"
                                    class="form-label"
                                >
                                    Référence / ID transaction
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text bg-white">

                                        <i class="fa-solid fa-receipt text-muted"></i>

                                    </span>

                                    <input
                                        type="text"
                                        id="transaction_id"
                                        name="transaction_id"
                                        class="form-control @error('transaction_id') is-invalid @enderror"
                                        value="{{ old('transaction_id') }}"
                                        placeholder="Référence de la transaction"
                                    >

                                    @error('transaction_id')

                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>

                                <small class="text-muted">
                                    Laissez vide si aucune référence n'existe.
                                </small>

                            </div>


                            {{-- Date --}}
                            <div class="col-md-6">

                                <label
                                    for="donated_at"
                                    class="form-label"
                                >
                                    Date du don
                                </label>

                                <input
                                    type="date"
                                    id="donated_at"
                                    name="donated_at"
                                    class="form-control @error('donated_at') is-invalid @enderror"
                                    value="{{ old('donated_at') }}"
                                >

                                @error('donated_at')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                                <small class="text-muted">
                                    Date à laquelle le don a réellement été reçu.
                                </small>

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
                                       rounded-circle bg-info bg-opacity-10 text-info"
                                style="width: 38px; height: 38px;"
                            >
                                <i class="fa-regular fa-message"></i>
                            </div>

                            <div>

                                <h5 class="mb-0">
                                    Message du donateur
                                </h5>

                                <small class="text-muted">
                                    Message ou remarque associé au don
                                </small>

                            </div>

                        </div>

                    </div>


                    <div class="card-body">

                        <label
                            for="message"
                            class="form-label"
                        >
                            Message
                        </label>

                        <textarea
                            id="message"
                            name="message"
                            class="form-control @error('message') is-invalid @enderror"
                            rows="6"
                            placeholder="Message, remarque ou information complémentaire..."
                        >{{ old('message') }}</textarea>

                        @error('message')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>

            </div>


            {{-- =================================================
                COLONNE LATÉRALE
            ================================================== --}}
            <div class="col-lg-4">


                {{-- =============================================
                    RÉCAPITULATIF
                ============================================== --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <h5 class="mb-0">
                            Enregistrement du don
                        </h5>

                    </div>


                    <div class="card-body">

                        <div class="d-flex gap-3 mb-3">

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
                                <i class="fa-solid fa-hand-holding-heart"></i>
                            </div>

                            <div>

                                <strong class="d-block">
                                    Don reçu
                                </strong>

                                <small class="text-muted">
                                    Enregistrez ici uniquement un don
                                    réellement reçu par YOULIDA.
                                </small>

                            </div>

                        </div>

                        <hr>

                        <p class="small text-muted mb-0">
                            Le montant enregistré sera pris en compte
                            dans les statistiques financières affichées
                            sur la page des dons.
                        </p>

                    </div>

                </div>


                {{-- =============================================
                    BONNES PRATIQUES
                ============================================== --}}
                <div class="card border-0 bg-light mb-4">

                    <div class="card-body">

                        <div class="d-flex gap-3">

                            <i class="fa-solid fa-circle-info text-primary mt-1"></i>

                            <div>

                                <strong class="d-block mb-2">
                                    Vérification
                                </strong>

                                <p class="small text-muted mb-0">
                                    Avant l'enregistrement, vérifiez le montant,
                                    la méthode de paiement, la référence de
                                    transaction et la date lorsque ces
                                    informations sont disponibles.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =============================================
                    ACTIONS
                ============================================== --}}
                <div class="card border-0 shadow-sm">

                    <div class="card-body">

                        <button
                            type="submit"
                            class="btn btn-primary w-100 mb-2"
                        >
                            <i class="fa-solid fa-floppy-disk me-2"></i>
                            Enregistrer le don
                        </button>

                        <a
                            href="{{ route('admin.dons.index') }}"
                            class="btn btn-outline-secondary w-100"
                        >
                            Annuler
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection
