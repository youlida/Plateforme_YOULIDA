{{-- resources/views/back/apropos/index.blade.php --}}
@extends('back.layouts.app')

@section('title', 'Gestion de la page À propos')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">
            <i class="fa-solid fa-circle-info me-2"></i>
            Gestion de la page "À propos"
        </h4>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        <!-- Section Héro -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                            <i class="fa-solid fa-images text-primary fa-xl"></i>
                        </div>
                        <h5 class="card-title mb-0">Section Héro</h5>
                    </div>
                    <p class="card-text text-muted small mb-3">
                        Titre principal, description, boutons et image de la section d'accueil de la page.
                    </p>
                    <div class="mt-3">
                        <a href="{{ route('admin.apropos.hero.edit') }}" class="btn btn-primary w-100">
                            <i class="fa-solid fa-pen me-2"></i>Modifier la section
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vision & Mission -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                            <i class="fa-solid fa-eye text-success fa-xl"></i>
                        </div>
                        <h5 class="card-title mb-0">Vision & Mission</h5>
                    </div>
                    <p class="card-text text-muted small mb-3">
                        La vision à long terme et la mission quotidienne de YOULIDA.
                    </p>
                    <div class="mt-3">
                        <a href="{{ route('admin.apropos.vision.edit') }}" class="btn btn-success w-100">
                            <i class="fa-solid fa-pen me-2"></i>Modifier
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nos Valeurs -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                            <i class="fa-solid fa-heart text-warning fa-xl"></i>
                        </div>
                        <h5 class="card-title mb-0">Nos Valeurs</h5>
                    </div>
                    <p class="card-text text-muted small mb-3">
                        Les valeurs fondamentales qui guident nos actions ({{ $valeurs->count() }} valeurs).
                    </p>
                    <div class="mt-3">
                        <a href="{{ route('admin.apropos.valeurs.index') }}" class="btn btn-warning w-100">
                            <i class="fa-solid fa-list me-2"></i>Gérer les valeurs
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistiques -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-info bg-opacity-10 p-3 me-3">
                            <i class="fa-solid fa-chart-line text-info fa-xl"></i>
                        </div>
                        <h5 class="card-title mb-0">Statistiques</h5>
                    </div>
                    <p class="card-text text-muted small mb-3">
                        Les chiffres clés affichés sur la page d'accueil ({{ $stats->count() }} statistiques).
                    </p>
                    <div class="mt-3">
                        <a href="{{ route('admin.apropos.stats.index') }}" class="btn btn-info w-100 text-white">
                            <i class="fa-solid fa-list me-2"></i>Gérer les stats
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Équipe (déjà existante) -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-secondary bg-opacity-10 p-3 me-3">
                            <i class="fa-solid fa-user-group text-secondary fa-xl"></i>
                        </div>
                        <h5 class="card-title mb-0">Équipe</h5>
                    </div>
                    <p class="card-text text-muted small mb-3">
                        Les membres de l'équipe YOULIDA ({{ $equipe->count() }} membres).
                    </p>
                    <div class="mt-3">
                        <a href="{{ route('admin.equipes.index') }}" class="btn btn-secondary w-100">
                            <i class="fa-solid fa-list me-2"></i>Gérer l'équipe
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Partenaires (déjà existante) -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-danger bg-opacity-10 p-3 me-3">
                            <i class="fa-solid fa-handshake text-danger fa-xl"></i>
                        </div>
                        <h5 class="card-title mb-0">Partenaires</h5>
                    </div>
                    <p class="card-text text-muted small mb-3">
                        Les partenaires qui soutiennent YOULIDA ({{ $partenaires->count() }} partenaires).
                    </p>
                    <div class="mt-3">
                        <a href="{{ route('admin.partenaires.index') }}" class="btn btn-danger w-100">
                            <i class="fa-solid fa-list me-2"></i>Gérer les partenaires
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Aperçu de la page -->
    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">
                <i class="fa-solid fa-eye me-2"></i>
                Aperçu rapide du contenu actuel
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="fw-bold">Hero Section</h6>
                    <p class="small mb-1"><strong>Titre:</strong> {{ $hero->title ?? 'Non défini' }}</p>
                    <p class="small"><strong>Sous-titre:</strong> {{ $hero->subtitle ?? 'Non défini' }}</p>
                    
                    <h6 class="fw-bold mt-3">Vision</h6>
                    <p class="small">{{ Str::limit($vision->content ?? 'Non défini', 100) }}</p>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold">Mission</h6>
                    <p class="small">{{ Str::limit($mission->content ?? 'Non défini', 100) }}</p>
                    
                    <h6 class="fw-bold mt-3">Statistiques actives</h6>
                    <p class="small">{{ $stats->where('is_active', true)->count() }} sur {{ $stats->count() }}</p>
                    
                    <h6 class="fw-bold">Valeurs actives</h6>
                    <p class="small">{{ $valeurs->where('is_active', true)->count() }} sur {{ $valeurs->count() }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection