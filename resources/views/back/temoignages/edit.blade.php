@extends('back.layouts.app')

@section('title','Modifier témoignage')

@section('content')

<div class="container">

<h4>Modifier témoignage</h4>

<div class="card">
<div class="card-body">

<form action="{{ route('admin.temoignages.update',$temoignage->id) }}"
method="POST">

@csrf
@method('PUT')

<div class="mb-3">
<label>Nom</label>

<input type="text"
name="name"
class="form-control"
value="{{ old('name',$temoignage->name) }}"
required>
</div>

<div class="mb-3">
<label>Email</label>

<input type="email"
name="email"
class="form-control"
value="{{ old('email',$temoignage->email) }}">
</div>

<div class="mb-3">
<label>Photo</label>

<input type="text"
name="photo"
class="form-control"
value="{{ old('photo',$temoignage->photo) }}">
</div>

<div class="mb-3">
<label>Message</label>

<textarea name="message"
class="form-control"
rows="4"
required>{{ old('message',$temoignage->message) }}</textarea>
</div>

<div class="form-check mb-3">

<input type="checkbox"
name="is_published"
value="1"
class="form-check-input"
{{ $temoignage->is_published ? 'checked' : '' }}>

<label class="form-check-label">
Publier
</label>

</div>

<button class="btn btn-primary">
Mettre à jour
</button>

<a href="{{ route('admin.temoignages.index') }}"
class="btn btn-secondary">
Retour
</a>

</form>

</div>
</div>

</div>

@endsection