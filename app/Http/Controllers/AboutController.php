<?php
// app/Http/Controllers/AboutController.php

namespace App\Http\Controllers;

use App\Models\AboutContent;
use App\Models\AboutValue;
use App\Models\Equipe;
use App\Models\Partenaire;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $hero = AboutContent::where('section', 'hero')->where('is_active', true)->first();
        $vision = AboutContent::where('section', 'vision')->where('is_active', true)->first();
        $mission = AboutContent::where('section', 'mission')->where('is_active', true)->first();
        
        $values = AboutValue::where('is_active', true)->orderBy('order')->get();
        
        // Utiliser vos modèles existants
        $equipe = Equipe::where('is_active', true)->orderBy('order')->get();
        $partenaires = Partenaire::where('is_active', true)->orderBy('order')->get();

        return view('welcome', compact('hero', 'vision', 'mission', 'values', 'equipe', 'partenaires'));
    }
}






