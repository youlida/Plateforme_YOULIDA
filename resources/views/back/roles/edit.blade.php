@extends('back.layouts.app')

@section('title','Modifier rôle')

@section('content')

<div class="container">

<h4>Modifier rôle</h4>

<div class="card">
<div class="card-body">

<form action="{{ route('admin.roles.update',$role->id) }}"
method="POST">

@csrf
@method('PUT')

<div class="mb-3">

<label>Nom</label>

<input type="text"
name="name"
class="form-control"
value="{{ old('name',$role->name) }}"
required>

</div>

<div class="mb-3">

<label>Slug</label>

<input type="text"
name="slug"
class="form-control"
value="{{ old('slug',$role->slug) }}">

</div>

<div class="mb-3">

<label>Description</label>

<textarea name="description"
class="form-control"
rows="4">{{ old('description',$role->description) }}</textarea>

</div>

<button class="btn btn-primary">
Mettre à jour
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