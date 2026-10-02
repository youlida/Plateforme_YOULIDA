@extends('back.layouts.app')

@section('title', 'Détails de la catégorie')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">
            <i class="fa-solid fa-folder-open me-2"></i>
            Détails de la catégorie : <span class="text-primary">{{ $categorie->name }}</span>
        </h4>
        <div>
            <a href="{{ route('admin.categories.edit', $categorie) }}" class="btn btn-warning me-2">
                <i class="fa-solid fa-edit me-1"></i>
                Modifier
            </a>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
                <i class="fa-solid fa-arrow-left me-1"></i>
                Retour à la liste
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Colonne principale -->
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">
                        <i class="fa-solid fa-info-circle me-2 text-primary"></i>
                        Informations générales
                    </h5>
                </div>
                <div class="card-body">
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="border-bottom pb-2 mb-3">
                                <small class="text-muted d-block">ID</small>
                                <strong>#{{ $categorie->id }}</strong>
                            </div>
                            
                            <div class="border-bottom pb-2 mb-3">
                                <small class="text-muted d-block">Nom</small>
                                <strong class="fs-5">{{ $categorie->name }}</strong>
                            </div>
                            
                            <div class="border-bottom pb-2 mb-3">
                                <small class="text-muted d-block">Slug</small>
                                <code>{{ $categorie->slug }}</code>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="border-bottom pb-2 mb-3">
                                <small class="text-muted d-block">Statut</small>
                                @if($categorie->is_active)
                                    <span class="badge bg-success fs-6">
                                        <i class="fa-solid fa-check-circle me-1"></i> Actif
                                    </span>
                                @else
                                    <span class="badge bg-danger fs-6">
                                        <i class="fa-solid fa-times-circle me-1"></i> Inactif
                                    </span>
                                @endif
                            </div>
                            
                            <div class="border-bottom pb-2 mb-3">
                                <small class="text-muted d-block">Date de création</small>
                                <strong>
                                    <i class="fa-regular fa-calendar me-1"></i>
                                    {{ $categorie->created_at ? $categorie->created_at->format('d/m/Y H:i') : 'N/A' }}
                                </strong>
                            </div>
                            
                            <div class="border-bottom pb-2 mb-3">
                                <small class="text-muted d-block">Dernière modification</small>
                                <strong>
                                    <i class="fa-regular fa-clock me-1"></i>
                                    {{ $categorie->updated_at ? $categorie->updated_at->format('d/m/Y H:i') : 'N/A' }}
                                </strong>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mt-4">
                        <h6 class="fw-semibold mb-3">
                            <i class="fa-solid fa-align-left me-2 text-primary"></i>
                            Description
                        </h6>
                        <div class="p-3 bg-light rounded">
                            @if($categorie->description)
                                <p class="mb-0">{{ $categorie->description }}</p>
                            @else
                                <p class="text-muted fst-italic mb-0">
                                    <i class="fa-regular fa-file me-1"></i>
                                    Aucune description fournie pour cette catégorie.
                                </p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Colonne latérale : Statistiques et articles associés -->
        <div class="col-md-4">
            
            <!-- Statistiques -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">
                        <i class="fa-solid fa-chart-pie me-2 text-success"></i>
                        Statistiques
                    </h5>
                </div>
                <div class="card-body">
                    
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                        <span class="text-muted">Articles associés</span>
                        <span class="badge bg-info rounded-pill fs-6">
                            {{ $categorie->articles_count ?? 0 }}
                        </span>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                        <span class="text-muted">Programmes liés</span>
                        <span class="badge bg-info rounded-pill fs-6">
                            {{ $categorie->programmes_count ?? 0 }}
                        </span>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Existe depuis</span>
                        <strong>
                            {{ $categorie->created_at ? $categorie->created_at->diffForHumans() : 'N/A' }}
                        </strong>
                    </div>
                    
                </div>
            </div>

            <!-- Derniers articles de cette catégorie -->
            @if(isset($categorie->articles) && $categorie->articles->count() > 0)
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">
                        <i class="fa-solid fa-newspaper me-2 text-warning"></i>
                        Derniers articles
                    </h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @foreach($categorie->articles->take(5) as $article)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <a href="{{ route('admin.articles.show', $article->id) }}" class="text-decoration-none">
                                    {{ Str::limit($article->title, 30) }}
                                </a>
                                <br>
                                <small class="text-muted">
                                    {{ $article->created_at ? $article->created_at->format('d/m/Y') : 'N/A' }}
                                </small>
                            </div>
                            @if($article->is_published)
                                <span class="badge bg-success">Publié</span>
                            @else
                                <span class="badge bg-secondary">Brouillon</span>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                    @if($categorie->articles->count() > 5)
                    <div class="card-footer bg-white text-center">
                        <a href="#" class="text-decoration-none small">
                            Voir tous ({{ $categorie->articles->count() }})
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            @endif

        </div>
    </div>

    <!-- Actions supplémentaires -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card bg-light border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fa-solid fa-shield-alt me-2 text-secondary"></i>
                        <small class="text-muted">
                            Créé par : <strong>{{ $categorie->user->name ?? 'Système' }}</strong>
                        </small>
                    </div>
                    
                    <div>
                        <!-- Formulaire de suppression discret -->
                        <form action="{{ route('admin.categories.destroy', $categorie) }}" 
                              method="POST" 
                              class="d-inline"
                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer définitivement la catégorie « {{ $categorie->name }} » ? Cette action supprimera également tous les articles associés.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="fa-solid fa-trash me-1"></i>
                                Supprimer cette catégorie
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection