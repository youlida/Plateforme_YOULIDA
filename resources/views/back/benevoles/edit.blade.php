@extends('back.layouts.app')

@section('title','Modifier bénévole')

@section('content')

<div class="container">

<h4>Modifier bénévole</h4>

<div class="card">
<div class="card-body">

<form action="{{ route('admin.benevoles.update',$benevole->id) }}"
method="POST">

@csrf
@method('PUT')

<div class="mb-3">
<label>Nom</label>
<input type="text"
name="name"
class="form-control"
value="{{ old('name',$benevole->name) }}"
required>
</div>

<div class="mb-3">
<label>Prénom</label>
<input type="text"
name="prenom"
class="form-control"
value="{{ old('prenom',$benevole->prenom) }}">
</div>

<div class="mb-3">
<label>Email</label>
<input type="email"
name="email"
class="form-control"
value="{{ old('email',$benevole->email) }}">
</div>

<div class="mb-3">
<label>Téléphone</label>
<input type="text"
name="telephone"
class="form-control"
value="{{ old('telephone',$benevole->telephone) }}">
</div>

<div class="mb-3">
<label>Pays</label>
<input type="text"
name="pays"
class="form-control"
value="{{ old('pays',$benevole->pays) }}">
</div>

<div class="mb-3">
<label>Ville</label>
<input type="text"
name="ville"
class="form-control"
value="{{ old('ville',$benevole->ville) }}">
</div>

<div class="mb-3">
<label>Motivation</label>
<textarea name="motivation"
class="form-control"
rows="4">{{ old('motivation',$benevole->motivation) }}</textarea>
</div>

<div class="form-check mb-3">

<input type="checkbox"
name="is_approved"
value="1"
class="form-check-input"
{{ $benevole->is_approved ? 'checked' : '' }}>

<label class="form-check-label">
Approuver
</label>

</div>

<button class="btn btn-primary">
Mettre à jour
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