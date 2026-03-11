@extends('back.layouts.app')

@section('title','Pages')

@section('content')

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-3">
<h4>Pages du site</h4>

<a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
Créer une page
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
<th>Slug</th>
<th>Publié</th>
<th>Date</th>
<th width="200">Actions</th>
</tr>
</thead>

<tbody>

@forelse($pages as $page)

<tr>

<td>{{ $page->id }}</td>

<td>{{ $page->title }}</td>

<td>{{ $page->slug }}</td>

<td>
@if($page->is_published)
<span class="badge bg-success">Oui</span>
@else
<span class="badge bg-secondary">Non</span>
@endif
</td>

<td>{{ $page->created_at->format('d/m/Y') }}</td>

<td>

<a href="{{ route('admin.pages.show',$page->id) }}"
class="btn btn-info btn-sm">
Voir
</a>

<a href="{{ route('admin.pages.edit',$page->id) }}"
class="btn btn-warning btn-sm">
Modifier
</a>

<form action="{{ route('admin.pages.destroy',$page->id) }}"
method="POST"
style="display:inline">

@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm"
onclick="return confirm('Supprimer cette page ?')">
Supprimer
</button>

</form>

</td>

</tr>

@empty

<tr>
<td colspan="6">Aucune page trouvée</td>
</tr>

@endforelse

</tbody>

</table>

{{ $pages->links() }}

</div>
</div>

</div>

@endsection