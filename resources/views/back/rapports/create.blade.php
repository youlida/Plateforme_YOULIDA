@extends('back.layouts.app')

@section('title','Créer rapport')

@section('content')

<div class="container">

<h4>Créer un rapport</h4>

<div class="card">
<div class="card-body">

<form action="{{ route('admin.rapports.store') }}" method="POST">

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
<label>Description</label>

<textarea name="description"
class="form-control"
rows="4">{{ old('description') }}</textarea>
</div>

<div class="mb-3">
<label>Fichier (URL)</label>

<input type="text"
name="file"
class="form-control"
value="{{ old('file') }}">
</div>

<div class="mb-3">
<label>Date du rapport</label>

<input type="date"
name="report_date"
class="form-control"
value="{{ old('report_date') }}">
</div>

<button class="btn btn-success">
Enregistrer
</button>

<a href="{{ route('admin.rapports.index') }}"
class="btn btn-secondary">
Retour
</a>

</form>

</div>
</div>

</div>

@endsection