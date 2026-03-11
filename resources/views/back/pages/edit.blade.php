@extends('back.layouts.app')

@section('title','Modifier page')

@section('content')

<div class="container">

<h4>Modifier page</h4>

<div class="card">
<div class="card-body">

<form action="{{ route('admin.pages.update',$page->id) }}"
method="POST">

@csrf
@method('PUT')

<div class="mb-3">

<label>Titre</label>

<input type="text"
name="title"
class="form-control"
value="{{ old('title',$page->title) }}"
required>

</div>

<div class="mb-3">

<label>Contenu</label>

<textarea name="content"
class="form-control"
rows="8"
required>{{ old('content',$page->content) }}</textarea>

</div>

<div class="form-check mb-3">

<input type="checkbox"
name="is_published"
value="1"
class="form-check-input"
{{ $page->is_published ? 'checked' : '' }}>

<label class="form-check-label">
Publier la page
</label>

</div>

<button class="btn btn-primary">
Mettre à jour
</button>

<a href="{{ route('admin.pages.index') }}"
class="btn btn-secondary">
Retour
</a>

</form>

</div>
</div>

</div>

@endsection