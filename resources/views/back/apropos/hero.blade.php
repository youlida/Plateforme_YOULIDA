{{-- resources/views/back/apropos/hero.blade.php --}}
@extends('back.layouts.app')

@section('title', 'Section Héro - À propos')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">
            <i class="fa-solid fa-images me-2"></i>
            Section Héro
        </h4>
        <a href="{{ route('admin.apropos.index') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i>
            Retour
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Modifier la section d'en-tête</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.apropos.hero.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <!-- Badge -->
                        <div class="mb-3">
                            <label for="badge" class="form-label fw-semibold">Badge</label>
                            <input type="text" 
                                   name="badge" 
                                   id="badge"
                                   class="form-control @error('badge') is-invalid @enderror" 
                                   value="{{ old('badge', $hero->badge ?? 'Ensemble pour la jeunesse africaine') }}">
                            @error('badge')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text text-muted">Petit texte au-dessus du titre principal.</div>
                        </div>

                        <!-- Titre principal -->
                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">Titre principal <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="title" 
                                   id="title"
                                   class="form-control @error('title') is-invalid @enderror" 
                                   value="{{ old('title', $hero->title ?? 'À propos de YOULIDA') }}"
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">Description <span class="text-danger">*</span></label>
                            <textarea name="description" 
                                      id="description"
                                      class="form-control @error('description') is-invalid @enderror" 
                                      rows="5"
                                      required>{{ old('description', $hero->description ?? '') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- Bouton primaire - texte -->
                        <div class="mb-3">
                            <label for="primary_button_text" class="form-label fw-semibold">Bouton primaire - Texte</label>
                            <input type="text" 
                                   name="primary_button_text" 
                                   id="primary_button_text"
                                   class="form-control @error('primary_button_text') is-invalid @enderror" 
                                   value="{{ old('primary_button_text', $hero->primary_button_text ?? 'Rejoignez-nous') }}">
                            @error('primary_button_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Bouton primaire - lien -->
                        <div class="mb-3">
                            <label for="primary_button_link" class="form-label fw-semibold">Bouton primaire - Lien</label>
                            <input type="text" 
                                   name="primary_button_link" 
                                   id="primary_button_link"
                                   class="form-control @error('primary_button_link') is-invalid @enderror" 
                                   value="{{ old('primary_button_link', $hero->primary_button_link ?? '/s-impliquer') }}">
                            @error('primary_button_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Bouton secondaire - texte -->
                        <div class="mb-3">
                            <label for="secondary_button_text" class="form-label fw-semibold">Bouton secondaire - Texte</label>
                            <input type="text" 
                                   name="secondary_button_text" 
                                   id="secondary_button_text"
                                   class="form-control @error('secondary_button_text') is-invalid @enderror" 
                                   value="{{ old('secondary_button_text', $hero->secondary_button_text ?? 'Découvrir nos actions') }}">
                            @error('secondary_button_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Bouton secondaire - lien -->
                        <div class="mb-3">
                            <label for="secondary_button_link" class="form-label fw-semibold">Bouton secondaire - Lien</label>
                            <input type="text" 
                                   name="secondary_button_link" 
                                   id="secondary_button_link"
                                   class="form-control @error('secondary_button_link') is-invalid @enderror" 
                                   value="{{ old('secondary_button_link', $hero->secondary_button_link ?? '/nos-actions') }}">
                            @error('secondary_button_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Image -->
                        <div class="mb-3">
                            <label for="image" class="form-label fw-semibold">URL de l'image</label>
                            <input type="text" 
                                   name="image" 
                                   id="image"
                                   class="form-control @error('image') is-invalid @enderror" 
                                   value="{{ old('image', $hero->image ?? '/images/hero-african-youth.jpg') }}">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Alt de l'image -->
                        <div class="mb-3">
                            <label for="image_alt" class="form-label fw-semibold">Texte alternatif de l'image</label>
                            <input type="text" 
                                   name="image_alt" 
                                   id="image_alt"
                                   class="form-control @error('image_alt') is-invalid @enderror" 
                                   value="{{ old('image_alt', $hero->image_alt ?? 'Jeunes africains engagés') }}">
                            @error('image_alt')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-3 pt-3 border-top">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa-solid fa-save me-2"></i>
                        Enregistrer
                    </button>
                    <a href="{{ route('admin.apropos.index') }}" class="btn btn-outline-secondary px-4">
                        <i class="fa-solid fa-times me-2"></i>
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection