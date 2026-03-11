@extends('back.layouts.app')

@section('title','Modifier rapport')

@section('content')

<div class="container">

<h4>Modifier rapport</h4>

<div class="card">
<div class="card-body">

<form action="{{ route('admin.rapports.update',$rapport->id) }}"
method="POST">

@csrf
@method('PUT')

<div class="mb-3">

<label>Titre</label>

<input type="text"
name="title"
class="form-control"
value="{{ old('title',$rapport->title) }}"
required>

</div>

<div class="mb-3">

<label>Description</label>

<textarea name="description"
class="form-control"
rows="4">{{ old('description',$rapport->description) }}</textarea>

</div>

<div class="mb-3">

<label>Fichier</label>

<input type="text"
name="file"
class="form-control"
value="{{ old('file',$rapport->file) }}">

</div>

<div class="mb-3">

<label>Date rapport</label>

<input type="date"
name="report_date"
class="form-control"
value="{{ old('report_date',$rapport->report_date) }}">

</div>

<button class="btn btn-primary">
Mettre à jour
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