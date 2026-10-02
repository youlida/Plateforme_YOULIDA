@extends('back.layouts.app')

@section('title', 'Créer un témoignage')

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
                <i class="bi bi-chat-quote fs-4"></i>
            </div>

            <div>
                <h3 class="fw-bold mb-1">
                    Créer un témoignage
                </h3>

                <p class="text-muted mb-0 small">
                    Ajoutez un nouveau témoignage à présenter sur la plateforme YOULIDA.
                </p>
            </div>

        </div>


        <a
            href="{{ route('admin.temoignages.index') }}"
            class="btn btn-light border d-inline-flex align-items-center justify-content-center gap-2"
        >
            <i class="bi bi-arrow-left"></i>
            Retour aux témoignages
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
        action="{{ route('admin.temoignages.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf


        <div class="row g-4">

            {{-- =================================================
                COLONNE GAUCHE
            ================================================== --}}
            <div class="col-12 col-xl-4">

                {{-- =============================================
                    PHOTO DE PROFIL
                ============================================== --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white border-bottom py-3">

                        <div class="d-flex align-items-center gap-2">

                            <i class="bi bi-camera text-primary"></i>

                            <h5 class="fw-bold mb-0">
                                Photo de profil
                            </h5>

                        </div>

                    </div>


                    <div class="card-body p-4 text-center">

                        {{-- APERÇU --}}
                        <div class="mb-4">

                            <div
                                id="photoPlaceholder"
                                class="d-flex flex-column align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary mx-auto"
                                style="
                                    width: 150px;
                                    height: 150px;
                                "
                            >
                                <i class="bi bi-person fs-1"></i>

                                <small class="mt-1">
                                    Photo
                                </small>
                            </div>


                            <img
                                id="photoPreview"
                                src=""
                                alt="Aperçu de la photo"
                                class="rounded-circle border shadow-sm d-none mx-auto"
                                style="
                                    width: 150px;
                                    height: 150px;
                                    object-fit: cover;
                                "
                            >

                        </div>


                        {{-- INPUT --}}
                        <input
                            type="file"
                            name="photo"
                            id="photo"
                            class="d-none"
                            accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                        >


                        <label
                            for="photo"
                            class="btn btn-light border d-inline-flex align-items-center justify-content-center gap-2"
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
                            class="text-muted small mt-3"
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


                            <p class="text-muted small mt-3 mb-0">
                                Privilégiez une photo carrée et nette pour un
                                meilleur affichage du profil.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- =============================================
                    PUBLICATION
                ============================================== --}}
                <div class="card border-0 shadow-sm">

                    <div class="card-header bg-white border-bottom py-3">

                        <div class="d-flex align-items-center gap-2">

                            <i class="bi bi-broadcast text-success"></i>

                            <h5 class="fw-bold mb-0">
                                Publication
                            </h5>

                        </div>

                    </div>


                    <div class="card-body p-4">

                        <div class="d-flex align-items-start justify-content-between gap-3">

                            <div>

                                <label
                                    for="is_published"
                                    class="fw-semibold d-block mb-1"
                                >
                                    Publier le témoignage
                                </label>

                                <small class="text-muted">
                                    Activez cette option pour rendre le témoignage public.
                                </small>

                            </div>


                            <div class="form-check form-switch">

                                <input
                                    type="checkbox"
                                    name="is_published"
                                    id="is_published"
                                    value="1"
                                    class="form-check-input"
                                    style="width: 2.8em; height: 1.4em;"
                                    {{ old('is_published', '1') == '1' ? 'checked' : '' }}
                                >

                            </div>

                        </div>


                        @error('is_published')
                            <div class="text-danger small mt-2">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

            </div>


            {{-- =================================================
                COLONNE DROITE
            ================================================== --}}
            <div class="col-12 col-xl-8">

                {{-- =============================================
                    INFORMATIONS DE LA PERSONNE
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
                                    Informations de la personne
                                </h5>

                                <small class="text-muted">
                                    Identifiez la personne à l'origine du témoignage.
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

                                <div class="input-group">

                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-person"></i>
                                    </span>

                                    <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}"
                                        placeholder="Nom de la personne"
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

                            </div>


                            {{-- EMAIL --}}
                            <div class="col-12 col-md-6">

                                <label
                                    for="email"
                                    class="form-label fw-semibold"
                                >
                                    Adresse email
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-envelope"></i>
                                    </span>

                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}"
                                        placeholder="nom@exemple.com"
                                        maxlength="255"
                                    >

                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                                <div class="form-text">
                                    L'adresse email peut rester confidentielle et ne pas être affichée publiquement.
                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =============================================
                    TÉMOIGNAGE
                ============================================== --}}
                <div class="card border-0 shadow-sm">

                    <div class="card-header bg-white border-bottom py-3">

                        <div class="d-flex align-items-center gap-3">

                            <div
                                class="d-flex align-items-center justify-content-center rounded-circle bg-warning bg-opacity-10 text-warning"
                                style="width: 40px; height: 40px;"
                            >
                                <i class="bi bi-quote"></i>
                            </div>

                            <div>

                                <h5 class="fw-bold mb-0">
                                    Témoignage
                                </h5>

                                <small class="text-muted">
                                    Saisissez le message qui sera associé à cette personne.
                                </small>

                            </div>

                        </div>

                    </div>


                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center mb-2">

                            <label
                                for="message"
                                class="form-label fw-semibold mb-0"
                            >
                                Message
                                <span class="text-danger">*</span>
                            </label>

                            <small
                                id="messageCounter"
                                class="text-muted"
                            >
                                0 caractère
                            </small>

                        </div>


                        <textarea
                            name="message"
                            id="message"
                            class="form-control @error('message') is-invalid @enderror"
                            rows="10"
                            placeholder="Saisissez ici le témoignage..."
                            required
                        >{{ old('message') }}</textarea>


                        @error('message')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror


                        <div class="form-text">
                            Relisez le témoignage avant publication afin de vérifier son contenu.
                        </div>


                        {{-- APERÇU --}}
                        <div
                            id="messagePreviewContainer"
                            class="mt-4 d-none"
                        >

                            <label class="form-label fw-semibold">
                                Aperçu
                            </label>

                            <div class="border rounded-3 bg-light p-4">

                                <div class="d-flex gap-3">

                                    <i class="bi bi-quote fs-3 text-primary"></i>

                                    <div
                                        id="messagePreview"
                                        class="text-muted"
                                        style="
                                            white-space: pre-line;
                                            line-height: 1.7;
                                        "
                                    ></div>

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
                href="{{ route('admin.temoignages.index') }}"
                class="btn btn-light border px-4"
            >
                Annuler
            </a>

            <button
                type="submit"
                class="btn btn-primary px-4 d-inline-flex align-items-center justify-content-center gap-2"
            >
                <i class="bi bi-check-circle"></i>
                Enregistrer le témoignage
            </button>

        </div>

    </form>

