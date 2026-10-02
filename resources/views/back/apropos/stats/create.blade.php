{{-- resources/views/back/apropos/stats/create.blade.php --}}
@extends('back.layouts.app')

@section('title', 'Ajouter une statistique')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">
            <i class="fa-solid fa-plus-circle me-2"></i>
            Ajouter une statistique
        </h4>
        <a href="{{ route('admin.apropos.stats.index') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i>
            Retour à la liste
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.apropos.stats.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-8">
                        <!-- Libellé -->
                        <div class="mb-3">
                            <label for="label" class="form-label fw-semibold">Libellé <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="label" 
                                   id="label"
                                   class="form-control @error('label') is-invalid @enderror" 
                                   value="{{ old('label') }}"
                                   placeholder="Ex: Jeunes accompagnés, Programmes réalisés..."
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
                                   value="{{ old('value') }}"
                                   placeholder="Ex: 5000+, 50+, 15..."
                                   required>
                            @error('value')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Vous pouvez utiliser des symboles comme +, %, etc.</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <!-- Icône -->
                        <div class="mb-3">
                            <label for="icon" class="form-label fw-semibold">Icône (optionnel)</label>
                            <select name="icon" id="icon" class="form-select @error('icon') is-invalid @enderror">
                                <option value="">Pas d'icône</option>
                                <option value="Heart" {{ old('icon') == 'Heart' ? 'selected' : '' }}>❤️ Heart</option>
                                <option value="Users" {{ old('icon') == 'Users' ? 'selected' : '' }}>👥 Users</option>
                                <option value="Target" {{ old('icon') == 'Target' ? 'selected' : '' }}>🎯 Target</option>
                                <option value="Globe" {{ old('icon') == 'Globe' ? 'selected' : '' }}>🌍 Globe</option>
                                <option value="TrendingUp" {{ old('icon') == 'TrendingUp' ? 'selected' : '' }}>📈 TrendingUp</option>
                                <option value="Award" {{ old('icon') == 'Award' ? 'selected' : '' }}>🏆 Award</option>
                                <option value="Calendar" {{ old('icon') == 'Calendar' ? 'selected' : '' }}>📅 Calendar</option>
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
                                    Statistique active
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-3 pt-3 border-top">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa-solid fa-save me-2"></i>
                        Enregistrer
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