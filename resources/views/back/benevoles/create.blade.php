@extends('back.layouts.app')

@section('title', 'Ajouter un bénévole')

@section('content')

<div class="container-fluid">

    {{-- =====================================================
        EN-TÊTE
    ====================================================== --}}
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">

        <div>
            <a
                href="{{ route('admin.benevoles.index') }}"
                class="text-decoration-none text-muted d-inline-block mb-2"
            >
                <i class="fa-solid fa-arrow-left me-1"></i>
                Retour aux bénévoles
            </a>

            <h1 class="h3 mb-1">
                Ajouter un bénévole
            </h1>

            <p class="text-muted mb-0">
                Enregistrez manuellement un nouveau bénévole dans YOULIDA.
            </p>
        </div>

    </div>


    {{-- =====================================================
        ERREURS GLOBALES
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
        action="{{ route('admin.benevoles.store') }}"
        method="POST"
    >

        @csrf

        <div class="row g-4">

            {{-- =================================================
                COLONNE PRINCIPALE
            ================================================== --}}
            <div class="col-lg-8">

                {{-- Informations personnelles --}}
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
                                    Informations personnelles
                                </h5>

                                <small class="text-muted">
                                    Identité du bénévole
                                </small>
                            </div>

                        </div>

                    </div>


                    <div class="card-body">

                        <div class="row g-3">

                            {{-- Nom --}}
                            <div class="col-md-6">

                                <label
                                    for="name"
                                    class="form-label"
                                >
                                    Nom
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}"
                                    placeholder="Nom du bénévole"
                                    required
                                >

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- Prénom --}}
                            <div class="col-md-6">

                                <label
                                    for="prenom"
                                    class="form-label"
                                >
                                    Prénom
                                </label>

                                <input
                                    type="text"
                                    id="prenom"
                                    name="prenom"
                                    class="form-control @error('prenom') is-invalid @enderror"
                                    value="{{ old('prenom') }}"
                                    placeholder="Prénom du bénévole"
                                >

                                @error('prenom')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Contact --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <div class="d-flex align-items-center gap-2">

                            <div
                                class="d-flex align-items-center justify-content-center
                                       rounded-circle bg-info bg-opacity-10 text-info"
                                style="width: 38px; height: 38px;"
                            >
                                <i class="fa-regular fa-address-card"></i>
                            </div>

                            <div>
                                <h5 class="mb-0">
                                    Coordonnées
                                </h5>

                                <small class="text-muted">
                                    Informations permettant de contacter le bénévole
                                </small>
                            </div>

                        </div>

                    </div>


                    <div class="card-body">

                        <div class="row g-3">

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


                            {{-- Téléphone --}}
                            <div class="col-md-6">

                                <label
                                    for="telephone"
                                    class="form-label"
                                >
                                    Téléphone
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text bg-white">
                                        <i class="fa-solid fa-phone text-muted"></i>
                                    </span>

                                    <input
                                        type="text"
                                        id="telephone"
                                        name="telephone"
                                        class="form-control @error('telephone') is-invalid @enderror"
                                        value="{{ old('telephone') }}"
                                        placeholder="+226..."
                                    >

                                    @error('telephone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Localisation --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <div class="d-flex align-items-center gap-2">

                            <div
                                class="d-flex align-items-center justify-content-center
                                       rounded-circle bg-warning bg-opacity-10 text-warning"
                                style="width: 38px; height: 38px;"
                            >
                                <i class="fa-solid fa-location-dot"></i>
                            </div>

                            <div>
                                <h5 class="mb-0">
                                    Localisation
                                </h5>

                                <small class="text-muted">
                                    Pays et ville de résidence
                                </small>
                            </div>

                        </div>

                    </div>


                    <div class="card-body">

                        <div class="row g-3">

                            {{-- Pays --}}
                            <div class="col-md-6">

                                <label
                                    for="pays"
                                    class="form-label"
                                >
                                    Pays
                                </label>

                                <input
                                    type="text"
                                    id="pays"
                                    name="pays"
                                    class="form-control @error('pays') is-invalid @enderror"
                                    value="{{ old('pays') }}"
                                    placeholder="Ex. Burkina Faso"
                                >

                                @error('pays')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- Ville --}}
                            <div class="col-md-6">

                                <label
                                    for="ville"
                                    class="form-label"
                                >
                                    Ville
                                </label>

                                <input
                                    type="text"
                                    id="ville"
                                    name="ville"
                                    class="form-control @error('ville') is-invalid @enderror"
                                    value="{{ old('ville') }}"
                                    placeholder="Ex. Ouagadougou"
                                >

                                @error('ville')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Motivation --}}
                <div class="card border-0 shadow-sm">

                    <div class="card-header bg-white py-3">

                        <div class="d-flex align-items-center gap-2">

                            <div
                                class="d-flex align-items-center justify-content-center
                                       rounded-circle bg-success bg-opacity-10 text-success"
                                style="width: 38px; height: 38px;"
                            >
                                <i class="fa-regular fa-message"></i>
                            </div>

                            <div>
                                <h5 class="mb-0">
                                    Motivation
                                </h5>

                                <small class="text-muted">
                                    Motivation et contribution envisagée
                                </small>
                            </div>

                        </div>

                    </div>


                    <div class="card-body">

                        <label
                            for="motivation"
                            class="form-label"
                        >
                            Pourquoi souhaite-t-il devenir bénévole ?
                        </label>

                        <textarea
                            id="motivation"
                            name="motivation"
                            class="form-control @error('motivation') is-invalid @enderror"
                            rows="6"
                            placeholder="Motivation, compétences, disponibilités ou contribution souhaitée..."
                        >{{ old('motivation') }}</textarea>

                        @error('motivation')
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

                {{-- Statut --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <h5 class="mb-0">
                            Statut
                        </h5>

                    </div>

                    <div class="card-body">

                        <div class="form-check form-switch">

                            <input
                                type="checkbox"
                                name="is_approved"
                                id="is_approved"
                                value="1"
                                class="form-check-input"
                                role="switch"
                                @checked(old('is_approved'))
                            >

                            <label
                                for="is_approved"
                                class="form-check-label fw-semibold"
                            >
                                Approuver ce bénévole
                            </label>

                        </div>

                        <p class="text-muted small mt-3 mb-0">
                            Activez cette option uniquement si la candidature
                            a déjà été examinée et approuvée par YOULIDA.
                        </p>

                    </div>

                </div>


                {{-- Information --}}
                <div class="card border-0 bg-light mb-4">

                    <div class="card-body">

                        <div class="d-flex gap-3">

                            <i class="fa-solid fa-circle-info text-primary mt-1"></i>

                            <div>

                                <strong class="d-block mb-1">
                                    Ajout administratif
                                </strong>

                                <p class="small text-muted mb-0">
                                    Cette page permet à l'équipe YOULIDA
                                    d'enregistrer manuellement un bénévole.
                                    Les candidatures envoyées depuis le site
                                    apparaissent automatiquement dans la liste.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Actions --}}
                <div class="card border-0 shadow-sm">

                    <div class="card-body">

                        <button
                            type="submit"
                            class="btn btn-primary w-100 mb-2"
                        >
                            <i class="fa-solid fa-floppy-disk me-2"></i>
                            Enregistrer le bénévole
                        </button>

                        <a
                            href="{{ route('admin.benevoles.index') }}"
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
