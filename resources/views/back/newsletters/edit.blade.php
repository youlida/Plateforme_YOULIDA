@extends('back.layouts.app')

@section('title','Modifier abonné')

@section('content')

<div class="container">

    <h4>Modifier abonné</h4>

    <form action="{{ route('admin.newsletters.update',$abonneNewsletter->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">

            <label>Email</label>

            <input type="email"
                   name="email"
                   class="form-control"
                   value="{{ old('email',$abonneNewsletter->email) }}"
                   required>

            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror

        </div>

        <div class="mb-3">

            <label>
                <input type="checkbox"
                       name="is_active"
                       value="1"
                       {{ $abonneNewsletter->is_active ? 'checked' : '' }}>
                Actif
            </label>

        </div>

        <button class="btn btn-primary">
            Mettre à jour
        </button>

        <a href="{{ route('admin.newsletters.index') }}"
           class="btn btn-secondary">
            Retour
        </a>

    </form>

</div>

@endsection