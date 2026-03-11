@extends('back.layouts.app')

@section('title','Créer programme')

@section('content')

<div class="container">

<h4>Créer un programme</h4>

<div class="card">
<div class="card-body">

<form action="{{ route('admin.programmes.store') }}" method="POST">

@csrf

<div class="mb-3">
<label>Titre</label>

<input type="text"
name="title"
class="form-control"
value="{{ old('title') }}"
required>
</div>

<div class="mb-3">
<label>Image (URL)</label>

<input type="text"
name="image"
class="form-control"
value="{{ old('image') }}">
</div>

<div class="mb-3">
<label>Description courte</label>

<textarea name="short_description"
class="form-control"
rows="3">{{ old('short_description') }}</textarea>
</div>

<div class="mb-3">
<label>Description</label>

<textarea name="description"
class="form-control"
rows="6"
required>{{ old('description') }}</textarea>
</div>

<div class="mb-3">
<label>Lieu</label>

<input type="text"
name="location"
class="form-control"
value="{{ old('location') }}">
</div>

<div class="mb-3">
<label>Date début</label>

<input type="date"
name="start_date"
class="form-control"
value="{{ old('start_date') }}">
</div>

<div class="mb-3">
<label>Date fin</label>

<input type="date"
name="end_date"
class="form-control"
value="{{ old('end_date') }}">
</div>

<div class="form-check mb-3">

<input type="checkbox"
name="is_active"
value="1"
class="form-check-input">

<label class="form-check-label">
Activer programme
</label>

</div>

<button class="btn btn-success">
Enregistrer
</button>

<a href="{{ route('admin.programmes.index') }}"
class="btn btn-secondary">
Retour
</a>

</form>

</div>
</div>

</div>

@endsection