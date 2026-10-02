@extends('back.layouts.app')

@section('title', 'Ajouter un utilisateur')

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
                <i class="bi bi-person-plus fs-4"></i>
            </div>

            <div>
                <h3 class="fw-bold mb-1">
                    Ajouter un utilisateur
                </h3>

                <p class="text-muted mb-0 small">
                    Créez un nouveau compte et définissez ses informations d'accès.
                </p>
            </div>

        </div>

        <a
            href="{{ route('admin.utilisateurs.index') }}"
            class="btn btn-light border d-inline-flex align-items-center justify-content-center gap-2"
        >
            <i class="bi bi-arrow-left"></i>
            Retour aux utilisateurs
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
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- =========================================================
        FORMULAIRE
    ========================================================== --}}
    <form
        action="{{ route('admin.utilisateurs.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf


        <div class="row g-4">

            {{-- =================================================
                COLONNE GAUCHE : PHOTO
            ================================================== --}}
            <div class="col-12 col-xl-4">

                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white border-bottom py-3">

                        <div class="d-flex align-items-center gap-2">

                            <i class="bi bi-camera text-primary"></i>

                            <h5 class="fw-bold mb-0">
                                Photo de profil
                            </h5>

                        </div>

                    </div>


                    <div class="card-body text-center p-4">

                        {{-- APERÇU PHOTO --}}
                        <div class="mb-4">

                            <div
                                id="photoPlaceholder"
                                class="d-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary mx-auto"
                                style="
                                    width: 140px;
                                    height: 140px;
                                    font-size: 48px;
                                "
                            >
                                <i class="bi bi-person"></i>
                            </div>


                            <img
                                id="photoPreview"
                                src=""
                                alt="Aperçu de la photo"
                                class="rounded-circle border shadow-sm d-none mx-auto"
                                style="
                                    width: 140px;
                                    height: 140px;
                                    object-fit: cover;
                                "
                            >

                        </div>


                        {{-- INPUT --}}
                        <input
                            type="file"
                            id="photo"
                            name="photo"
                            class="d-none"
                            accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                        >


                        <label
                            for="photo"
                            class="btn btn-light border d-inline-flex align-items-center gap-2"
                            style="cursor: pointer;"
                        >
                            <i class="bi bi-upload"></i>
                            Choisir une photo
                        </label>


                        @error('photo')
                            <div class="text-danger small mt-2">
                                {{ $message }}
                            </div>
                        @enderror


                        <div
                            id="photoFileName"
                            class="small text-muted mt-3"
                        >
                            Aucune photo sélectionnée
                        </div>


                        <hr class="my-4">


                        <div class="text-start">

                            <small class="text-muted d-block mb-2">
                                Formats acceptés
                            </small>

                            <div class="d-flex flex-wrap gap-2">

                                <span class="badge bg-light text-dark border">
                                    JPG
                                </span>

                                <span class="badge bg-light text-dark border">
                                    PNG
                                </span>

                                <span class="badge bg-light text-dark border">
                                    WEBP
                                </span>

                                <span class="badge bg-light text-dark border">
                                    Max. 2 Mo
                                </span>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =============================================
                    INFORMATION
                ============================================== --}}
                <div class="card border-0 shadow-sm">

                    <div class="card-body p-4">

                        <div class="d-flex align-items-start gap-3">

                            <div
                                class="d-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary flex-shrink-0"
                                style="width: 42px; height: 42px;"
                            >
                                <i class="bi bi-info-circle"></i>
                            </div>

                            <div>

                                <h6 class="fw-bold mb-1">
                                    Compte utilisateur
                                </h6>

                                <p class="text-muted small mb-0">
                                    Le rôle sélectionné détermine les droits
                                    accordés au compte. Attribuez uniquement
                                    les accès nécessaires.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                COLONNE DROITE
            ================================================== --}}
            <div class="col-12 col-xl-8">

                {{-- =============================================
                    INFORMATIONS PERSONNELLES
                ============================================== --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white border-bottom py-3">

                        <div class="d-flex align-items-center gap-3">

                            <div
                                class="d-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary"
                                style="width: 40px; height: 40px;"
                            >
                                <i class="bi bi-person"></i>
                            </div>

                            <div>

                                <h5 class="fw-bold mb-0">
                                    Informations personnelles
                                </h5>

                                <small class="text-muted">
                                    Identité et coordonnées de l'utilisateur.
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
                                    Nom
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Ex. Ouédraogo"
                                    maxlength="255"
                                    required
                                    autofocus
                                >

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- PRÉNOM --}}
                            <div class="col-12 col-md-6">

                                <label
                                    for="prenom"
                                    class="form-label fw-semibold"
                                >
                                    Prénom
                                </label>

                                <input
                                    type="text"
                                    id="prenom"
                                    name="prenom"
                                    value="{{ old('prenom') }}"
                                    class="form-control @error('prenom') is-invalid @enderror"
                                    placeholder="Ex. Josué"
                                    maxlength="255"
                                >

                                @error('prenom')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- EMAIL --}}
                            <div class="col-12 col-md-6">

                                <label
                                    for="email"
                                    class="form-label fw-semibold"
                                >
                                    Adresse email
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-envelope"></i>
                                    </span>

                                    <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="nom@exemple.com"
                                        maxlength="255"
                                        required
                                        autocomplete="email"
                                    >

                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>


                            {{-- TÉLÉPHONE --}}
                            <div class="col-12 col-md-6">

                                <label
                                    for="telephone"
                                    class="form-label fw-semibold"
                                >
                                    Téléphone
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-telephone"></i>
                                    </span>

                                    <input
                                        type="tel"
                                        id="telephone"
                                        name="telephone"
                                        value="{{ old('telephone') }}"
                                        class="form-control @error('telephone') is-invalid @enderror"
                                        placeholder="+226 ..."
                                        maxlength="255"
                                    >

                                    @error('telephone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>


                            {{-- PAYS --}}
                            <div class="col-12 col-md-6">

                                <label
                                    for="pays"
                                    class="form-label fw-semibold"
                                >
                                    Pays
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-globe"></i>
                                    </span>

                                    <input
                                        type="text"
                                        id="pays"
                                        name="pays"
                                        value="{{ old('pays') }}"
                                        class="form-control @error('pays') is-invalid @enderror"
                                        placeholder="Ex. Burkina Faso"
                                        maxlength="255"
                                    >

                                    @error('pays')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>


                            {{-- VILLE --}}
                            <div class="col-12 col-md-6">

                                <label
                                    for="ville"
                                    class="form-label fw-semibold"
                                >
                                    Ville
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-geo-alt"></i>
                                    </span>

                                    <input
                                        type="text"
                                        id="ville"
                                        name="ville"
                                        value="{{ old('ville') }}"
                                        class="form-control @error('ville') is-invalid @enderror"
                                        placeholder="Ex. Ouagadougou"
                                        maxlength="255"
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

                </div>


                {{-- =============================================
                    RÔLE ET STATUT
                ============================================== --}}
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
                                    Rôle et accès
                                </h5>

                                <small class="text-muted">
                                    Définissez les droits et l'état du compte.
                                </small>

                            </div>

                        </div>

                    </div>


                    <div class="card-body p-4">

                        <div class="row g-4">

                            {{-- RÔLE --}}
                            <div class="col-12 col-md-6">

                                <label
                                    for="role_id"
                                    class="form-label fw-semibold"
                                >
                                    Rôle
                                    <span class="text-danger">*</span>
                                </label>

                                <select
                                    id="role_id"
                                    name="role_id"
                                    class="form-select @error('role_id') is-invalid @enderror"
                                    required
                                >

                                    <option value="">
                                        Sélectionner un rôle
                                    </option>

                                    @foreach($roles as $role)

                                        <option
                                            value="{{ $role->id }}"
                                            {{ (string) old('role_id') === (string) $role->id ? 'selected' : '' }}
                                        >
                                            {{ $role->name }}
                                        </option>

                                    @endforeach

                                </select>

                                @error('role_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror


                                <div class="form-text">
                                    Le rôle contrôle le niveau d'accès de l'utilisateur.
                                </div>

                            </div>


                            {{-- STATUT --}}
                            <div class="col-12 col-md-6">

                                <label
                                    for="is_active"
                                    class="form-label fw-semibold"
                                >
                                    Statut du compte
                                    <span class="text-danger">*</span>
                                </label>

                                <select
                                    id="is_active"
                                    name="is_active"
                                    class="form-select @error('is_active') is-invalid @enderror"
                                    required
                                >

                                    <option
                                        value="1"
                                        {{ (string) old('is_active', '1') === '1' ? 'selected' : '' }}
                                    >
                                        Actif
                                    </option>

                                    <option
                                        value="0"
                                        {{ (string) old('is_active') === '0' ? 'selected' : '' }}
                                    >
                                        Bloqué
                                    </option>

                                </select>

                                @error('is_active')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror


                                <div class="form-text">
                                    Un compte bloqué ne devrait pas pouvoir accéder aux espaces protégés.
                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =============================================
                    MOT DE PASSE
                ============================================== --}}
                <div class="card border-0 shadow-sm">

                    <div class="card-header bg-white border-bottom py-3">

                        <div class="d-flex align-items-center gap-3">

                            <div
                                class="d-flex align-items-center justify-content-center rounded-circle bg-warning bg-opacity-10 text-warning"
                                style="width: 40px; height: 40px;"
                            >
                                <i class="bi bi-lock"></i>
                            </div>

                            <div>

                                <h5 class="fw-bold mb-0">
                                    Sécurité du compte
                                </h5>

                                <small class="text-muted">
                                    Définissez le mot de passe initial.
                                </small>

                            </div>

                        </div>

                    </div>


                    <div class="card-body p-4">

                        <div class="row g-4">

                            {{-- MOT DE PASSE --}}
                            <div class="col-12 col-md-6">

                                <label
                                    for="password"
                                    class="form-label fw-semibold"
                                >
                                    Mot de passe
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-lock"></i>
                                    </span>

                                    <input
                                        type="password"
                                        id="password"
                                        name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Saisissez un mot de passe"
                                        minlength="8"
                                        required
                                        autocomplete="new-password"
                                    >

                                    <button
                                        type="button"
                                        class="btn btn-outline-secondary"
                                        onclick="togglePassword('password', this)"
                                        aria-label="Afficher ou masquer le mot de passe"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </button>

                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                                <div class="form-text">
                                    Minimum 8 caractères.
                                </div>

                            </div>


                            {{-- CONFIRMATION --}}
                            <div class="col-12 col-md-6">

                                <label
                                    for="password_confirmation"
                                    class="form-label fw-semibold"
                                >
                                    Confirmer le mot de passe
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-lock-fill"></i>
                                    </span>

                                    <input
                                        type="password"
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        class="form-control"
                                        placeholder="Répétez le mot de passe"
                                        minlength="8"
                                        required
                                        autocomplete="new-password"
                                    >

                                    <button
                                        type="button"
                                        class="btn btn-outline-secondary"
                                        onclick="togglePassword('password_confirmation', this)"
                                        aria-label="Afficher ou masquer le mot de passe"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            ACTIONS
        ====================================================== --}}
        <div class="d-flex flex-column flex-sm-row justify-content-end gap-2 mt-4">

            <a
                href="{{ route('admin.utilisateurs.index') }}"
                class="btn btn-light border px-4"
            >
                Annuler
            </a>

            <button
                type="submit"
                class="btn btn-primary px-4 d-inline-flex align-items-center justify-content-center gap-2"
            >
                <i class="bi bi-person-check"></i>
                Créer l'utilisateur
            </button>

        </div>

    </form>

