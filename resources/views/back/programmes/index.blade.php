@extends('back.layouts.app')

@section('title','Programmes')

@section('content')

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-3">
<h4>Programmes</h4>

<a href="{{ route('admin.programmes.create') }}" class="btn btn-primary">
Ajouter programme
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
<th>Image</th>
<th>Titre</th>
<th>Lieu</th>
<th>Début</th>
<th>Fin</th>
<th>Actif</th>
<th width="200">Actions</th>
</tr>
</thead>

<tbody>

@forelse($programmes as $programme)

<tr>

<td>{{ $programme->id }}</td>

<td>
@if($programme->image)
<img src="{{ $programme->image }}" width="70" class="rounded">
@endif
</td>

<td>{{ $programme->title }}</td>

<td>{{ $programme->location }}</td>

<td>{{ $programme->start_date }}</td>

<td>{{ $programme->end_date }}</td>

<td>
@if($programme->is_active)
<span class="badge bg-success">Oui</span>
@else
<span class="badge bg-secondary">Non</span>
@endif
</td>

<td>

<a href="{{ route('admin.programmes.show',$programme->id) }}"
class="btn btn-info btn-sm">
Voir
</a>

<a href="{{ route('admin.programmes.edit',$programme->id) }}"
class="btn btn-warning btn-sm">
Modifier
</a>

<form action="{{ route('admin.programmes.destroy',$programme->id) }}"
method="POST"
style="display:inline">

@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm"
onclick="return confirm('Supprimer ce programme ?')">
Supprimer
</button>

</form>

</td>

</tr>

@empty

<tr>
<td colspan="8">Aucun programme trouvé</td>
</tr>

@endforelse

</tbody>

</table>

{{ $programmes->links() }}

</div>
</div>

</div>

@endsection