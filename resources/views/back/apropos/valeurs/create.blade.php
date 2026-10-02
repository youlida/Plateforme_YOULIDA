{{-- resources/views/back/apropos/valeurs/create.blade.php --}}
@extends('back.layouts.app')

@section('title', 'Ajouter une valeur')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">
            <i class="fa-solid fa-plus-circle me-2"></i>
            Ajouter une valeur
        </h4>
        <a href="{{ route('admin.apropos.valeurs.index') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i>
            Retour à la liste
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.apropos.valeurs.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-8">
                        <!-- Titre -->
                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">Titre <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="title" 
                                   id="title"
                                   class="form-control @error('title') is-invalid @enderror" 
                                   value="{{ old('title') }}"
                                   placeholder="Ex: Empathie, Inclusion, Innovation..."
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
                                      rows="4"
                                      placeholder="Décrivez cette valeur..."
                                      required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <!-- Icône -->
                        <div class="mb-3">
                            <label for="icon" class="form-label fw-semibold">Icône <span class="text-danger">*</span></label>
                            <select name="icon" id="icon" class="form-select @error('icon') is-invalid @enderror" required>
                                <option value="">Choisir une icône</option>
                                <option value="Heart" {{ old('icon') == 'Heart' ? 'selected' : '' }}>❤️ Heart (Cœur)</option>
                                <option value="Users" {{ old('icon') == 'Users' ? 'selected' : '' }}>👥 Users (Personnes)</option>
                                <option value="Target" {{ old('icon') == 'Target' ? 'selected' : '' }}>🎯 Target (Cible)</option>
                                <option value="Globe" {{ old('icon') == 'Globe' ? 'selected' : '' }}>🌍 Globe (Monde)</option>
                                <option value="Lightbulb" {{ old('icon') == 'Lightbulb' ? 'selected' : '' }}>💡 Lightbulb (Idée)</option>
                                <option value="Eye" {{ old('icon') == 'Eye' ? 'selected' : '' }}>👁️ Eye (Vision)</option>
                                <option value="BookOpen" {{ old('icon') == 'BookOpen' ? 'selected' : '' }}>📚 BookOpen (Livre)</option>
                                <option value="Sparkles" {{ old('icon') == 'Sparkles' ? 'selected' : '' }}>✨ Sparkles (Éclat)</option>
                            </select>
                            @error('icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Ordre -->
                        <div class="mb-3">
                            <label for="order" class="form-label fw-semibold">Ordre d'affichage</label>
                            <input type="number" 
                                   name="order" 
                                   id="order"
                                   class="form-control @error('order') is-invalid @enderror" 
                                   value="{{ old('order', 0) }}"
                                   min="0">
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Plus le chiffre est petit, plus la valeur apparaît en premier.</div>
                        </div>

                        <!-- Statut actif -->
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input type="checkbox" 
                                       name="is_active" 
                                       id="is_active" 
                                       class="form-check-input" 
                                       value="1"
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="is_active">
                                    Valeur active
                                </label>
                            </div>
                            <div class="form-text">Si activée, la valeur sera visible sur le site.</div>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-3 pt-3 border-top">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa-solid fa-save me-2"></i>
                        Enregistrer
                    </button>
                    <a href="{{ route('admin.apropos.valeurs.index') }}" class="btn btn-outline-secondary px-4">
                        <i class="fa-solid fa-times me-2"></i>
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection