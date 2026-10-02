{{-- resources/views/back/apropos/valeurs/edit.blade.php --}}
@extends('back.layouts.app')

@section('title', 'Modifier une valeur')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">
            <i class="fa-solid fa-edit me-2"></i>
            Modifier la valeur : <span class="text-primary">{{ $valeur->title }}</span>
        </h4>
        <a href="{{ route('admin.apropos.valeurs.index') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i>
            Retour à la liste
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.apropos.valeurs.update', $valeur->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-8">
                        <!-- Titre -->
                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">Titre <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="title" 
                                   id="title"
                                   class="form-control @error('title') is-invalid @enderror" 
                                   value="{{ old('title', $valeur->title) }}"
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
                                      required>{{ old('description', $valeur->description) }}</textarea>
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
                                <option value="Heart" {{ old('icon', $valeur->icon) == 'Heart' ? 'selected' : '' }}>❤️ Heart</option>
                                <option value="Users" {{ old('icon', $valeur->icon) == 'Users' ? 'selected' : '' }}>👥 Users</option>
                                <option value="Target" {{ old('icon', $valeur->icon) == 'Target' ? 'selected' : '' }}>🎯 Target</option>
                                <option value="Globe" {{ old('icon', $valeur->icon) == 'Globe' ? 'selected' : '' }}>🌍 Globe</option>
                                <option value="Lightbulb" {{ old('icon', $valeur->icon) == 'Lightbulb' ? 'selected' : '' }}>💡 Lightbulb</option>
                                <option value="Eye" {{ old('icon', $valeur->icon) == 'Eye' ? 'selected' : '' }}>👁️ Eye</option>
                                <option value="BookOpen" {{ old('icon', $valeur->icon) == 'BookOpen' ? 'selected' : '' }}>📚 BookOpen</option>
                                <option value="Sparkles" {{ old('icon', $valeur->icon) == 'Sparkles' ? 'selected' : '' }}>✨ Sparkles</option>
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
                                   value="{{ old('order', $valeur->order) }}"
                                   min="0">
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Statut actif -->
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input type="checkbox" 
                                       name="is_active" 
                                       id="is_active" 
                                       class="form-check-input" 
                                       value="1"
                                       {{ old('is_active', $valeur->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="is_active">
                                    Valeur active
                                </label>
                            </div>
                        </div>

                        <!-- Métadonnées -->
                        <div class="mt-4 p-3 bg-light rounded">
                            <small class="text-muted d-block">Créé le : {{ $valeur->created_at->format('d/m/Y H:i') }}</small>
                            <small class="text-muted d-block mt-1">Modifié le : {{ $valeur->updated_at->format('d/m/Y H:i') }}</small>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-3 pt-3 border-top">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa-solid fa-save me-2"></i>
                        Mettre à jour
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