{{-- resources/views/back/apropos/stats/edit.blade.php --}}
@extends('back.layouts.app')

@section('title', 'Modifier une statistique')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">
            <i class="fa-solid fa-edit me-2"></i>
            Modifier la statistique : <span class="text-primary">{{ $stat->label }}</span>
        </h4>
        <a href="{{ route('admin.apropos.stats.index') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i>
            Retour à la liste
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.apropos.stats.update', $stat->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-8">
                        <!-- Libellé -->
                        <div class="mb-3">
                            <label for="label" class="form-label fw-semibold">Libellé <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="label" 
                                   id="label"
                                   class="form-control @error('label') is-invalid @enderror" 
                                   value="{{ old('label', $stat->label) }}"
                                   required>
                            @error('label')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Valeur -->
                        <div class="mb-3">
                            <label for="value" class="form-label fw-semibold">Valeur <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="value" 
                                   id="value"
                                   class="form-control @error('value') is-invalid @enderror" 
                                   value="{{ old('value', $stat->value) }}"
                                   required>
                            @error('value')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <!-- Icône -->
                        <div class="mb-3">
                            <label for="icon" class="form-label fw-semibold">Icône</label>
                            <select name="icon" id="icon" class="form-select @error('icon') is-invalid @enderror">
                                <option value="">Pas d'icône</option>
                                <option value="Heart" {{ old('icon', $stat->icon) == 'Heart' ? 'selected' : '' }}>❤️ Heart</option>
                                <option value="Users" {{ old('icon', $stat->icon) == 'Users' ? 'selected' : '' }}>👥 Users</option>
                                <option value="Target" {{ old('icon', $stat->icon) == 'Target' ? 'selected' : '' }}>🎯 Target</option>
                                <option value="Globe" {{ old('icon', $stat->icon) == 'Globe' ? 'selected' : '' }}>🌍 Globe</option>
                                <option value="TrendingUp" {{ old('icon', $stat->icon) == 'TrendingUp' ? 'selected' : '' }}>📈 TrendingUp</option>
                                <option value="Award" {{ old('icon', $stat->icon) == 'Award' ? 'selected' : '' }}>🏆 Award</option>
                            </select>
                        </div>

                        <!-- Ordre -->
                        <div class="mb-3">
                            <label for="order" class="form-label fw-semibold">Ordre d'affichage</label>
                            <input type="number" 
                                   name="order" 
                                   id="order"
                                   class="form-control @error('order') is-invalid @enderror" 
                                   value="{{ old('order', $stat->order) }}"
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
                                       {{ old('is_active', $stat->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="is_active">
                                    Statistique active
                                </label>
                            </div>
                        </div>

                        <!-- Métadonnées -->
                        <div class="mt-4 p-3 bg-light rounded">
                            <small class="text-muted d-block">Créé le : {{ $stat->created_at->format('d/m/Y H:i') }}</small>
                            <small class="text-muted d-block mt-1">Modifié le : {{ $stat->updated_at->format('d/m/Y H:i') }}</small>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-3 pt-3 border-top">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa-solid fa-save me-2"></i>
                        Mettre à jour
                    </button>
                    <a href="{{ route('admin.apropos.stats.index') }}" class="btn btn-outline-secondary px-4">
                        <i class="fa-solid fa-times me-2"></i>
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection