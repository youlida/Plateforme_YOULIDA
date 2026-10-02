{{-- resources/views/back/apropos/stats/index.blade.php --}}
@extends('back.layouts.app')

@section('title', 'Statistiques - À propos')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">
            <i class="fa-solid fa-chart-line me-2 text-info"></i>
            Statistiques
        </h4>
        <div>
            <a href="{{ route('admin.apropos.stats.create') }}" class="btn btn-success me-2">
                <i class="fa-solid fa-plus me-1"></i>
                Nouvelle statistique
            </a>
            <a href="{{ route('admin.apropos.index') }}" class="btn btn-outline-secondary">
                <i class="fa-solid fa-arrow-left me-1"></i>
                Retour
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="50">ID</th>
                            <th>Libellé</th>
                            <th width="150">Valeur</th>
                            <th width="100">Icône</th>
                            <th width="100">Ordre</th>
                            <th width="100">Statut</th>
                            <th width="200">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stats as $stat)
                            <tr>
                                <td>{{ $stat->id }}</td>
                                <td><strong>{{ $stat->label }}</strong></td>
                                <td class="fw-bold">{{ $stat->value }}</td>
                                <td class="text-center fs-5">
                                    @if($stat->icon)
                                        @switch($stat->icon)
                                            @case('Heart') ❤️ @break
                                            @case('Users') 👥 @break
                                            @case('Target') 🎯 @break
                                            @case('Globe') 🌍 @break
                                            @case('TrendingUp') 📈 @break
                                            @case('Award') 🏆 @break
                                            @default {{ $stat->icon }}
                                        @endswitch
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $stat->order }}</td>
                                <td>
                                    @if($stat->is_active)
                                        <span class="badge bg-success">Actif</span>
                                    @else
                                        <span class="badge bg-danger">Inactif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.apropos.stats.edit', $stat->id) }}" 
                                           class="btn btn-warning"
                                           title="Modifier">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.apropos.stats.destroy', $stat->id) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Supprimer cette statistique ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" title="Supprimer">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <p class="text-muted mb-2">Aucune statistique définie</p>
                                    <a href="{{ route('admin.apropos.stats.create') }}" class="btn btn-primary btn-sm">
                                        <i class="fa-solid fa-plus"></i> Ajouter une statistique
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection