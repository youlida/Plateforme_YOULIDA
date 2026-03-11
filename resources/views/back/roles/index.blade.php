@extends('back.layouts.app')

@section('title','Rôles')

@section('content')

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-3">
<h4>Gestion des rôles</h4>

<a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
Ajouter un rôle
</a>
</div>

@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
{{ session('error') }}
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
<th>Description</th>
<th>Date</th>
<th width="200">Actions</th>
</tr>
</thead>

<tbody>

@forelse($roles as $role)

<tr>

<td>{{ $role->id }}</td>

<td>{{ $role->name }}</td>

<td>{{ $role->slug }}</td>

<td>{{ $role->description }}</td>

<td>{{ $role->created_at->format('d/m/Y') }}</td>

<td>

<a href="{{ route('admin.roles.show',$role->id) }}"
class="btn btn-info btn-sm">
Voir
</a>

<a href="{{ route('admin.roles.edit',$role->id) }}"
class="btn btn-warning btn-sm">
Modifier
</a>

<form action="{{ route('admin.roles.destroy',$role->id) }}"
method="POST"
style="display:inline">

@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm"
onclick="return confirm('Supprimer ce rôle ?')">
Supprimer
</button>

</form>

</td>

</tr>

@empty

<tr>
<td colspan="6">Aucun rôle trouvé</td>
</tr>

@endforelse

</tbody>

</table>

{{ $roles->links() }}

</div>
</div>

</div>

@endsection