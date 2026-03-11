@extends('back.layouts.app')

@section('title','Ajouter abonné')

@section('content')

<div class="container">

    <h4>Ajouter un abonné</h4>

    <form action="{{ route('admin.newsletters.store') }}" method="POST">

        @csrf

        <div class="mb-3">
            <label>Email</label>

            <input type="email"
                   name="email"
                   class="form-control"
                   value="{{ old('email') }}"
                   required>

            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">

            <label>
                <input type="checkbox" name="is_active" value="1">
                Actif
            </label>

        </div>

        <button class="btn btn-success">
            Enregistrer
        </button>

        <a href="{{ route('admin.newsletters.index') }}"
           class="btn btn-secondary">
            Retour
        </a>

    </form>

</div>

@endsection