@extends('back.layouts.app')

@section('title', 'Modifier le rôle')

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
                <i class="bi bi-pencil-square fs-4"></i>
            </div>

            <div>

                <h3 class="fw-bold mb-1">
                    Modifier le rôle
                </h3>

                <p class="text-muted mb-0 small">
                    Modifiez les informations du rôle
                    <strong>{{ $role->name }}</strong>.
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
        MESSAGES
    ========================================================== --}}

    @if(session('success'))

        <div
            class="alert alert-success alert-dismissible fade show border-0 shadow-sm"
            role="alert"
        >
            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>
        </div>

    @endif


    {{-- =========================================================
        ERREURS
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
                action="{{ route('admin.roles.update', $role->id) }}"
                method="POST"
            >

                @csrf
                @method('PUT')


                {{-- =================================================
                    INFORMATIONS
                ================================================== --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white border-bottom py-3">

                        <div class="d-flex align-items-center gap-3">

                            <div
                                class="d-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary"
                                style="width: 40px; height: 40px;"
                            >
                                <i class="bi bi-shield-check"></i>
                            </div>

                            <div>

                                <h5 class="fw-bold mb-0">
                                    Informations du rôle
                                </h5>

                                <small class="text-muted">
                                    Mettez à jour les informations générales.
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
                                    value="{{ old('name', $role->name) }}"
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
                                        value="{{ old('slug', $role->slug) }}"
                                    >

                                    @error('slug')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                                <div class="form-text">
                                    Identifiant technique utilisé pour les contrôles d'accès.
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
                                    placeholder="Description du rôle..."
                                >{{ old('description', $role->description) }}</textarea>

                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    INFORMATIONS TECHNIQUES
                ================================================== --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-body">

                        <div class="row g-3">

                            <div class="col-12 col-md-4">

                                <small class="text-muted d-block mb-1">
                                    Identifiant
                                </small>

                                <strong>
                                    #{{ $role->id }}
                                </strong>

                            </div>


                            <div class="col-12 col-md-4">

                                <small class="text-muted d-block mb-1">
                                    Créé le
                                </small>

                                <strong>
                                    {{ $role->created_at->format('d/m/Y à H:i') }}
                                </strong>

                            </div>


                            <div class="col-12 col-md-4">

                                <small class="text-muted d-block mb-1">
                                    Dernière modification
                                </small>

                                <strong>
                                    {{ $role->updated_at->format('d/m/Y à H:i') }}
                                </strong>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    AVERTISSEMENT POUR LES RÔLES SYSTÈME
                ================================================== --}}

                @if(in_array($role->slug, ['admin', 'superadmin']))

                    <div class="alert alert-warning border-0 shadow-sm mb-4">

                        <div class="d-flex align-items-start gap-3">

                            <i class="bi bi-exclamation-triangle-fill fs-5"></i>

                            <div>

                                <h6 class="fw-bold mb-1">
                                    Rôle système sensible
                                </h6>

                                <p class="mb-0 small">
                                    Ce rôle participe au contrôle d'accès à
                                    l'administration YOULIDA. Une modification de
                                    son slug peut empêcher certains utilisateurs
                                    d'accéder au back-office.
                                </p>

                            </div>

                        </div>

                    </div>

                @endif


                {{-- =================================================
                    ACTIONS
                ================================================== --}}
                <div class="d-flex flex-column flex-sm-row justify-content-between gap-3">

                    <a
                        href="{{ route('admin.roles.show', $role->id) }}"
                        class="btn btn-light border d-inline-flex align-items-center justify-content-center gap-2"
                    >
                        <i class="bi bi-eye"></i>
                        Voir le rôle
                    </a>


                    <div class="d-flex flex-column flex-sm-row gap-2">

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
                            Enregistrer les modifications
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection