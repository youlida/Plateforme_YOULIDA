@extends('back.layouts.app')

@section('title', 'Créer une catégorie')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">
            <i class="fa-solid fa-folder-plus me-2"></i>
            Créer une catégorie
        </h4>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i>
            Retour à la liste
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Informations de la catégorie</h5>
        </div>
        <div class="card-body">
            
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                <!-- Champ Nom -->
                <div class="mb-4">
                    <label for="name" class="form-label fw-semibold">
                        Nom <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                           name="name" 
                           id="name"
                           class="form-control form-control-lg @error('name') is-invalid @enderror" 
                           value="{{ old('name') }}" 
                           placeholder="Ex: Éducation, Santé, Entrepreneuriat..."
                           required
                           autofocus>
                    
                    @error('name')
                        <div class="invalid-feedback">
                            <i class="fa-solid fa-circle-exclamation me-1"></i>
                            {{ $message }}
                        </div>
                    @else
                        <div class="form-text text-muted">
                            <i class="fa-solid fa-info-circle me-1"></i>
                            Le nom doit être unique et contenir au moins 3 caractères.
                        </div>
                    @enderror
                </div>

                <!-- Champ Description -->
                <div class="mb-4">
                    <label for="description" class="form-label fw-semibold">
                        Description
                    </label>
                    <textarea name="description" 
                              id="description"
                              class="form-control @error('description') is-invalid @enderror" 
                              rows="5"
                              placeholder="Décrivez brièvement cette catégorie...">{{ old('description') }}</textarea>
                    
                    @error('description')
                        <div class="invalid-feedback">
                            <i class="fa-solid fa-circle-exclamation me-1"></i>
                            {{ $message }}
                        </div>
                    @else
                        <div class="form-text text-muted">
                            <i class="fa-solid fa-info-circle me-1"></i>
                            Optionnel. Maximum 500 caractères.
                        </div>
                    @enderror
                </div>

                <!-- Champ Actif - CORRIGÉ : coché par défaut -->
                <div class="mb-4">
                    <div class="form-check form-switch p-0">
                        <input type="checkbox" 
                               name="is_active" 
                               id="is_active" 
                               value="1"
                               class="form-check-input" 
                               role="switch"
                               style="float: none; margin-right: 0.5rem;"
                               {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="is_active">
                            Activer la catégorie
                        </label>
                    </div>
                    <div class="form-text text-muted mt-1" style="margin-left: 2rem;">
                        <i class="fa-solid fa-info-circle me-1"></i>
                        Si activée, la catégorie sera disponible dans les listes déroulantes (articles, programmes...).
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="d-flex gap-2 mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fa-solid fa-save me-1"></i>
                        Enregistrer
                    </button>
                    
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary px-4">
                        <i class="fa-solid fa-times me-1"></i>
                        Annuler
                    </a>
                </div>

            </form>
        </div>
    </div>

    <!-- Aperçu en temps réel (optionnel) -->
    <div class="card mt-4 bg-light" id="preview-card" style="display: none;">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">
                <i class="fa-solid fa-eye me-2"></i>
                Aperçu de la catégorie
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nom :</strong> <span id="preview-name">---</span></p>
                    <p><strong>Slug :</strong> <span id="preview-slug">---</span></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Statut :</strong> 
                        <span id="preview-status" class="badge bg-success">Actif</span>
                    </p>
                </div>
                <div class="col-12">
                    <p><strong>Description :</strong></p>
                    <p id="preview-description" class="text-muted fst-italic">---</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    // Script pour l'aperçu en temps réel (optionnel)
    document.addEventListener('DOMContentLoaded', function() {
        const nameInput = document.getElementById('name');
        const descInput = document.getElementById('description');
        const activeCheck = document.getElementById('is_active');
        const previewCard = document.getElementById('preview-card');
        
        function updatePreview() {
            const name = nameInput.value.trim();
            const desc = descInput.value.trim();
            const isActive = activeCheck.checked;
            
            if (name.length > 0) {
                previewCard.style.display = 'block';
                
                document.getElementById('preview-name').textContent = name;
                document.getElementById('preview-slug').textContent = 
                    name.toLowerCase()
                        .replace(/[^\w\s-]/g, '')
                        .replace(/[\s_-]+/g, '-')
                        .replace(/^-+|-+$/g, '');
                
                document.getElementById('preview-description').textContent = 
                    desc || '<em>Aucune description fournie</em>';
                
                const statusBadge = document.getElementById('preview-status');
                if (isActive) {
                    statusBadge.className = 'badge bg-success';
                    statusBadge.textContent = 'Actif';
                } else {
                    statusBadge.className = 'badge bg-danger';
                    statusBadge.textContent = 'Inactif';
                }
            } else {
                previewCard.style.display = 'none';
            }
        }
        
        nameInput.addEventListener('input', updatePreview);
        descInput.addEventListener('input', updatePreview);
        activeCheck.addEventListener('change', updatePreview);
    });
</script>
@endpush

@push('styles')
<style>
    .form-check-input:checked {
        background-color: #198754;
        border-color: #198754;
    }
    .form-control-lg {
        font-size: 1rem;
    }
    #preview-card {
        transition: all 0.3s ease;
    }
    .border-top {
        border-top: 1px solid #dee2e6 !important;
    }
</style>
@endpush