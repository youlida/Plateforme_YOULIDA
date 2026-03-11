@extends('back.layouts.app')

@section('title','Historique')

@section('content')

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-3">
<h4>Historique des actions</h4>
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
<th>Utilisateur</th>
<th>Action</th>
<th>Description</th>
<th>Date</th>
<th width="180">Actions</th>
</tr>
</thead>

<tbody>

@forelse($historiques as $historique)

<tr>

<td>{{ $historique->id }}</td>

<td>
@if($historique->user)
{{ $historique->user->name }}
@else
—
@endif
</td>

<td>{{ $historique->action }}</td>

<td>{{ Str::limit($historique->description,50) }}</td>

<td>{{ $historique->created_at->format('d/m/Y H:i') }}</td>

<td>

<a href="{{ route('admin.historiques.show',$historique->id) }}"
class="btn btn-info btn-sm">
Voir
</a>

<form action="{{ route('admin.historiques.destroy',$historique->id) }}"
method="POST"
style="display:inline">

@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm"
onclick="return confirm('Supprimer cet historique ?')">
Supprimer
</button>

</form>

</td>

</tr>

@empty

<tr>
<td colspan="6">Aucun historique trouvé</td>
</tr>

@endforelse

</tbody>

</table>

{{ $historiques->links() }}

</div>
</div>

</div>

@endsection