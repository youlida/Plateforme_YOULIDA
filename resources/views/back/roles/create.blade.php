@extends('back.layouts.app')

@section('title','Créer rôle')

@section('content')

<div class="container">

<h4>Créer un rôle</h4>

<div class="card">
<div class="card-body">

<form action="{{ route('admin.roles.store') }}" method="POST">

@csrf

<div class="mb-3">

<label>Nom</label>

<input type="text"
name="name"
class="form-control"
value="{{ old('name') }}"
required>

@error('name')
<small class="text-danger">{{ $message }}</small>
@enderror

</div>

<div class="mb-3">

<label>Slug</label>

<input type="text"
name="slug"
class="form-control"
value="{{ old('slug') }}">

</div>

<div class="mb-3">

<label>Description</label>

<textarea name="description"
class="form-control"
rows="4">{{ old('description') }}</textarea>

</div>

<button class="btn btn-success">
Enregistrer
</button>

<a href="{{ route('admin.roles.index') }}"
class="btn btn-secondary">
Retour
</a>

</form>

</div>
</div>

</div>

@endsection