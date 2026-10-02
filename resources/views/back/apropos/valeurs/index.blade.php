{{-- resources/views/back/apropos/valeurs/index.blade.php --}}
@extends('back.layouts.app')

@section('title', 'Valeurs - À propos')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">
            <i class="fa-solid fa-heart me-2 text-danger"></i>
            Nos Valeurs
        </h4>
        <div>
            <a href="{{ route('admin.apropos.valeurs.create') }}" class="btn btn-success me-2">
                <i class="fa-solid fa-plus me-1"></i>
                Nouvelle valeur
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
                            <th width="80">Icône</th>
                            <th>Titre</th>
                            <th>Description</th>
                            <th width="100">Ordre</th>
                            <th width="100">Statut</th>
                            <th width="200">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($valeurs as $valeur)
                            <tr>
                                <td>{{ $valeur->id }}</td>
                                <td class="text-center fs-4">
                                    @switch($valeur->icon)
                                        @case('Heart') ❤️ @break
                                        @case('Users') 👥 @break
                                        @case('Target') 🎯 @break
                                        @case('Globe') 🌍 @break
                                        @case('Lightbulb') 💡 @break
                                        @case('Eye') 👁️ @break
                                        @default 🔹
                                    @endswitch
                                </td>
                                <td><strong>{{ $valeur->title }}</strong></td>
                                <td>{{ Str::limit($valeur->description, 50) }}</td>
                                <td>{{ $valeur->order }}</td>
                                <td>
                                    @if($valeur->is_active)
                                        <span class="badge bg-success">Actif</span>
                                    @else
                                        <span class="badge bg-danger">Inactif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.apropos.valeurs.edit', $valeur->id) }}" 
                                           class="btn btn-warning"
                                           title="Modifier">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.apropos.valeurs.destroy', $valeur->id) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Supprimer cette valeur ?')">
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
                                    <p class="text-muted mb-2">Aucune valeur définie</p>
                                    <a href="{{ route('admin.apropos.valeurs.create') }}" class="btn btn-primary btn-sm">
                                        <i class="fa-solid fa-plus"></i> Ajouter une valeur
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