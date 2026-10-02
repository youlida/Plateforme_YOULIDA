<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Programme;
use App\Models\Temoignage;
use App\Models\Partenaire;
use App\Models\Equipe;
use App\Models\Page;
use App\Models\Categorie;
use App\Models\AboutContent;
use App\Models\AboutValue;
use App\Models\AboutStat;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    /**
     * Page d'accueil
     */
    public function home()
    {
        $articles = Article::latest()->take(3)->get();
        $programmes = Programme::latest()->take(4)->get();
        $temoignages = Temoignage::latest()->take(3)->get();
        $partenaires = Partenaire::all();
        $equipe = Equipe::all();

        return view('welcome', compact(
            'articles',
            'programmes',
            'temoignages',
            'partenaires',
            'equipe'
        ));
    }

    /**
     * Page À propos
     */
//    public function about()
// {
//     $hero = AboutContent::where('section', 'hero')->first();
//     $vision = AboutContent::where('section', 'vision')->first();
//     $mission = AboutContent::where('section', 'mission')->first();

//     try {
//         $valeurs = AboutValue::orderBy('order')->get();
//     } catch (\Exception $e) {
//         $valeurs = AboutValue::orderBy('created_at', 'desc')->get();
//     }

//     try {
//         $stats = AboutStat::orderBy('order')->get();
//     } catch (\Exception $e) {
//         $stats = AboutStat::orderBy('created_at', 'desc')->get();
//     }

//     $equipe = Equipe::orderBy('created_at', 'desc')->get();
//     $partenaires = Partenaire::orderBy('created_at', 'desc')->get();

//     return view('welcome', compact(
//         'hero', 'vision', 'mission', 'valeurs', 'stats', 'equipe', 'partenaires'
//     ));
// }



// app/Http/Controllers/FrontendController.php

public function about()
{
    // Récupérer les données de la table about_contents
    $hero = AboutContent::where('section', 'hero')->first();
    $vision = AboutContent::where('section', 'vision')->first();
    $mission = AboutContent::where('section', 'mission')->first();

    // Récupérer les valeurs
    try {
        $valeurs = AboutValue::orderBy('order')->get();
    } catch (\Exception $e) {
        $valeurs = AboutValue::orderBy('created_at', 'desc')->get();
    }

    // Récupérer les statistiques
    try {
        $stats = AboutStat::orderBy('order')->get();
    } catch (\Exception $e) {
        $stats = AboutStat::orderBy('created_at', 'desc')->get();
    }

    // Équipe et partenaires
    $equipe = Equipe::orderBy('created_at', 'desc')->get();
    $partenaires = Partenaire::orderBy('created_at', 'desc')->get();

    // Compacter TOUTES les données dans un tableau 'about'
    $about = [
        'hero' => $hero,
        'vision' => $vision,
        'mission' => $mission,
        'valeurs' => $valeurs,
        'stats' => $stats,
        'equipe' => $equipe,
        'partenaires' => $partenaires,
    ];

    // Passer les données à la vue welcome
    return view('welcome', compact('about'));
}
    /**
     * Page Nos actions
     */
   public function actions()
{
    $articles = Article::with(['user', 'categorie'])
        ->where('is_published', true)
        ->latest()
        ->get();

    $programmes = Programme::where('is_active', true)->get();

    return view('welcome', compact('articles', 'programmes'));
}

    /**
     * Page S'impliquer
     */
    // public function getInvolved()
    // {
    //     $programmes = Programme::all();
    //     $benevoles = []; // Vous pouvez passer des données si besoin

    //     return view('welcome', compact('programmes'));
    // }

    /**
     * Page Contact
     */
    public function contact()
    {
        return view('welcome');
    }
    /**
 * Page Call To Action
 */
public function callToAction()
{
    return view('welcome');
}

    /**
     * Page générique pour les pages personnalisées
     */
    public function page($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();

        return view('welcome', compact('page'));
    }

    /**
     * Article individuel
     */
    public function article($id)
    {
        $article = Article::with('categorie')->findOrFail($id);
        $articlesRecents = Article::latest()->where('id', '!=', $id)->take(3)->get();

        return view('welcome', compact('article', 'articlesRecents'));
    }

    /**
     * Programme individuel
     */
    public function programme($id)
    {
        $programme = Programme::findOrFail($id);

        return view('welcome', compact('programme'));
    }
}