</div>


{{-- =========================================================
    JAVASCRIPT
========================================================= --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const photoInput = document.getElementById('photo');
    const photoPreview = document.getElementById('photoPreview');
    const photoPlaceholder = document.getElementById('photoPlaceholder');
    const photoFileName = document.getElementById('photoFileName');

    if (!photoInput) {
        return;
    }

    photoInput.addEventListener('change', function (event) {

        const file = event.target.files[0];

        if (!file) {

            photoPreview.src = '';
            photoPreview.classList.add('d-none');

            photoPlaceholder.classList.remove('d-none');

            photoFileName.textContent = 'Aucune photo sélectionnée';

            return;
        }


        // Vérification visuelle côté navigateur
        const allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];

        if (!allowedTypes.includes(file.type)) {

            alert('Format non autorisé. Utilisez JPG, PNG ou WEBP.');

            photoInput.value = '';

            return;
        }


        // 2 Mo
        if (file.size > 2 * 1024 * 1024) {

            alert('La photo ne doit pas dépasser 2 Mo.');

            photoInput.value = '';

            return;
        }


        photoFileName.textContent = file.name;


        const reader = new FileReader();

        reader.onload = function (e) {

            photoPreview.src = e.target.result;

            photoPreview.classList.remove('d-none');

            photoPlaceholder.classList.add('d-none');

        };

        reader.readAsDataURL(file);

    });

});


function togglePassword(inputId, button) {

    const input = document.getElementById(inputId);
    const icon = button.querySelector('i');

    if (input.type === 'password') {

        input.type = 'text';

        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');

    } else {

        input.type = 'password';

        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');

    }
}
</script>

@endsection