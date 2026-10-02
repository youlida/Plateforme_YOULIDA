@extends('back.layouts.app')

@section('title', 'Catégories')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Liste des catégories</h4>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus me-1"></i> Ajouter une catégorie
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="50">ID</th>
                        <th>Nom</th>
                        <th>Slug</th>
                        <th width="100" class="text-center">Actif</th>
                        <th width="150">Date création</th>
                        <th width="250" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $categorie)
                        <tr>
                            <td>{{ $categorie->id }}</td>
                            <td>
                                <strong>{{ $categorie->name }}</strong>
                                @if($categorie->description)
                                    <br><small class="text-muted">{{ Str::limit($categorie->description, 50) }}</small>
                                @endif
                            </td>
                            <td><code>{{ $categorie->slug }}</code></td>
                            <td class="text-center">
                                @if($categorie->is_active)
                                    <span class="badge bg-success">Oui</span>
                                @else
                                    <span class="badge bg-danger">Non</span>
                                @endif
                            </td>
                            <td>
                                {{ $categorie->created_at ? $categorie->created_at->format('d/m/Y H:i') : 'N/A' }}
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('admin.categories.show', $categorie->id) }}" 
                                       class="btn btn-info" 
                                       title="Voir détails">
                                        <i class="fa-solid fa-eye"></i> Voir
                                    </a>

                                    <a href="{{ route('admin.categories.edit', $categorie->id) }}" 
                                       class="btn btn-warning"
                                       title="Modifier">
                                        <i class="fa-solid fa-edit"></i> Modifier
                                    </a>

                                    <form action="{{ route('admin.categories.destroy', $categorie->id) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer la catégorie « {{ $categorie->name }} » ? Cette action est irréversible.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-danger" 
                                                title="Supprimer">
                                            <i class="fa-solid fa-trash"></i> Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fa-solid fa-folder-open fa-2x mb-2"></i>
                                    <p>Aucune catégorie trouvée.</p>
                                    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm">
                                        <i class="fa-solid fa-plus"></i> Créer votre première catégorie
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $categories->links() }}
    </div>

</div>
@endsection

@push('styles')
<style>
    .table th {
        font-weight: 600;
        background-color: #f8f9fa;
    }
    .btn-group .btn {
        margin: 0 2px;
    }
    .badge {
        font-size: 0.85rem;
        padding: 0.35rem 0.65rem;
    }
</style>
@endpush