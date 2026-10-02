<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Article;
use App\Models\Programme;
use App\Models\Temoignage;
use App\Models\Don;
use App\Models\Benevole;
use App\Models\Partenaire;
use App\Models\Contact;
use App\Models\AbonneNewsletter;
use App\Models\Media;
use App\Models\Page;
use App\Models\Equipe;
use App\Models\Rapport;
use App\Models\YouthMessage;
use App\Models\PartnershipRequest;
use App\Models\InterventionRequest;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Utilisateurs
        |--------------------------------------------------------------------------
        */

        $totalUsers = User::count();

        $activeUsers = User::where(
            'is_active',
            true
        )->count();


        /*
        |--------------------------------------------------------------------------
        | Contenus
        |--------------------------------------------------------------------------
        */

        $totalArticles = Article::count();

        $totalProgrammes = Programme::count();

        $totalTemoignages = Temoignage::count();

        $totalPages = Page::count();

        $totalMedias = Media::count();


        /*
        |--------------------------------------------------------------------------
        | Communauté
        |--------------------------------------------------------------------------
        */

        $totalBenevoles = Benevole::count();

        $approvedBenevoles = Benevole::where(
            'is_approved',
            true
        )->count();

        $pendingBenevoles = Benevole::where(
            'is_approved',
            false
        )->count();

        $totalPartenaires = Partenaire::count();

        $totalEquipes = Equipe::count();

        $totalNewsletter = AbonneNewsletter::count();


        /*
        |--------------------------------------------------------------------------
        | Dons
        |--------------------------------------------------------------------------
        */

        $totalDons = Don::count();

        $totalDonationAmount = Don::sum('amount');

        $averageDonationAmount = Don::avg('amount') ?? 0;


        /*
        |--------------------------------------------------------------------------
        | Communications
        |--------------------------------------------------------------------------
        */

        $totalContacts = Contact::count();

        $totalYouthMessages = YouthMessage::count();

        $totalPartnershipRequests =
            PartnershipRequest::count();

        $totalInterventionRequests =
            InterventionRequest::count();


        /*
        |--------------------------------------------------------------------------
        | Administration
        |--------------------------------------------------------------------------
        */

        $totalRapports = Rapport::count();


        return view(
            'back.dashboard',
            compact(
                'totalUsers',
                'activeUsers',

                'totalArticles',
                'totalProgrammes',
                'totalTemoignages',
                'totalPages',
                'totalMedias',

                'totalBenevoles',
                'approvedBenevoles',
                'pendingBenevoles',
                'totalPartenaires',
                'totalEquipes',
                'totalNewsletter',

                'totalDons',
                'totalDonationAmount',
                'averageDonationAmount',

                'totalContacts',
                'totalYouthMessages',
                'totalPartnershipRequests',
                'totalInterventionRequests',

                'totalRapports'
            )
        );
    }
}