</div>


{{-- =========================================================
    JAVASCRIPT
========================================================= --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | APERÇU PHOTO
    |--------------------------------------------------------------------------
    */

    const photoInput = document.getElementById('photo');
    const photoPreview = document.getElementById('photoPreview');
    const photoPlaceholder = document.getElementById('photoPlaceholder');
    const photoFileName = document.getElementById('photoFileName');


    if (photoInput) {

        photoInput.addEventListener('change', function (event) {

            const file = event.target.files[0];


            if (!file) {

                photoPreview.src = '';
                photoPreview.classList.add('d-none');

                photoPlaceholder.classList.remove('d-none');

                photoFileName.textContent =
                    'Aucune photo sélectionnée';

                return;
            }


            const allowedTypes = [
                'image/jpeg',
                'image/png',
                'image/webp'
            ];


            if (!allowedTypes.includes(file.type)) {

                alert(
                    'Format non autorisé. Utilisez JPG, PNG ou WEBP.'
                );

                photoInput.value = '';

                photoPreview.src = '';
                photoPreview.classList.add('d-none');

                photoPlaceholder.classList.remove('d-none');

                photoFileName.textContent =
                    'Aucune photo sélectionnée';

                return;
            }


            /*
            |--------------------------------------------------------------------------
            | Taille maximale : 2 Mo
            |--------------------------------------------------------------------------
            */

            const maxSize = 2 * 1024 * 1024;


            if (file.size > maxSize) {

                alert(
                    'La photo ne doit pas dépasser 2 Mo.'
                );

                photoInput.value = '';

                photoPreview.src = '';
                photoPreview.classList.add('d-none');

                photoPlaceholder.classList.remove('d-none');

                photoFileName.textContent =
                    'Aucune photo sélectionnée';

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

    }


    /*
    |--------------------------------------------------------------------------
    | COMPTEUR + APERÇU DU MESSAGE
    |--------------------------------------------------------------------------
    */

    const messageInput =
        document.getElementById('message');

    const messageCounter =
        document.getElementById('messageCounter');

    const messagePreview =
        document.getElementById('messagePreview');

    const messagePreviewContainer =
        document.getElementById(
            'messagePreviewContainer'
        );


    function updateMessage() {

        if (!messageInput) {
            return;
        }


        const content =
            messageInput.value.trim();

        const length =
            messageInput.value.length;


        /*
        | Compteur
        */

        if (messageCounter) {

            messageCounter.textContent =
                length +
                (length > 1
                    ? ' caractères'
                    : ' caractère');

        }


        /*
        | Aperçu
        */

        if (
            messagePreview &&
            messagePreviewContainer
        ) {

            if (content.length > 0) {

                messagePreview.textContent =
                    content;

                messagePreviewContainer
                    .classList
                    .remove('d-none');

            } else {

                messagePreview.textContent = '';

                messagePreviewContainer
                    .classList
                    .add('d-none');

            }

        }

    }


    if (messageInput) {

        updateMessage();

        messageInput.addEventListener(
            'input',
            updateMessage
        );

    }

});
</script>

@endsection