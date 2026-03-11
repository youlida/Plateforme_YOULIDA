@extends('back.layouts.app')

@section('title','Catégories')

@section('content')

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-3">
<h4>Liste des catégories</h4>

<a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
Ajouter une catégorie
</a>
</div>

@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

<div class="card">
<div class="card-body table-responsive">

<table class="table table-bordered">

<thead>
<tr>
<th>ID</th>
<th>Nom</th>
<th>Slug</th>
<th>Actif</th>
<th>Date</th>
<th width="200">Actions</th>
</tr>
</thead>

<tbody>

@forelse($categories as $categorie)

<tr>

<td>{{ $categorie->id }}</td>

<td>{{ $categorie->name }}</td>

<td>{{ $categorie->slug }}</td>

<td>

@if($categorie->is_active)
<span class="badge bg-success">Oui</span>
@else
<span class="badge bg-danger">Non</span>
@endif

</td>

<td>{{ $categorie->created_at->format('d/m/Y') }}</td>

<td>

<a href="{{ route('admin.categories.show',$categorie->id) }}"
class="btn btn-info btn-sm">
Voir
</a>

<a href="{{ route('admin.categories.edit',$categorie->id) }}"
class="btn btn-warning btn-sm">
Modifier
</a>

<form action="{{ route('admin.categories.destroy',$categorie->id) }}"
method="POST"
style="display:inline">

@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm"
onclick="return confirm('Supprimer cette catégorie ?')">
Supprimer
</button>

</form>

</td>

</tr>

@empty

<tr>
<td colspan="6">Aucune catégorie trouvée</td>
</tr>

@endforelse

</tbody>

</table>

{{ $categories->links() }}

</div>
</div>

</div>

@endsection