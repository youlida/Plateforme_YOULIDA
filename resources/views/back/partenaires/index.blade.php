@extends('back.layouts.app')

@section('title','Partenaires')

@section('content')

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-3">
<h4>Liste des partenaires</h4>

<a href="{{ route('admin.partenaires.create') }}" class="btn btn-primary">
Ajouter un partenaire
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
<th>Logo</th>
<th>Nom</th>
<th>Site web</th>
<th>Actif</th>
<th width="200">Actions</th>
</tr>
</thead>

<tbody>

@forelse($partenaires as $partenaire)

<tr>

<td>{{ $partenaire->id }}</td>

<td>
@if($partenaire->logo)
<img src="{{ $partenaire->logo }}" width="60" class="rounded">
@endif
</td>

<td>{{ $partenaire->name }}</td>

<td>
@if($partenaire->website)
<a href="{{ $partenaire->website }}" target="_blank">
{{ $partenaire->website }}
</a>
@endif
</td>

<td>
@if($partenaire->is_active)
<span class="badge bg-success">Oui</span>
@else
<span class="badge bg-secondary">Non</span>
@endif
</td>

<td>

<a href="{{ route('admin.partenaires.show',$partenaire->id) }}"
class="btn btn-info btn-sm">
Voir
</a>

<a href="{{ route('admin.partenaires.edit',$partenaire->id) }}"
class="btn btn-warning btn-sm">
Modifier
</a>

<form action="{{ route('admin.partenaires.destroy',$partenaire->id) }}"
method="POST"
style="display:inline">

@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm"
onclick="return confirm('Supprimer ce partenaire ?')">
Supprimer
</button>

</form>

</td>

</tr>

@empty

<tr>
<td colspan="6">Aucun partenaire trouvé</td>
</tr>

@endforelse

</tbody>

</table>

{{ $partenaires->links() }}

</div>
</div>

</div>

@endsection