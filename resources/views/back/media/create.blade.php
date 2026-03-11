@extends('back.layouts.app')

@section('title','Médias')

@section('content')

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-3">
<h4>Bibliothèque des médias</h4>

<a href="{{ route('admin.media.create') }}" class="btn btn-primary">
Ajouter média
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
<th>Fichier</th>
<th>Type</th>
<th>Date</th>
<th width="200">Actions</th>
</tr>
</thead>

<tbody>

@forelse($media as $item)

<tr>

<td>{{ $item->id }}</td>

<td>{{ $item->title }}</td>

<td>
<a href="{{ $item->file_path }}" target="_blank">
Voir fichier
</a>
</td>

<td>{{ $item->type }}</td>

<td>{{ $item->created_at->format('d/m/Y') }}</td>

<td>

<a href="{{ route('admin.media.show',$item->id) }}"
class="btn btn-info btn-sm">
Voir
</a>

<a href="{{ route('admin.media.edit',$item->id) }}"
class="btn btn-warning btn-sm">
Modifier
</a>

<form action="{{ route('admin.media.destroy',$item->id) }}"
method="POST"
style="display:inline">

@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm"
onclick="return confirm('Supprimer ce média ?')">
Supprimer
</button>

</form>

</td>

</tr>

@empty

<tr>
<td colspan="6">Aucun média trouvé</td>
</tr>

@endforelse

</tbody>

</table>

{{ $media->links() }}

</div>
</div>

</div>

@endsection