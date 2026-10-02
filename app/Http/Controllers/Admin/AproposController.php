<?php
// app/Http/Controllers/Admin/AproposController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutContent;
use App\Models\AboutValue;
use App\Models\AboutStat;
use App\Models\Equipe;
use App\Models\Partenaire;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AproposController extends Controller
{
    /**
     * Affiche la vue principale de gestion de la page À propos
     */
    public function index()
    {
        $hero = AboutContent::where('section', 'hero')->first();
        $vision = AboutContent::where('section', 'vision')->first();
        $mission = AboutContent::where('section', 'mission')->first();

        // Valeurs - avec gestion d'erreur
        try {
            $valeurs = AboutValue::orderBy('order')->get();
        } catch (\Exception $e) {
            $valeurs = AboutValue::orderBy('created_at', 'desc')->get();
        }

        // Statistiques - avec gestion d'erreur
        try {
            $stats = AboutStat::orderBy('order')->get();
        } catch (\Exception $e) {
            $stats = AboutStat::orderBy('created_at', 'desc')->get();
        }

        // Équipe - tri par date de création (pas de colonne order)
        $equipe = Equipe::orderBy('created_at', 'desc')->get();

        // Partenaires - tri par date de création (pas de colonne order)
        $partenaires = Partenaire::orderBy('created_at', 'desc')->get();

        return view('back.apropos.index', compact(
            'hero',
            'vision',
            'mission',
            'valeurs',
            'stats',
            'equipe',
            'partenaires'
        ));
    }

    // ==================== HERO SECTION ====================
    public function editHero()
    {
        $hero = AboutContent::firstOrCreate(
            ['section' => 'hero'],
            [
                'title' => 'À propos de YOULIDA',
                'subtitle' => "Young Leader's Initiatives for Development of sub-Saharan Africa",
                'badge' => 'Ensemble pour la jeunesse africaine',
                'description' => "YOULIDA aide les adolescents et jeunes africains à prendre des décisions éclairées sur leur vie éducative, sexuelle, leur bien-être et leur santé.",
                'primary_button_text' => 'Rejoignez-nous',
                'primary_button_link' => '/s-impliquer',
                'secondary_button_text' => 'Découvrir nos actions',
                'secondary_button_link' => '/nos-actions',
                'image' => '/images/hero-african-youth.jpg',
                'image_alt' => 'Jeunes africains engagés'
            ]
        );
        return view('back.apropos.hero', compact('hero'));
    }

    public function updateHero(Request $request)
    {
        $hero = AboutContent::where('section', 'hero')->first();

        $data = $request->validate([
            'badge' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'primary_button_text' => 'nullable|string|max:100',
            'primary_button_link' => 'nullable|string|max:255',
            'secondary_button_text' => 'nullable|string|max:100',
            'secondary_button_link' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:255',
            'image_alt' => 'nullable|string|max:255',
        ]);

        $hero->update($data);
        return redirect()->route('admin.apropos.index')->with('success', 'Section héro modifiée avec succès.');
    }

    // ==================== VISION & MISSION ====================
    public function editVision()
    {
        $vision = AboutContent::firstOrCreate(
            ['section' => 'vision'],
            [
                'title' => 'Notre Vision',
                'content' => "Engager les jeunes africains à être des acteurs de changement pour eux-mêmes et leurs communautés. Nous croyons en un avenir où chaque jeune africain a les connaissances, les compétences et la confiance nécessaires pour réaliser son plein potentiel.",
                'icon' => 'Eye',
                'image' => '/images/vision-image.jpg'
            ]
        );

        $mission = AboutContent::firstOrCreate(
            ['section' => 'mission'],
            [
                'title' => 'Notre Mission',
                'content' => "Permettre aux adolescents et jeunes africains de prendre des décisions éclairées sur leur vie éducative, sexuelle, leur bien-être et leur santé. À travers des programmes innovants et une approche communautaire, nous offrons aux jeunes les outils et le soutien dont ils ont besoin.",
                'icon' => 'Target',
                'image' => '/images/mission-image.jpg'
            ]
        );

        return view('back.apropos.vision-mission', compact('vision', 'mission'));
    }

    public function updateVision(Request $request)
    {
        $vision = AboutContent::where('section', 'vision')->first();

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'icon' => 'nullable|string|max:50',
            'image' => 'nullable|string|max:255',
        ]);

        $vision->update($data);
        return redirect()->route('admin.apropos.index')->with('success', 'Vision modifiée avec succès.');
    }

    public function updateMission(Request $request)
    {
        $mission = AboutContent::where('section', 'mission')->first();

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'icon' => 'nullable|string|max:50',
            'image' => 'nullable|string|max:255',
        ]);

        $mission->update($data);
        return redirect()->route('admin.apropos.index')->with('success', 'Mission modifiée avec succès.');
    }

    // ==================== VALEURS ====================
    public function indexValeurs()
    {
        $valeurs = AboutValue::orderBy('order')->get();
        return view('back.apropos.valeurs.index', compact('valeurs'));
    }

    public function createValeur()
    {
        return view('back.apropos.valeurs.create');
    }

    public function storeValeur(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|string|max:50',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $data['order'] = $data['order'] ?? AboutValue::max('order') + 1;
        $data['is_active'] = $request->boolean('is_active', true);

        AboutValue::create($data);
        return redirect()->route('admin.apropos.valeurs.index')->with('success', 'Valeur créée avec succès.');
    }

    public function editValeur(AboutValue $valeur)
    {
        return view('back.apropos.valeurs.edit', compact('valeur'));
    }

    public function updateValeur(Request $request, AboutValue $valeur)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|string|max:50',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);
        $valeur->update($data);

        return redirect()->route('admin.apropos.valeurs.index')->with('success', 'Valeur modifiée avec succès.');
    }

    public function destroyValeur(AboutValue $valeur)
    {
        $valeur->delete();
        return redirect()->route('admin.apropos.valeurs.index')->with('success', 'Valeur supprimée avec succès.');
    }

    // ==================== STATISTIQUES ====================
    public function indexStats()
    {
        $stats = AboutStat::orderBy('order')->get();
        return view('back.apropos.stats.index', compact('stats'));
    }

    public function createStat()
    {
        return view('back.apropos.stats.create');
    }

    public function storeStat(Request $request)
    {
        $data = $request->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|string|max:50',
            'icon' => 'nullable|string|max:50',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $data['order'] = $data['order'] ?? AboutStat::max('order') + 1;
        $data['is_active'] = $request->boolean('is_active', true);

        AboutStat::create($data);
        return redirect()->route('admin.apropos.stats.index')->with('success', 'Statistique créée avec succès.');
    }

    public function editStat(AboutStat $stat)
    {
        return view('back.apropos.stats.edit', compact('stat'));
    }

    public function updateStat(Request $request, AboutStat $stat)
    {
        $data = $request->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|string|max:50',
            'icon' => 'nullable|string|max:50',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);
        $stat->update($data);

        return redirect()->route('admin.apropos.stats.index')->with('success', 'Statistique modifiée avec succès.');
    }

    public function destroyStat(AboutStat $stat)
    {
        $stat->delete();
        return redirect()->route('admin.apropos.stats.index')->with('success', 'Statistique supprimée avec succès.');
    }
}
