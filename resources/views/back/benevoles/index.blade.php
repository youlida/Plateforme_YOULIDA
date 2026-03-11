@extends('back.layouts.app')

@section('title','Bénévoles')

@section('content')

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-3">
<h4>Liste des bénévoles</h4>

<a href="{{ route('admin.benevoles.create') }}" class="btn btn-primary">
Ajouter un bénévole
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
<th>Approuvé</th>
<th width="200">Actions</th>
</tr>
</thead>

<tbody>

@forelse($benevoles as $benevole)

<tr>

<td>{{ $benevole->id }}</td>

<td>{{ $benevole->name }} {{ $benevole->prenom }}</td>

<td>{{ $benevole->email }}</td>

<td>{{ $benevole->telephone }}</td>

<td>{{ $benevole->pays }}</td>

<td>{{ $benevole->ville }}</td>

<td>
@if($benevole->is_approved)
<span class="badge bg-success">Oui</span>
@else
<span class="badge bg-danger">Non</span>
@endif
</td>

<td>

<a href="{{ route('admin.benevoles.show',$benevole->id) }}"
class="btn btn-info btn-sm">
Voir
</a>

<a href="{{ route('admin.benevoles.edit',$benevole->id) }}"
class="btn btn-warning btn-sm">
Modifier
</a>

<form action="{{ route('admin.benevoles.destroy',$benevole->id) }}"
method="POST"
style="display:inline">

@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm"
onclick="return confirm('Supprimer ce bénévole ?')">
Supprimer
</button>

</form>

</td>

</tr>

@empty

<tr>
<td colspan="8">Aucun bénévole trouvé</td>
</tr>

@endforelse

</tbody>

</table>

{{ $benevoles->links() }}

</div>
</div>

</div>

@endsection