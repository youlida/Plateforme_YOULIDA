@extends('back.layouts.app')

@section('title','Modifier programme')

@section('content')

<div class="container">

<h4>Modifier programme</h4>

<div class="card">
<div class="card-body">

<form action="{{ route('admin.programmes.update',$programme->id) }}"
method="POST">

@csrf
@method('PUT')

<div class="mb-3">
<label>Titre</label>

<input type="text"
name="title"
class="form-control"
value="{{ old('title',$programme->title) }}"
required>
</div>

<div class="mb-3">
<label>Image</label>

<input type="text"
name="image"
class="form-control"
value="{{ old('image',$programme->image) }}">
</div>

<div class="mb-3">
<label>Description courte</label>

<textarea name="short_description"
class="form-control"
rows="3">{{ old('short_description',$programme->short_description) }}</textarea>
</div>

<div class="mb-3">
<label>Description</label>

<textarea name="description"
class="form-control"
rows="6"
required>{{ old('description',$programme->description) }}</textarea>
</div>

<div class="mb-3">
<label>Lieu</label>

<input type="text"
name="location"
class="form-control"
value="{{ old('location',$programme->location) }}">
</div>

<div class="mb-3">
<label>Date début</label>

<input type="date"
name="start_date"
class="form-control"
value="{{ old('start_date',$programme->start_date) }}">
</div>

<div class="mb-3">
<label>Date fin</label>

<input type="date"
name="end_date"
class="form-control"
value="{{ old('end_date',$programme->end_date) }}">
</div>

<div class="form-check mb-3">

<input type="checkbox"
name="is_active"
value="1"
class="form-check-input"
{{ $programme->is_active ? 'checked' : '' }}>

<label class="form-check-label">
Activer programme
</label>

</div>

<button class="btn btn-primary">
Mettre à jour
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