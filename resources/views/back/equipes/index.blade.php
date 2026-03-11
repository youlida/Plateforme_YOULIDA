@extends('back.layouts.app')

@section('title','Équipe')

@section('content')

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-3">
<h4>Membres de l’équipe</h4>

<a href="{{ route('admin.equipes.create') }}" class="btn btn-primary">
Ajouter un membre
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
<th>Photo</th>
<th>Nom</th>
<th>Rôle</th>
<th>Date</th>
<th width="200">Actions</th>
</tr>
</thead>

<tbody>

@forelse($equipes as $equipe)

<tr>

<td>{{ $equipe->id }}</td>

<td>
@if($equipe->photo)
<img src="{{ $equipe->photo }}" width="60" class="rounded">
@endif
</td>

<td>{{ $equipe->name }}</td>

<td>{{ $equipe->role }}</td>

<td>{{ $equipe->created_at->format('d/m/Y') }}</td>

<td>

<a href="{{ route('admin.equipes.show',$equipe->id) }}"
class="btn btn-info btn-sm">
Voir
</a>

<a href="{{ route('admin.equipes.edit',$equipe->id) }}"
class="btn btn-warning btn-sm">
Modifier
</a>

<form action="{{ route('admin.equipes.destroy',$equipe->id) }}"
method="POST"
style="display:inline">

@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm"
onclick="return confirm('Supprimer ce membre ?')">
Supprimer
</button>

</form>

</td>

</tr>

@empty

<tr>
<td colspan="6">Aucun membre trouvé</td>
</tr>

@endforelse

</tbody>

</table>

{{ $equipes->links() }}

</div>
</div>

</div>

@endsection