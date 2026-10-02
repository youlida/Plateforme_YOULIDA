@extends('back.layouts.app')

@section('title', 'Modifier mon profil')

@section('content')

    <div class="container-fluid">

        {{-- =====================================================
        EN-TÊTE
        ====================================================== --}}
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">

            <div>

                <a href="{{ route('admin.profile.show') }}" class="text-decoration-none text-muted d-inline-block mb-2">
                    <i class="fa-solid fa-arrow-left me-1"></i>
                    Retour à mon profil
                </a>

                <h1 class="h3 mb-1">
                    Modifier mon profil
                </h1>

                <p class="text-muted mb-0">
                    Gérez vos informations personnelles, votre photo
                    et la sécurité de votre compte.
                </p>

            </div>

        </div>


        {{-- =====================================================
        SUCCÈS
        ====================================================== --}}
        @if(session('success'))

            <div class="alert alert-success alert-dismissible fade show">

                <i class="fa-solid fa-circle-check me-2"></i>

                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

            </div>

        @endif


        {{-- =====================================================
        ERREURS
        ====================================================== --}}
        @if($errors->any())

            <div class="alert alert-danger">

                <div class="fw-semibold mb-2">

                    <i class="fa-solid fa-circle-exclamation me-2"></i>

                    Certaines informations doivent être corrigées.

                </div>

                <ul class="mb-0">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <div class="row g-4">

            {{-- =================================================
            COLONNE PRINCIPALE
            ================================================== --}}
            <div class="col-lg-8">


                {{-- =============================================
                INFORMATIONS PERSONNELLES
                ============================================== --}}
                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')


                    {{-- =========================================
                    PHOTO DE PROFIL
                    ========================================== --}}
                    <div class="card border-0 shadow-sm mb-4">

                        <div class="card-header bg-white py-3">

                            <div class="d-flex align-items-center gap-2">

                                <div class="d-flex align-items-center justify-content-center
                                           rounded-circle bg-primary bg-opacity-10
                                           text-primary" style="width: 38px; height: 38px;">
                                    <i class="fa-regular fa-image"></i>
                                </div>

                                <div>

                                    <h5 class="mb-0">
                                        Photo de profil
                                    </h5>

                                    <small class="text-muted">
                                        Personnalisez votre compte administrateur
                                    </small>

                                </div>

                            </div>

                        </div>


                        <div class="card-body">

                            <div class="d-flex align-items-center flex-wrap gap-4">

                                {{-- Aperçu --}}
                                <div class="rounded-circle overflow-hidden
                                           d-flex align-items-center
                                           justify-content-center
                                           bg-primary bg-opacity-10
                                           text-primary fw-bold" style="
                                        width: 120px;
                                        height: 120px;
                                        min-width: 120px;
                                        font-size: 38px;
                                    ">

                                    @if(
                                                                        $user->photo &&
                                                                        \Illuminate\Support\Facades\Storage::disk('public')
                                                                            ->exists($user->photo)
                                                                    )

                                                                    <img id="profilePhotoPreview" src="{{ asset('storage/' . $user->photo) }}"
                                                                        alt="Photo de profil" style="
                                                                                width:100%;
                                                                                height:100%;
                                                                                object-fit:cover;
                                                                            ">

                                                                    <span id="profileInitial" style="display:none;">
                                                                        {{ strtoupper(
                                            substr(
                                                $user->prenom ?: $user->name,
                                                0,
                                                1
                                            )
                                        ) }}
                                                                    </span>

                                    @else

                                                                    <img id="profilePhotoPreview" src="" alt="" style="
                                                                                width:100%;
                                                                                height:100%;
                                                                                object-fit:cover;
                                                                                display:none;
                                                                            ">

                                                                    <span id="profileInitial">

                                                                        {{ strtoupper(
                                            substr(
                                                $user->prenom ?: ($user->name ?? 'A'),
                                                0,
                                                1
                                            )
                                        ) }}

                                                                    </span>

                                    @endif

                                </div>


                                {{-- Upload --}}
                                <div class="flex-grow-1">

                                    <label for="photo" class="form-label fw-semibold">
                                        Choisir une nouvelle photo
                                    </label>

                                    <input type="file" id="photo" name="photo"
                                        accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                                        class="form-control @error('photo') is-invalid @enderror">

                                    @error('photo')

                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                    <small class="text-muted d-block mt-2">
                                        JPG, JPEG, PNG ou WEBP. Taille maximale :
                                        2 Mo.
                                    </small>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- =========================================
                    IDENTITÉ
                    ========================================== --}}
                    <div class="card border-0 shadow-sm mb-4">

                        <div class="card-header bg-white py-3">

                            <div class="d-flex align-items-center gap-2">

                                <div class="d-flex align-items-center justify-content-center
                                           rounded-circle bg-primary bg-opacity-10
                                           text-primary" style="width:38px;height:38px;">
                                    <i class="fa-regular fa-user"></i>
                                </div>

                                <div>

                                    <h5 class="mb-0">
                                        Informations personnelles
                                    </h5>

                                    <small class="text-muted">
                                        Identité et coordonnées
                                    </small>

                                </div>

                            </div>

                        </div>


                        <div class="card-body">

                            <div class="row g-3">

                                {{-- Nom --}}
                                <div class="col-md-6">

                                    <label for="name" class="form-label">
                                        Nom
                                        <span class="text-danger">*</span>
                                    </label>

                                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                        class="form-control @error('name') is-invalid @enderror" required>

                                    @error('name')

                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>


                                {{-- Prénom --}}
                                <div class="col-md-6">

                                    <label for="prenom" class="form-label">
                                        Prénom
                                    </label>

                                    <input type="text" id="prenom" name="prenom" value="{{ old('prenom', $user->prenom) }}"
                                        class="form-control @error('prenom') is-invalid @enderror">

                                    @error('prenom')

                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>


                                {{-- Email --}}
                                <div class="col-md-6">

                                    <label for="email" class="form-label">
                                        Adresse e-mail
                                        <span class="text-danger">*</span>
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text bg-white">
                                            <i class="fa-regular fa-envelope"></i>
                                        </span>

                                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                                            class="form-control @error('email') is-invalid @enderror" required>

                                        @error('email')

                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>

                                        @enderror

                                    </div>

                                </div>


                                {{-- Téléphone --}}
                                <div class="col-md-6">

                                    <label for="telephone" class="form-label">
                                        Téléphone
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text bg-white">
                                            <i class="fa-solid fa-phone"></i>
                                        </span>

                                        <input type="text" id="telephone" name="telephone"
                                            value="{{ old('telephone', $user->telephone) }}"
                                            class="form-control @error('telephone') is-invalid @enderror"
                                            placeholder="+226...">

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


                    {{-- =========================================
                    LOCALISATION
                    ========================================== --}}
                    <div class="card border-0 shadow-sm mb-4">

                        <div class="card-header bg-white py-3">

                            <div class="d-flex align-items-center gap-2">

                                <div class="d-flex align-items-center justify-content-center
                                           rounded-circle bg-info bg-opacity-10
                                           text-info" style="width:38px;height:38px;">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>

                                <div>

                                    <h5 class="mb-0">
                                        Localisation
                                    </h5>

                                    <small class="text-muted">
                                        Pays et ville
                                    </small>

                                </div>

                            </div>

                        </div>


                        <div class="card-body">

                            <div class="row g-3">

                                <div class="col-md-6">

                                    <label for="pays" class="form-label">
                                        Pays
                                    </label>

                                    <input type="text" id="pays" name="pays" value="{{ old('pays', $user->pays) }}"
                                        class="form-control @error('pays') is-invalid @enderror"
                                        placeholder="Ex. Burkina Faso">

                                    @error('pays')

                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>


                                <div class="col-md-6">

                                    <label for="ville" class="form-label">
                                        Ville
                                    </label>

                                    <input type="text" id="ville" name="ville" value="{{ old('ville', $user->ville) }}"
                                        class="form-control @error('ville') is-invalid @enderror"
                                        placeholder="Ex. Ouagadougou">

                                    @error('ville')

                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- =========================================
                    ENREGISTRER
                    ========================================== --}}
                    <div class="d-flex justify-content-end gap-2 mb-4">

                        <a href="{{ route('admin.profile.show') }}" class="btn btn-outline-secondary">
                            Annuler
                        </a>

                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa-solid fa-floppy-disk me-2"></i>
                            Enregistrer les modifications
                        </button>

                    </div>

                </form>


                {{-- =============================================
                SÉCURITÉ / MOT DE PASSE
                ============================================== --}}
                <div class="card border-0 shadow-sm mb-4" id="security">

                    <div class="card-header bg-white py-3">

                        <div class="d-flex align-items-center gap-2">

                            <div class="d-flex align-items-center justify-content-center
                                       rounded-circle bg-warning bg-opacity-10
                                       text-warning" style="width:38px;height:38px;">
                                <i class="fa-solid fa-lock"></i>
                            </div>

                            <div>

                                <h5 class="mb-0">
                                    Sécurité
                                </h5>

                                <small class="text-muted">
                                    Modifier votre mot de passe
                                </small>

                            </div>

                        </div>

                    </div>


                    <div class="card-body">

                        <form action="{{ route('admin.profile.password.update') }}" method="POST">

                            @csrf
                            @method('PUT')


                            <div class="row g-3">

                                {{-- Mot de passe actuel --}}
                                <div class="col-12">

                                    <label for="current_password" class="form-label">
                                        Mot de passe actuel
                                        <span class="text-danger">*</span>
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text bg-white">
                                            <i class="fa-solid fa-key"></i>
                                        </span>

                                        <input type="password" id="current_password" name="current_password"
                                            class="form-control" autocomplete="current-password" required>

                                    </div>

                                </div>


                                {{-- Nouveau --}}
                                <div class="col-md-6">

                                    <label for="password" class="form-label">
                                        Nouveau mot de passe
                                        <span class="text-danger">*</span>
                                    </label>

                                    <input type="password" id="password" name="password" class="form-control"
                                        autocomplete="new-password" required>

                                    <small class="text-muted">
                                        Minimum 8 caractères.
                                    </small>

                                </div>


                                {{-- Confirmation --}}
                                <div class="col-md-6">

                                    <label for="password_confirmation" class="form-label">
                                        Confirmer le mot de passe
                                        <span class="text-danger">*</span>
                                    </label>

                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control" autocomplete="new-password" required>

                                </div>

                            </div>


                            <div class="mt-4">

                                <button type="submit" class="btn btn-warning">
                                    <i class="fa-solid fa-key me-2"></i>
                                    Modifier le mot de passe
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

                {{-- =====================================================
                ZONE DANGER
                ====================================================== --}}
                <div class="card border-danger shadow-sm mb-4">

                    <div class="card-header bg-danger bg-opacity-10 py-3">

                        <div class="d-flex align-items-center gap-2">

                            <div class="d-flex align-items-center justify-content-center
                           rounded-circle bg-danger text-white" style="width:38px;height:38px;">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                            </div>

                            <div>

                                <h5 class="mb-0 text-danger">
                                    Zone danger
                                </h5>

                                <small class="text-muted">
                                    Actions sensibles liées à votre compte
                                </small>

                            </div>

                        </div>

                    </div>


                    <div class="card-body">

                        {{-- Déconnexion --}}
                        <div class="d-flex justify-content-between
                       align-items-center flex-wrap gap-3">

                            <div>

                                <h6 class="mb-1">
                                    Fermer ma session
                                </h6>

                                <p class="text-muted small mb-0">
                                    Vous serez déconnecté de votre espace
                                    d'administration sur ce navigateur.
                                </p>

                            </div>


                            <form action="{{ route('logout') }}" method="POST">

                                @csrf

                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="fa-solid fa-right-from-bracket me-2"></i>
                                    Me déconnecter
                                </button>

                            </form>

                        </div>


                        <hr class="my-4">


                        {{-- Compte --}}
                        <div class="d-flex justify-content-between
                       align-items-center flex-wrap gap-3">

                            <div>

                                <h6 class="mb-1 text-danger">
                                    Gestion du compte
                                </h6>

                                @if($user->isSuperAdmin())

                                    <p class="text-muted small mb-0">
                                        Votre compte possède le rôle Super Administrateur.
                                        Sa suppression ou sa désactivation doit être
                                        protégée afin d'éviter de perdre l'accès
                                        à l'administration.
                                    </p>

                                @else

                                    <p class="text-muted small mb-0">
                                        La désactivation du compte empêche toute nouvelle
                                        connexion à l'administration.
                                    </p>

                                @endif

                            </div>


                            @if($user->isSuperAdmin())

                                <button type="button" class="btn btn-outline-danger" disabled
                                    title="Protection du compte Super Administrateur">
                                    <i class="fa-solid fa-lock me-2"></i>
                                    Compte protégé
                                </button>

                            @else

                                <button type="button" class="btn btn-outline-danger" disabled>
                                    <i class="fa-solid fa-user-slash me-2"></i>
                                    Désactiver mon compte
                                </button>

                            @endif

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
            COLONNE DROITE
            ================================================== --}}
            <div class="col-lg-4">


                {{-- COMPTE --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <h5 class="mb-0">
                            Votre compte
                        </h5>

                    </div>


                    <div class="card-body">

                        <div class="mb-3">

                            <small class="text-muted d-block">
                                Rôle
                            </small>

                            <strong>
                                {{ $user->role->name ?? 'Administrateur' }}
                            </strong>

                        </div>

                        <hr>


                        <div class="mb-3">

                            <small class="text-muted d-block">
                                Statut
                            </small>

                            @if($user->is_active)

                                <span class="badge bg-success bg-opacity-10 text-success">
                                    Actif
                                </span>

                            @else

                                <span class="badge bg-danger bg-opacity-10 text-danger">
                                    Inactif
                                </span>

                            @endif

                        </div>

                        <hr>


                        <div>

                            <small class="text-muted d-block">
                                Adresse e-mail du compte
                            </small>

                            <strong class="text-break">
                                {{ $user->email }}
                            </strong>

                        </div>

                    </div>

                </div>


                {{-- CONSEIL PHOTO --}}
                <div class="card border-0 bg-light mb-4">

                    <div class="card-body">

                        <div class="d-flex gap-3">

                            <i class="fa-solid fa-camera text-primary mt-1"></i>

                            <div>

                                <strong class="d-block mb-1">
                                    Photo de profil
                                </strong>

                                <p class="small text-muted mb-0">
                                    Utilisez de préférence une image carrée
                                    et nette. Elle sera automatiquement
                                    recadrée dans l'avatar.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- SUPPRESSION PHOTO --}}
                @if($user->photo)

                    <div class="card border-0 shadow-sm">

                        <div class="card-header bg-white py-3">

                            <h5 class="mb-0">
                                Photo actuelle
                            </h5>

                        </div>

                        <div class="card-body">

                            <p class="small text-muted">
                                Vous pouvez supprimer votre photo actuelle.
                                Votre initiale sera alors utilisée comme avatar.
                            </p>

                            <form action="{{ route('admin.profile.photo.destroy') }}" method="POST" onsubmit="
                                        return confirm(
                                            'Supprimer votre photo de profil ?'
                                        );
                                    ">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-outline-danger w-100">
                                    <i class="fa-regular fa-trash-can me-2"></i>
                                    Supprimer ma photo
                                </button>

                            </form>

                        </div>

                    </div>

                @endif

            </div>

        </div>

    </div>


    {{-- =====================================================
    APERÇU PHOTO AVANT ENREGISTREMENT
    ====================================================== --}}
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const photoInput =
                document.getElementById('photo');

            const preview =
                document.getElementById('profilePhotoPreview');

            const initial =
                document.getElementById('profileInitial');


            if (!photoInput || !preview) {
                return;
            }


            photoInput.addEventListener('change', function (event) {

                const file = event.target.files[0];

                if (!file) {
                    return;
                }


                // Vérification rapide côté navigateur
                if (!file.type.startsWith('image/')) {

                    alert(
                        'Veuillez sélectionner une image valide.'
                    );

                    photoInput.value = '';

                    return;
                }


                // Maximum 2 Mo
                if (file.size > 2 * 1024 * 1024) {

                    alert(
                        'La photo ne doit pas dépasser 2 Mo.'
                    );

                    photoInput.value = '';

                    return;
                }


                const reader = new FileReader();


                reader.onload = function (e) {

                    preview.src = e.target.result;

                    preview.style.display = 'block';

                    if (initial) {
                        initial.style.display = 'none';
                    }

                };


                reader.readAsDataURL(file);

            });

        });

    </script>

@endsection