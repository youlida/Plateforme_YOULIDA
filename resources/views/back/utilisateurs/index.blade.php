@extends('back.layouts.app')

@section('title','Utilisateurs')

@section('content')

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-3">
<h4>Liste des utilisateurs</h4>

<a href="{{ route('admin.utilisateurs.create') }}" class="btn btn-primary">
Ajouter utilisateur
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
<th>Email</th>
<th>Téléphone</th>
<th>Pays</th>
<th>Ville</th>
<th>Rôle</th>
<th>Actif</th>
<th width="220">Actions</th>
</tr>
</thead>

<tbody>

@forelse($users as $user)

<tr>

<td>{{ $user->id }}</td>

<td>
{{ $user->name }} {{ $user->prenom }}
</td>

<td>{{ $user->email }}</td>

<td>{{ $user->telephone }}</td>

<td>{{ $user->pays }}</td>

<td>{{ $user->ville }}</td>

<td>
@if($user->role)
<span class="badge bg-primary">
{{ $user->role->name }}
</span>
@endif
</td>

<td>
@if($user->is_active)
<span class="badge bg-success">Actif</span>
@else
<span class="badge bg-danger">Bloqué</span>
@endif
</td>

<td>

<a href="{{ route('admin.utilisateurs.show',$user->id) }}"
class="btn btn-info btn-sm">
Voir
</a>

<a href="{{ route('admin.utilisateurs.edit',$user->id) }}"
class="btn btn-warning btn-sm">
Modifier
</a>

<form action="{{ route('admin.utilisateurs.destroy',$user->id) }}"
method="POST"
style="display:inline">

@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm"
onclick="return confirm('Supprimer cet utilisateur ?')">
Supprimer
</button>

</form>

</td>

</tr>

@empty

<tr>
<td colspan="9">Aucun utilisateur trouvé</td>
</tr>

@endforelse

</tbody>

</table>

{{ $users->links() }}

</div>
</div>

</div>

@endsection