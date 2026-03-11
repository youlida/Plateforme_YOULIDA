@extends('back.layouts.app')

@section('title','Modifier média')

@section('content')

<div class="container">

<h4>Modifier média</h4>

<div class="card">
<div class="card-body">

<form action="{{ route('admin.media.update',$media->id) }}"
method="POST">

@csrf
@method('PUT')

<div class="mb-3">
<label>Titre</label>

<input type="text"
name="title"
class="form-control"
value="{{ old('title',$media->title) }}">
</div>

<div class="mb-3">
<label>Chemin du fichier</label>

<input type="text"
name="file_path"
class="form-control"
value="{{ old('file_path',$media->file_path) }}"
required>
</div>

<div class="mb-3">
<label>Type</label>

<input type="text"
name="type"
class="form-control"
value="{{ old('type',$media->type) }}">
</div>

<button class="btn btn-primary">
Mettre à jour
</button>

<a href="{{ route('admin.media.index') }}"
class="btn btn-secondary">
Retour
</a>

</form>

</div>
</div>

</div>

@endsection