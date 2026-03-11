@extends('back.layouts.app')

@section('title','Messages contact')

@section('content')

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-3">
<h4>Messages reçus</h4>

<a href="{{ route('admin.contacts.create') }}" class="btn btn-primary">
Ajouter message
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
<th>Sujet</th>
<th>Lu</th>
<th>Date</th>
<th width="200">Actions</th>
</tr>
</thead>

<tbody>

@forelse($contacts as $contact)

<tr>

<td>{{ $contact->id }}</td>

<td>{{ $contact->name }}</td>

<td>{{ $contact->email }}</td>

<td>{{ $contact->subject }}</td>

<td>

@if($contact->is_read)
<span class="badge bg-success">Lu</span>
@else
<span class="badge bg-warning">Non lu</span>
@endif

</td>

<td>{{ $contact->created_at->format('d/m/Y') }}</td>

<td>

<a href="{{ route('admin.contacts.show',$contact->id) }}"
class="btn btn-info btn-sm">
Voir
</a>

<a href="{{ route('admin.contacts.edit',$contact->id) }}"
class="btn btn-warning btn-sm">
Modifier
</a>

<form action="{{ route('admin.contacts.destroy',$contact->id) }}"
method="POST"
style="display:inline">

@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm"
onclick="return confirm('Supprimer ce message ?')">
Supprimer
</button>

</form>

</td>

</tr>

@empty

<tr>
<td colspan="7">Aucun message trouvé</td>
</tr>

@endforelse

</tbody>

</table>

{{ $contacts->links() }}

</div>
</div>

</div>

@endsection