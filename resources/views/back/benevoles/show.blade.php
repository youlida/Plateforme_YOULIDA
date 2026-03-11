@extends('back.layouts.app')

@section('title','Créer bénévole')

@section('content')

<div class="container">

<h4>Créer un bénévole</h4>

<div class="card">
<div class="card-body">

<form action="{{ route('admin.benevoles.store') }}" method="POST">

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
<label>Prénom</label>
<input type="text"
name="prenom"
class="form-control"
value="{{ old('prenom') }}">
</div>

<div class="mb-3">
<label>Email</label>
<input type="email"
name="email"
class="form-control"
value="{{ old('email') }}">
</div>

<div class="mb-3">
<label>Téléphone</label>
<input type="text"
name="telephone"
class="form-control"
value="{{ old('telephone') }}">
</div>

<div class="mb-3">
<label>Pays</label>
<input type="text"
name="pays"
class="form-control"
value="{{ old('pays') }}">
</div>

<div class="mb-3">
<label>Ville</label>
<input type="text"
name="ville"
class="form-control"
value="{{ old('ville') }}">
</div>

<div class="mb-3">
<label>Motivation</label>
<textarea name="motivation"
class="form-control"
rows="4">{{ old('motivation') }}</textarea>
</div>

<div class="form-check mb-3">

<input type="checkbox"
name="is_approved"
value="1"
class="form-check-input">

<label class="form-check-label">
Approuver ce bénévole
</label>

</div>

<button class="btn btn-success">
Enregistrer
</button>

<a href="{{ route('admin.benevoles.index') }}"
class="btn btn-secondary">
Retour
</a>

</form>

</div>
</div>

</div>

@endsection