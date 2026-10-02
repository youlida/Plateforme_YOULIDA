@extends('back.layouts.app')

@section('title', 'Créer un rôle')

@section('content')

<div class="container-fluid py-4">

    {{-- =========================================================
        EN-TÊTE
    ========================================================== --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

        <div class="d-flex align-items-center gap-3">

            <div
                class="d-flex align-items-center justify-content-center rounded-3 bg-primary bg-opacity-10 text-primary flex-shrink-0"
                style="width: 48px; height: 48px;"
            >
                <i class="bi bi-shield-plus fs-4"></i>
            </div>

            <div>
                <h3 class="fw-bold mb-1">
                    Créer un rôle
                </h3>

                <p class="text-muted mb-0 small">
                    Ajoutez un nouveau rôle pour organiser les niveaux d'accès à YOULIDA.
                </p>
            </div>

        </div>


        <a
            href="{{ route('admin.roles.index') }}"
            class="btn btn-light border d-inline-flex align-items-center gap-2"
        >
            <i class="bi bi-arrow-left"></i>
            Retour aux rôles
        </a>

    </div>


    {{-- =========================================================
        ERREURS DE VALIDATION
    ========================================================== --}}
    @if($errors->any())

        <div class="alert alert-danger border-0 shadow-sm mb-4">

            <div class="d-flex align-items-start gap-3">

                <i class="bi bi-exclamation-triangle-fill fs-5"></i>

                <div>

                    <strong>
                        Certaines informations sont incorrectes.
                    </strong>

                    <ul class="mb-0 mt-2 ps-3">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    <div class="row justify-content-center">

        <div class="col-12 col-xl-9">

            <form
                action="{{ route('admin.roles.store') }}"
                method="POST"
            >

                @csrf


                {{-- =================================================
                    INFORMATIONS DU RÔLE
                ================================================== --}}
                <div class="card border-0 shadow-sm mb-4">

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
                                    Définissez le nom et l'identifiant du rôle.
                                </small>
                            </div>

                        </div>

                    </div>


                    <div class="card-body p-4">

                        <div class="row g-4">

                            {{-- NOM --}}
                            <div class="col-12 col-md-6">

                                <label
                                    for="name"
                                    class="form-label fw-semibold"
                                >
                                    Nom du rôle
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}"
                                    placeholder="Ex. Administrateur"
                                    required
                                    autofocus
                                >

                                <div class="form-text">
                                    Nom affiché dans l'administration.
                                </div>

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- SLUG --}}
                            <div class="col-12 col-md-6">

                                <label
                                    for="slug"
                                    class="form-label fw-semibold"
                                >
                                    Slug
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-code-slash"></i>
                                    </span>

                                    <input
                                        type="text"
                                        id="slug"
                                        name="slug"
                                        class="form-control @error('slug') is-invalid @enderror"
                                        value="{{ old('slug') }}"
                                        placeholder="Ex. administrateur"
                                    >

                                    @error('slug')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                                <div class="form-text">
                                    Identifiant technique utilisé par l'application.
                                    Utilisez de préférence des minuscules sans espace.
                                </div>

                            </div>


                            {{-- DESCRIPTION --}}
                            <div class="col-12">

                                <label
                                    for="description"
                                    class="form-label fw-semibold"
                                >
                                    Description
                                </label>

                                <textarea
                                    id="description"
                                    name="description"
                                    class="form-control @error('description') is-invalid @enderror"
                                    rows="5"
                                    placeholder="Décrivez brièvement les responsabilités ou le niveau d'accès associé à ce rôle..."
                                >{{ old('description') }}</textarea>

                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <div class="form-text">
                                    Cette description permet aux administrateurs de comprendre l'utilité du rôle.
                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    INFORMATION SÉCURITÉ
                ================================================== --}}
                <div class="alert alert-light border shadow-sm mb-4">

                    <div class="d-flex align-items-start gap-3">

                        <div
                            class="d-flex align-items-center justify-content-center rounded-circle bg-warning bg-opacity-10 text-warning flex-shrink-0"
                            style="width: 42px; height: 42px;"
                        >
                            <i class="bi bi-shield-exclamation"></i>
                        </div>

                        <div>

                            <h6 class="fw-bold mb-1">
                                Attention aux droits d'accès
                            </h6>

                            <p class="text-muted small mb-0">
                                La création d'un rôle ne doit pas automatiquement
                                donner accès à l'administration. Les autorisations
                                doivent être contrôlées côté serveur selon le rôle
                                de l'utilisateur.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    ACTIONS
                ================================================== --}}
                <div class="d-flex flex-column flex-sm-row justify-content-end gap-2">

                    <a
                        href="{{ route('admin.roles.index') }}"
                        class="btn btn-light border px-4"
                    >
                        Annuler
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary px-4 d-inline-flex align-items-center justify-content-center gap-2"
                    >
                        <i class="bi bi-check-lg"></i>
                        Enregistrer le rôle
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection