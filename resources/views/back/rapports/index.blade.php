@extends('back.layouts.app')

@section('title','Rapports')

@section('content')

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-3">
<h4>Rapports</h4>

<a href="{{ route('admin.rapports.create') }}" class="btn btn-primary">
Ajouter un rapport
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
<th>Titre</th>
<th>Date rapport</th>
<th>Fichier</th>
<th width="200">Actions</th>
</tr>
</thead>

<tbody>

@forelse($rapports as $rapport)

<tr>

<td>{{ $rapport->id }}</td>

<td>{{ $rapport->title }}</td>

<td>{{ $rapport->report_date }}</td>

<td>
@if($rapport->file)
<a href="{{ $rapport->file }}" target="_blank">
Voir fichier
</a>
@endif
</td>

<td>

<a href="{{ route('admin.rapports.show',$rapport->id) }}"
class="btn btn-info btn-sm">
Voir
</a>

<a href="{{ route('admin.rapports.edit',$rapport->id) }}"
class="btn btn-warning btn-sm">
Modifier
</a>

<form action="{{ route('admin.rapports.destroy',$rapport->id) }}"
method="POST"
style="display:inline">

@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm"
onclick="return confirm('Supprimer ce rapport ?')">
Supprimer
</button>

</form>

</td>

</tr>

@empty

<tr>
<td colspan="5">Aucun rapport trouvé</td>
</tr>

@endforelse

</tbody>

</table>

{{ $rapports->links() }}

</div>
</div>

</div>

@endsection