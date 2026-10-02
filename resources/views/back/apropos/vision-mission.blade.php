{{-- resources/views/back/apropos/vision-mission.blade.php --}}
@extends('back.layouts.app')

@section('title', 'Vision & Mission - À propos')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">
            <i class="fa-solid fa-eye me-2"></i>
            <i class="fa-solid fa-bullseye me-1"></i>
            Vision & Mission
        </h4>
        <a href="{{ route('admin.apropos.index') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i>
            Retour
        </a>
    </div>

    <div class="row">
        <!-- Vision -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">
                        <i class="fa-solid fa-eye text-primary me-2"></i>
                        Notre Vision
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.apropos.vision.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="vision_title" class="form-label fw-semibold">Titre</label>
                            <input type="text" 
                                   name="title" 
                                   id="vision_title"
                                   class="form-control @error('title') is-invalid @enderror" 
                                   value="{{ old('title', $vision->title ?? 'Notre Vision') }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="vision_content" class="form-label fw-semibold">Contenu</label>
                            <textarea name="content" 
                                      id="vision_content"
                                      class="form-control @error('content') is-invalid @enderror" 
                                      rows="6">{{ old('content', $vision->content ?? '') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="vision_icon" class="form-label fw-semibold">Icône</label>
                                <select name="icon" id="vision_icon" class="form-select">
                                    <option value="Eye" {{ ($vision->icon ?? '') == 'Eye' ? 'selected' : '' }}>Eye (👁️)</option>
                                    <option value="Target" {{ ($vision->icon ?? '') == 'Target' ? 'selected' : '' }}>Target (🎯)</option>
                                    <option value="Heart" {{ ($vision->icon ?? '') == 'Heart' ? 'selected' : '' }}>Heart (❤️)</option>
                                    <option value="Users" {{ ($vision->icon ?? '') == 'Users' ? 'selected' : '' }}>Users (👥)</option>
                                    <option value="Globe" {{ ($vision->icon ?? '') == 'Globe' ? 'selected' : '' }}>Globe (🌍)</option>
                                    <option value="Lightbulb" {{ ($vision->icon ?? '') == 'Lightbulb' ? 'selected' : '' }}>Lightbulb (💡)</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="vision_image" class="form-label fw-semibold">Image</label>
                                <input type="text" 
                                       name="image" 
                                       id="vision_image"
                                       class="form-control" 
                                       value="{{ old('image', $vision->image ?? '/images/vision-image.jpg') }}">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-save me-2"></i>
                                Mettre à jour la vision
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Mission -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">
                        <i class="fa-solid fa-bullseye text-success me-2"></i>
                        Notre Mission
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.apropos.mission.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="mission_title" class="form-label fw-semibold">Titre</label>
                            <input type="text" 
                                   name="title" 
                                   id="mission_title"
                                   class="form-control @error('title') is-invalid @enderror" 
                                   value="{{ old('title', $mission->title ?? 'Notre Mission') }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="mission_content" class="form-label fw-semibold">Contenu</label>
                            <textarea name="content" 
                                      id="mission_content"
                                      class="form-control @error('content') is-invalid @enderror" 
                                      rows="6">{{ old('content', $mission->content ?? '') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="mission_icon" class="form-label fw-semibold">Icône</label>
                                <select name="icon" id="mission_icon" class="form-select">
                                    <option value="Target" {{ ($mission->icon ?? '') == 'Target' ? 'selected' : '' }}>Target (🎯)</option>
                                    <option value="Eye" {{ ($mission->icon ?? '') == 'Eye' ? 'selected' : '' }}>Eye (👁️)</option>
                                    <option value="Heart" {{ ($mission->icon ?? '') == 'Heart' ? 'selected' : '' }}>Heart (❤️)</option>
                                    <option value="Users" {{ ($mission->icon ?? '') == 'Users' ? 'selected' : '' }}>Users (👥)</option>
                                    <option value="Globe" {{ ($mission->icon ?? '') == 'Globe' ? 'selected' : '' }}>Globe (🌍)</option>
                                    <option value="Lightbulb" {{ ($mission->icon ?? '') == 'Lightbulb' ? 'selected' : '' }}>Lightbulb (💡)</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="mission_image" class="form-label fw-semibold">Image</label>
                                <input type="text" 
                                       name="image" 
                                       id="mission_image"
                                       class="form-control" 
                                       value="{{ old('image', $mission->image ?? '/images/mission-image.jpg') }}">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">
                                <i class="fa-solid fa-save me-2"></i>
                                Mettre à jour la mission
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection