@extends('back.layouts.app')

@section('title','Créer témoignage')

@section('content')

<div class="container">

<h4>Créer un témoignage</h4>

<div class="card">
<div class="card-body">

<form action="{{ route('admin.temoignages.store') }}" method="POST">

@csrf

<div class="mb-3">
<label>Nom</label>
<input type="text"
name="name"
class="form-control"
value="{{ old('name') }}"
required>
</div>

<div class="mb-3">
<label>Email</label>
<input type="email"
name="email"
class="form-control"
value="{{ old('email') }}">
</div>

<div class="mb-3">
<label>Photo (URL)</label>
<input type="text"
name="photo"
class="form-control"
value="{{ old('photo') }}">
</div>

<div class="mb-3">
<label>Message</label>
<textarea name="message"
class="form-control"
rows="4"
required>{{ old('message') }}</textarea>
</div>

<div class="form-check mb-3">
<input type="checkbox"
name="is_published"
value="1"
class="form-check-input">

<label class="form-check-label">
Publier
</label>
</div>

<button class="btn btn-success">
Enregistrer
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