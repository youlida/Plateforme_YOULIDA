@extends('back.layouts.app')

@section('title','Témoignages')

@section('content')

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-3">
<h4>Témoignages</h4>

<a href="{{ route('admin.temoignages.create') }}" class="btn btn-primary">
Ajouter un témoignage
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
<th>Publié</th>
<th>Date</th>
<th width="200">Actions</th>
</tr>
</thead>

<tbody>

@forelse($temoignages as $temoignage)

<tr>

<td>{{ $temoignage->id }}</td>

<td>{{ $temoignage->name }}</td>

<td>{{ $temoignage->email }}</td>

<td>
@if($temoignage->is_published)
<span class="badge bg-success">Oui</span>
@else
<span class="badge bg-danger">Non</span>
@endif
</td>

<td>{{ $temoignage->created_at->format('d/m/Y') }}</td>

<td>

<a href="{{ route('admin.temoignages.show',$temoignage->id) }}"
class="btn btn-info btn-sm">
Voir
</a>

<a href="{{ route('admin.temoignages.edit',$temoignage->id) }}"
class="btn btn-warning btn-sm">
Modifier
</a>

<form action="{{ route('admin.temoignages.destroy',$temoignage->id) }}"
method="POST"
style="display:inline">

@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm"
onclick="return confirm('Supprimer ce témoignage ?')">
Supprimer
</button>

</form>

</td>

</tr>

@empty

<tr>
<td colspan="6">Aucun témoignage trouvé</td>
</tr>

@endforelse

</tbody>

</table>

{{ $temoignages->links() }}

</div>
</div>

</div>

@endsection