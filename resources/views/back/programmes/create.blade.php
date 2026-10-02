@extends('back.layouts.app')

@section('title', 'Créer un programme')

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
                <i class="bi bi-calendar-plus fs-4"></i>
            </div>

            <div>
                <h3 class="fw-bold mb-1">
                    Créer un programme
                </h3>

                <p class="text-muted mb-0 small">
                    Ajoutez un nouveau programme, une activité ou un événement YOULIDA.
                </p>
            </div>

        </div>


        <a
            href="{{ route('admin.programmes.index') }}"
            class="btn btn-light border d-inline-flex align-items-center justify-content-center gap-2"
        >
            <i class="bi bi-arrow-left"></i>
            Retour aux programmes
        </a>

    </div>


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
        action="{{ route('admin.programmes.store') }}"
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
                    IMAGE
                ============================================== --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white border-bottom py-3">

                        <div class="d-flex align-items-center gap-2">

                            <i class="bi bi-image text-primary"></i>

                            <h5 class="fw-bold mb-0">
                                Image du programme
                            </h5>

                        </div>

                    </div>


                    <div class="card-body p-4">

                        {{-- APERÇU --}}
                        <div
                            id="imagePreviewContainer"
                            class="position-relative rounded-3 overflow-hidden border bg-light mb-3"
                            style="height: 230px;"
                        >

                            <div
                                id="imagePlaceholder"
                                class="w-100 h-100 d-flex flex-column align-items-center justify-content-center text-muted"
                            >

                                <div
                                    class="d-flex align-items-center justify-content-center rounded-circle bg-white border mb-3"
                                    style="width: 65px; height: 65px;"
                                >
                                    <i class="bi bi-image fs-3"></i>
                                </div>

                                <strong class="small">
                                    Aperçu de l'image
                                </strong>

                                <small class="mt-1">
                                    Aucune image sélectionnée
                                </small>

                            </div>


                            <img
                                id="imagePreview"
                                src=""
                                alt="Aperçu du programme"
                                class="d-none w-100 h-100"
                                style="object-fit: cover;"
                            >

                        </div>


                        {{-- INPUT FILE --}}
                        <input
                            type="file"
                            name="image"
                            id="image"
                            class="d-none"
                            accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                        >


                        <label
                            for="image"
                            class="btn btn-light border w-100 d-flex align-items-center justify-content-center gap-2"
                            style="cursor: pointer;"
                        >
                            <i class="bi bi-upload"></i>
                            Choisir une image
                        </label>


                        @error('image')
                            <div class="text-danger small mt-2">
                                {{ $message }}
                            </div>
                        @enderror


                        <div
                            id="imageFileName"
                            class="text-muted small text-center mt-2"
                        >
                            Aucun fichier sélectionné
                        </div>


                        <hr class="my-4">


                        <div>

                            <small class="text-muted d-block mb-2">
                                Formats recommandés
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

                            </div>

                            <p class="text-muted small mt-3 mb-0">
                                Utilisez une image horizontale de bonne qualité
                                pour une meilleure présentation du programme.
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

                        <div
                            class="d-flex align-items-start justify-content-between gap-3"
                        >

                            <div>

                                <label
                                    for="is_active"
                                    class="fw-semibold d-block mb-1"
                                >
                                    Programme actif
                                </label>

                                <small class="text-muted">
                                    Activez cette option pour rendre le programme disponible.
                                </small>

                            </div>


                            <div class="form-check form-switch">

                                <input
                                    type="checkbox"
                                    name="is_active"
                                    id="is_active"
                                    value="1"
                                    class="form-check-input"
                                    style="width: 2.8em; height: 1.4em;"
                                    {{ old('is_active', '1') == '1' ? 'checked' : '' }}
                                >

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
                    INFORMATIONS PRINCIPALES
                ============================================== --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white border-bottom py-3">

                        <div class="d-flex align-items-center gap-3">

                            <div
                                class="d-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary"
                                style="width: 40px; height: 40px;"
                            >
                                <i class="bi bi-card-text"></i>
                            </div>

                            <div>

                                <h5 class="fw-bold mb-0">
                                    Informations principales
                                </h5>

                                <small class="text-muted">
                                    Présentez clairement le programme aux visiteurs.
                                </small>

                            </div>

                        </div>

                    </div>


                    <div class="card-body p-4">

                        {{-- TITRE --}}
                        <div class="mb-4">

                            <label
                                for="title"
                                class="form-label fw-semibold"
                            >
                                Titre du programme
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="title"
                                id="title"
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title') }}"
                                placeholder="Ex. Programme de leadership des jeunes"
                                required
                                autofocus
                            >

                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- DESCRIPTION COURTE --}}
                        <div class="mb-4">

                            <div class="d-flex justify-content-between align-items-center mb-2">

                                <label
                                    for="short_description"
                                    class="form-label fw-semibold mb-0"
                                >
                                    Description courte
                                </label>

                                <small
                                    id="shortDescriptionCounter"
                                    class="text-muted"
                                >
                                    0 caractère
                                </small>

                            </div>

                            <textarea
                                name="short_description"
                                id="short_description"
                                class="form-control @error('short_description') is-invalid @enderror"
                                rows="3"
                                maxlength="500"
                                placeholder="Présentez brièvement l'objectif du programme..."
                            >{{ old('short_description') }}</textarea>

                            @error('short_description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="form-text">
                                Cette description peut être utilisée dans les cartes et aperçus.
                            </div>

                        </div>


                        {{-- DESCRIPTION COMPLÈTE --}}
                        <div>

                            <label
                                for="description"
                                class="form-label fw-semibold"
                            >
                                Description complète
                                <span class="text-danger">*</span>
                            </label>

                            <textarea
                                name="description"
                                id="description"
                                class="form-control @error('description') is-invalid @enderror"
                                rows="8"
                                placeholder="Décrivez le programme, ses objectifs, son contenu, son public cible..."
                                required
                            >{{ old('description') }}</textarea>

                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="form-text">
                                Donnez suffisamment d'informations pour permettre aux visiteurs de comprendre le programme.
                            </div>

                        </div>

                    </div>

                </div>


                {{-- =============================================
                    LIEU ET PÉRIODE
                ============================================== --}}
                <div class="card border-0 shadow-sm">

                    <div class="card-header bg-white border-bottom py-3">

                        <div class="d-flex align-items-center gap-3">

                            <div
                                class="d-flex align-items-center justify-content-center rounded-circle bg-warning bg-opacity-10 text-warning"
                                style="width: 40px; height: 40px;"
                            >
                                <i class="bi bi-calendar3"></i>
                            </div>

                            <div>

                                <h5 class="fw-bold mb-0">
                                    Lieu et période
                                </h5>

                                <small class="text-muted">
                                    Indiquez où et quand se déroule le programme.
                                </small>

                            </div>

                        </div>

                    </div>


                    <div class="card-body p-4">

                        {{-- LIEU --}}
                        <div class="mb-4">

                            <label
                                for="location"
                                class="form-label fw-semibold"
                            >
                                Lieu
                            </label>

                            <div class="input-group">

                                <span class="input-group-text bg-light">
                                    <i class="bi bi-geo-alt"></i>
                                </span>

                                <input
                                    type="text"
                                    name="location"
                                    id="location"
                                    class="form-control @error('location') is-invalid @enderror"
                                    value="{{ old('location') }}"
                                    placeholder="Ex. Ouagadougou"
                                >

                                @error('location')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>


                        <div class="row g-4">

                            {{-- DATE DÉBUT --}}
                            <div class="col-12 col-md-6">

                                <label
                                    for="start_date"
                                    class="form-label fw-semibold"
                                >
                                    Date de début
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-calendar-check"></i>
                                    </span>

                                    <input
                                        type="date"
                                        name="start_date"
                                        id="start_date"
                                        class="form-control @error('start_date') is-invalid @enderror"
                                        value="{{ old('start_date') }}"
                                    >

                                    @error('start_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>


                            {{-- DATE FIN --}}
                            <div class="col-12 col-md-6">

                                <label
                                    for="end_date"
                                    class="form-label fw-semibold"
                                >
                                    Date de fin
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-calendar-x"></i>
                                    </span>

                                    <input
                                        type="date"
                                        name="end_date"
                                        id="end_date"
                                        class="form-control @error('end_date') is-invalid @enderror"
                                        value="{{ old('end_date') }}"
                                    >

                                    @error('end_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                            </div>

                        </div>


                        {{-- ALERTE DATES --}}
                        <div
                            id="dateWarning"
                            class="alert alert-warning mt-4 mb-0 d-none"
                        >
                            <div class="d-flex align-items-center gap-2">

                                <i class="bi bi-exclamation-triangle"></i>

                                <span>
                                    La date de fin ne peut pas être antérieure à la date de début.
                                </span>

                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            ACTIONS
        ====================================================== --}}
        <div
            class="d-flex flex-column flex-sm-row justify-content-end gap-2 mt-4"
        >

            <a
                href="{{ route('admin.programmes.index') }}"
                class="btn btn-light border px-4"
            >
                Annuler
            </a>

            <button
                type="submit"
                id="submitButton"
                class="btn btn-primary px-4 d-inline-flex align-items-center justify-content-center gap-2"
            >
                <i class="bi bi-check-circle"></i>
                Enregistrer le programme
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
    | Aperçu image
    |--------------------------------------------------------------------------
    */

    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const imagePlaceholder = document.getElementById('imagePlaceholder');
    const imageFileName = document.getElementById('imageFileName');

    if (imageInput) {

        imageInput.addEventListener('change', function (event) {

            const file = event.target.files[0];

            if (!file) {

                imagePreview.src = '';
                imagePreview.classList.add('d-none');

                imagePlaceholder.classList.remove('d-none');

                imageFileName.textContent = 'Aucun fichier sélectionné';

                return;
            }


            const allowedTypes = [
                'image/jpeg',
                'image/png',
                'image/webp'
            ];


            if (!allowedTypes.includes(file.type)) {

                alert('Format non autorisé. Utilisez JPG, PNG ou WEBP.');

                imageInput.value = '';

                return;
            }


            imageFileName.textContent = file.name;


            const reader = new FileReader();

            reader.onload = function (e) {

                imagePreview.src = e.target.result;

                imagePreview.classList.remove('d-none');

                imagePlaceholder.classList.add('d-none');

            };

            reader.readAsDataURL(file);

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Compteur description courte
    |--------------------------------------------------------------------------
    */

    const shortDescription = document.getElementById('short_description');
    const counter = document.getElementById('shortDescriptionCounter');

    function updateCounter() {

        if (!shortDescription || !counter) {
            return;
        }

        const length = shortDescription.value.length;

        counter.textContent =
            length + (length > 1 ? ' caractères' : ' caractère');
    }


    if (shortDescription) {

        updateCounter();

        shortDescription.addEventListener(
            'input',
            updateCounter
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Validation dates
    |--------------------------------------------------------------------------
    */

    const startDate = document.getElementById('start_date');
    const endDate = document.getElementById('end_date');
    const dateWarning = document.getElementById('dateWarning');
    const submitButton = document.getElementById('submitButton');


    function validateDates() {

        if (
            !startDate.value ||
            !endDate.value
        ) {

            dateWarning.classList.add('d-none');

            submitButton.disabled = false;

            return;
        }


        if (endDate.value < startDate.value) {

            dateWarning.classList.remove('d-none');

            endDate.classList.add('is-invalid');

            submitButton.disabled = true;

        } else {

            dateWarning.classList.add('d-none');

            endDate.classList.remove('is-invalid');

            submitButton.disabled = false;

        }

    }


    if (startDate && endDate) {

        startDate.addEventListener(
            'change',
            validateDates
        );

        endDate.addEventListener(
            'change',
            validateDates
        );

        validateDates();

    }

});
</script>

@endsection