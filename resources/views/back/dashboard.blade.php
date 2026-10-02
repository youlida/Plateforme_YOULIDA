@extends('back.layouts.app')

@section('title', 'Dashboard Admin')

@section('page-title', 'Tableau de bord')

@section(
    'page-subtitle',
    'Vue générale des indicateurs de la plateforme YOULIDA'
)

@section('content')

<style>
    /* =========================================================
       KPI DASHBOARD
    ========================================================== */

    .dashboard-section {
        margin-bottom: 3rem;
    }

    .dashboard-section-title {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 4px;
        font-weight: 700;
    }

    .dashboard-section-subtitle {
        color: #6c757d;
        font-size: .875rem;
        margin-bottom: 1rem;
    }

    .kpi-link {
        display: block;
        height: 100%;
        color: inherit;
        text-decoration: none !important;
    }

    .dashboard-kpi-card {
        position: relative;
        height: 100%;
        cursor: pointer;
        overflow: hidden;
        transition:
            transform .2s ease,
            box-shadow .2s ease,
            border-color .2s ease;
    }

    .dashboard-kpi-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(15, 23, 42, .10);
    }

    .dashboard-kpi-card .kpi-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .dashboard-kpi-card .kpi-arrow {
        color: #94a3b8;
        font-size: .8rem;
        transition:
            color .2s ease,
            transform .2s ease;
    }

    .dashboard-kpi-card:hover .kpi-arrow {
        color: #0d6efd;
        transform: translate(2px, -2px);
    }

    .dashboard-kpi-card h6 {
        margin-top: 18px;
        margin-bottom: 7px;
    }

    .dashboard-kpi-card h3 {
        margin-bottom: 10px;
    }

    .kpi-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
    }

    .kpi-description {
        color: #6c757d;
        font-size: .82rem;
    }

    .kpi-view {
        color: #94a3b8;
        font-size: .78rem;
        font-weight: 600;
        white-space: nowrap;
        transition: color .2s ease;
    }

    .dashboard-kpi-card:hover .kpi-view {
        color: #0d6efd;
    }

    .kpi-currency {
        font-size: .9rem;
        font-weight: 600;
    }
</style>


<div class="container-fluid px-0">


    {{-- =====================================================
        UTILISATEURS
    ====================================================== --}}
    <section class="dashboard-section">

        <h5 class="dashboard-section-title">
            <i class="fa-solid fa-users text-primary"></i>
            Utilisateurs
        </h5>

        <p class="dashboard-section-subtitle">
            Comptes et accès à la plateforme
        </p>


        <div class="row g-4">

            {{-- Total utilisateurs --}}
            <div class="col-sm-6 col-xl-3">

                <a
                    href="{{ route('admin.utilisateurs.index') }}"
                    class="kpi-link"
                >

                    <div class="stat-card dashboard-kpi-card">

                        <div class="kpi-top">

                            <div class="icon-box bg-primary-soft">
                                <i class="fa-solid fa-users"></i>
                            </div>

                            <i class="fa-solid fa-arrow-up-right-from-square kpi-arrow"></i>

                        </div>

                        <h6>
                            Total utilisateurs
                        </h6>

                        <h3>
                            {{ number_format($totalUsers, 0, ',', ' ') }}
                        </h3>

                        <div class="kpi-footer">

                            <span class="kpi-description">
                                Comptes enregistrés
                            </span>

                            <span class="kpi-view">
                                Voir
                                <i class="fa-solid fa-arrow-right ms-1"></i>
                            </span>

                        </div>

                    </div>

                </a>

            </div>


            {{-- Utilisateurs actifs --}}
            <div class="col-sm-6 col-xl-3">

                <a
                    href="{{ route('admin.utilisateurs.index') }}"
                    class="kpi-link"
                >

                    <div class="stat-card dashboard-kpi-card">

                        <div class="kpi-top">

                            <div class="icon-box bg-success-soft">
                                <i class="fa-solid fa-user-check"></i>
                            </div>

                            <i class="fa-solid fa-arrow-up-right-from-square kpi-arrow"></i>

                        </div>

                        <h6>
                            Utilisateurs actifs
                        </h6>

                        <h3>
                            {{ number_format($activeUsers, 0, ',', ' ') }}
                        </h3>

                        <div class="kpi-footer">

                            <span class="kpi-description">
                                Comptes actifs
                            </span>

                            <span class="kpi-view">
                                Voir
                                <i class="fa-solid fa-arrow-right ms-1"></i>
                            </span>

                        </div>

                    </div>

                </a>

            </div>

        </div>

    </section>



    {{-- =====================================================
        CONTENUS
    ====================================================== --}}
    <section class="dashboard-section">

        <h5 class="dashboard-section-title">
            <i class="fa-solid fa-layer-group text-primary"></i>
            Contenus
        </h5>

        <p class="dashboard-section-subtitle">
            Contenus éditoriaux et ressources de YOULIDA
        </p>


        <div class="row g-4">

            {{-- Articles --}}
            <div class="col-sm-6 col-lg-4 col-xl-3">

                <a
                    href="{{ route('admin.articles.index') }}"
                    class="kpi-link"
                >

                    <div class="stat-card dashboard-kpi-card">

                        <div class="kpi-top">

                            <div class="icon-box bg-success-soft">
                                <i class="fa-solid fa-newspaper"></i>
                            </div>

                            <i class="fa-solid fa-arrow-up-right-from-square kpi-arrow"></i>

                        </div>

                        <h6>Articles</h6>

                        <h3>
                            {{ number_format($totalArticles, 0, ',', ' ') }}
                        </h3>

                        <div class="kpi-footer">

                            <span class="kpi-description">
                                Articles enregistrés
                            </span>

                            <span class="kpi-view">
                                Voir
                                <i class="fa-solid fa-arrow-right ms-1"></i>
                            </span>

                        </div>

                    </div>

                </a>

            </div>


            {{-- Programmes --}}
            <div class="col-sm-6 col-lg-4 col-xl-3">

                <a
                    href="{{ route('admin.programmes.index') }}"
                    class="kpi-link"
                >

                    <div class="stat-card dashboard-kpi-card">

                        <div class="kpi-top">

                            <div class="icon-box bg-primary-soft">
                                <i class="fa-solid fa-calendar-days"></i>
                            </div>

                            <i class="fa-solid fa-arrow-up-right-from-square kpi-arrow"></i>

                        </div>

                        <h6>Programmes</h6>

                        <h3>
                            {{ number_format($totalProgrammes, 0, ',', ' ') }}
                        </h3>

                        <div class="kpi-footer">

                            <span class="kpi-description">
                                Programmes enregistrés
                            </span>

                            <span class="kpi-view">
                                Voir
                                <i class="fa-solid fa-arrow-right ms-1"></i>
                            </span>

                        </div>

                    </div>

                </a>

            </div>


            {{-- Témoignages --}}
            <div class="col-sm-6 col-lg-4 col-xl-3">

                <a
                    href="{{ route('admin.temoignages.index') }}"
                    class="kpi-link"
                >

                    <div class="stat-card dashboard-kpi-card">

                        <div class="kpi-top">

                            <div class="icon-box bg-warning-soft">
                                <i class="fa-solid fa-comments"></i>
                            </div>

                            <i class="fa-solid fa-arrow-up-right-from-square kpi-arrow"></i>

                        </div>

                        <h6>Témoignages</h6>

                        <h3>
                            {{ number_format($totalTemoignages, 0, ',', ' ') }}
                        </h3>

                        <div class="kpi-footer">

                            <span class="kpi-description">
                                Témoignages enregistrés
                            </span>

                            <span class="kpi-view">
                                Voir
                                <i class="fa-solid fa-arrow-right ms-1"></i>
                            </span>

                        </div>

                    </div>

                </a>

            </div>


            {{-- Pages --}}
            <div class="col-sm-6 col-lg-4 col-xl-3">

                <a
                    href="{{ route('admin.pages.index') }}"
                    class="kpi-link"
                >

                    <div class="stat-card dashboard-kpi-card">

                        <div class="kpi-top">

                            <div class="icon-box bg-primary-soft">
                                <i class="fa-regular fa-file-lines"></i>
                            </div>

                            <i class="fa-solid fa-arrow-up-right-from-square kpi-arrow"></i>

                        </div>

                        <h6>Pages</h6>

                        <h3>
                            {{ number_format($totalPages, 0, ',', ' ') }}
                        </h3>

                        <div class="kpi-footer">

                            <span class="kpi-description">
                                Pages administrées
                            </span>

                            <span class="kpi-view">
                                Voir
                                <i class="fa-solid fa-arrow-right ms-1"></i>
                            </span>

                        </div>

                    </div>

                </a>

            </div>


            {{-- Médias --}}
            <div class="col-sm-6 col-lg-4 col-xl-3">

                <a
                    href="{{ route('admin.media.index') }}"
                    class="kpi-link"
                >

                    <div class="stat-card dashboard-kpi-card">

                        <div class="kpi-top">

                            <div class="icon-box bg-danger-soft">
                                <i class="fa-solid fa-photo-film"></i>
                            </div>

                            <i class="fa-solid fa-arrow-up-right-from-square kpi-arrow"></i>

                        </div>

                        <h6>Médias</h6>

                        <h3>
                            {{ number_format($totalMedias, 0, ',', ' ') }}
                        </h3>

                        <div class="kpi-footer">

                            <span class="kpi-description">
                                Ressources multimédias
                            </span>

                            <span class="kpi-view">
                                Voir
                                <i class="fa-solid fa-arrow-right ms-1"></i>
                            </span>

                        </div>

                    </div>

                </a>

            </div>

        </div>

    </section>



    {{-- =====================================================
        COMMUNAUTÉ
    ====================================================== --}}
    <section class="dashboard-section">

        <h5 class="dashboard-section-title">
            <i class="fa-solid fa-people-group text-primary"></i>
            Communauté
        </h5>

        <p class="dashboard-section-subtitle">
            Engagement, bénévolat et réseau YOULIDA
        </p>


        <div class="row g-4">

            {{-- Total bénévoles --}}
            <div class="col-sm-6 col-lg-4 col-xl-3">

                <a
                    href="{{ route('admin.benevoles.index') }}"
                    class="kpi-link"
                >

                    <div class="stat-card dashboard-kpi-card">

                        <div class="kpi-top">

                            <div class="icon-box bg-primary-soft">
                                <i class="fa-solid fa-hands-helping"></i>
                            </div>

                            <i class="fa-solid fa-arrow-up-right-from-square kpi-arrow"></i>

                        </div>

                        <h6>
                            Total bénévoles
                        </h6>

                        <h3>
                            {{ number_format($totalBenevoles, 0, ',', ' ') }}
                        </h3>

                        <div class="kpi-footer">

                            <span class="kpi-description">
                                Candidatures reçues
                            </span>

                            <span class="kpi-view">
                                Voir
                                <i class="fa-solid fa-arrow-right ms-1"></i>
                            </span>

                        </div>

                    </div>

                </a>

            </div>


            {{-- Bénévoles approuvés --}}
            <div class="col-sm-6 col-lg-4 col-xl-3">

                <a
                    href="{{ route('admin.benevoles.index', ['status' => 'approved']) }}"
                    class="kpi-link"
                >

                    <div class="stat-card dashboard-kpi-card">

                        <div class="kpi-top">

                            <div class="icon-box bg-success-soft">
                                <i class="fa-solid fa-user-check"></i>
                            </div>

                            <i class="fa-solid fa-arrow-up-right-from-square kpi-arrow"></i>

                        </div>

                        <h6>
                            Bénévoles approuvés
                        </h6>

                        <h3>
                            {{ number_format($approvedBenevoles, 0, ',', ' ') }}
                        </h3>

                        <div class="kpi-footer">

                            <span class="kpi-description">
                                Candidatures validées
                            </span>

                            <span class="kpi-view">
                                Voir
                                <i class="fa-solid fa-arrow-right ms-1"></i>
                            </span>

                        </div>

                    </div>

                </a>

            </div>


            {{-- Bénévoles en attente --}}
            <div class="col-sm-6 col-lg-4 col-xl-3">

                <a
                    href="{{ route('admin.benevoles.index', ['status' => 'pending']) }}"
                    class="kpi-link"
                >

                    <div class="stat-card dashboard-kpi-card">

                        <div class="kpi-top">

                            <div class="icon-box bg-warning-soft">
                                <i class="fa-solid fa-user-clock"></i>
                            </div>

                            <i class="fa-solid fa-arrow-up-right-from-square kpi-arrow"></i>

                        </div>

                        <h6>
                            Bénévoles en attente
                        </h6>

                        <h3>
                            {{ number_format($pendingBenevoles, 0, ',', ' ') }}
                        </h3>

                        <div class="kpi-footer">

                            <span class="kpi-description">
                                À examiner
                            </span>

                            <span class="kpi-view">
                                Traiter
                                <i class="fa-solid fa-arrow-right ms-1"></i>
                            </span>

                        </div>

                    </div>

                </a>

            </div>


            {{-- Partenaires --}}
            <div class="col-sm-6 col-lg-4 col-xl-3">

                <a
                    href="{{ route('admin.partenaires.index') }}"
                    class="kpi-link"
                >

                    <div class="stat-card dashboard-kpi-card">

                        <div class="kpi-top">

                            <div class="icon-box bg-primary-soft">
                                <i class="fa-solid fa-handshake"></i>
                            </div>

                            <i class="fa-solid fa-arrow-up-right-from-square kpi-arrow"></i>

                        </div>

                        <h6>
                            Partenaires
                        </h6>

                        <h3>
                            {{ number_format($totalPartenaires, 0, ',', ' ') }}
                        </h3>

                        <div class="kpi-footer">

                            <span class="kpi-description">
                                Partenaires enregistrés
                            </span>

                            <span class="kpi-view">
                                Voir
                                <i class="fa-solid fa-arrow-right ms-1"></i>
                            </span>

                        </div>

                    </div>

                </a>

            </div>


            {{-- Équipe --}}
            <div class="col-sm-6 col-lg-4 col-xl-3">

                <a
                    href="{{ route('admin.equipes.index') }}"
                    class="kpi-link"
                >

                    <div class="stat-card dashboard-kpi-card">

                        <div class="kpi-top">

                            <div class="icon-box bg-success-soft">
                                <i class="fa-solid fa-people-group"></i>
                            </div>

                            <i class="fa-solid fa-arrow-up-right-from-square kpi-arrow"></i>

                        </div>

                        <h6>
                            Membres équipe
                        </h6>

                        <h3>
                            {{ number_format($totalEquipes, 0, ',', ' ') }}
                        </h3>

                        <div class="kpi-footer">

                            <span class="kpi-description">
                                Membres enregistrés
                            </span>

                            <span class="kpi-view">
                                Voir
                                <i class="fa-solid fa-arrow-right ms-1"></i>
                            </span>

                        </div>

                    </div>

                </a>

            </div>


            {{-- Newsletter --}}
            <div class="col-sm-6 col-lg-4 col-xl-3">

                <a
                    href="{{ route('admin.newsletters.index') }}"
                    class="kpi-link"
                >

                    <div class="stat-card dashboard-kpi-card">

                        <div class="kpi-top">

                            <div class="icon-box bg-warning-soft">
                                <i class="fa-solid fa-envelope-open-text"></i>
                            </div>

                            <i class="fa-solid fa-arrow-up-right-from-square kpi-arrow"></i>

                        </div>

                        <h6>
                            Abonnés newsletter
                        </h6>

                        <h3>
                            {{ number_format($totalNewsletter, 0, ',', ' ') }}
                        </h3>

                        <div class="kpi-footer">

                            <span class="kpi-description">
                                Abonnements enregistrés
                            </span>

                            <span class="kpi-view">
                                Voir
                                <i class="fa-solid fa-arrow-right ms-1"></i>
                            </span>

                        </div>

                    </div>

                </a>

            </div>

        </div>

    </section>



    {{-- =====================================================
        DONS
    ====================================================== --}}
    <section class="dashboard-section">

        <h5 class="dashboard-section-title">
            <i class="fa-solid fa-hand-holding-heart text-success"></i>
            Dons
        </h5>

        <p class="dashboard-section-subtitle">
            Indicateurs financiers des dons enregistrés
        </p>


        <div class="row g-4">

            {{-- Nombre de dons --}}
            <div class="col-md-6 col-xl-4">

                <a
                    href="{{ route('admin.dons.index') }}"
                    class="kpi-link"
                >

                    <div class="stat-card dashboard-kpi-card">

                        <div class="kpi-top">

                            <div class="icon-box bg-success-soft">
                                <i class="fa-solid fa-hand-holding-heart"></i>
                            </div>

                            <i class="fa-solid fa-arrow-up-right-from-square kpi-arrow"></i>

                        </div>

                        <h6>
                            Nombre de dons
                        </h6>

                        <h3>
                            {{ number_format($totalDons, 0, ',', ' ') }}
                        </h3>

                        <div class="kpi-footer">

                            <span class="kpi-description">
                                Dons enregistrés
                            </span>

                            <span class="kpi-view">
                                Voir
                                <i class="fa-solid fa-arrow-right ms-1"></i>
                            </span>

                        </div>

                    </div>

                </a>

            </div>


            {{-- Montant total --}}
            <div class="col-md-6 col-xl-4">

                <a
                    href="{{ route('admin.dons.index') }}"
                    class="kpi-link"
                >

                    <div class="stat-card dashboard-kpi-card">

                        <div class="kpi-top">

                            <div class="icon-box bg-success-soft">
                                <i class="fa-solid fa-money-bill-wave"></i>
                            </div>

                            <i class="fa-solid fa-arrow-up-right-from-square kpi-arrow"></i>

                        </div>

                        <h6>
                            Montant total
                        </h6>

                        <h3>
                            {{ number_format(
                                $totalDonationAmount,
                                0,
                                ',',
                                ' '
                            ) }}

                            <span class="kpi-currency">
                                FCFA
                            </span>
                        </h3>

                        <div class="kpi-footer">

                            <span class="kpi-description">
                                Total enregistré
                            </span>

                            <span class="kpi-view">
                                Voir
                                <i class="fa-solid fa-arrow-right ms-1"></i>
                            </span>

                        </div>

                    </div>

                </a>

            </div>


            {{-- Don moyen --}}
            <div class="col-md-6 col-xl-4">

                <a
                    href="{{ route('admin.dons.index') }}"
                    class="kpi-link"
                >

                    <div class="stat-card dashboard-kpi-card">

                        <div class="kpi-top">

                            <div class="icon-box bg-primary-soft">
                                <i class="fa-solid fa-chart-line"></i>
                            </div>

                            <i class="fa-solid fa-arrow-up-right-from-square kpi-arrow"></i>

                        </div>

                        <h6>
                            Don moyen
                        </h6>

                        <h3>
                            {{ number_format(
                                $averageDonationAmount,
                                0,
                                ',',
                                ' '
                            ) }}

                            <span class="kpi-currency">
                                FCFA
                            </span>
                        </h3>

                        <div class="kpi-footer">

                            <span class="kpi-description">
                                Moyenne enregistrée
                            </span>

                            <span class="kpi-view">
                                Voir
                                <i class="fa-solid fa-arrow-right ms-1"></i>
                            </span>

                        </div>

                    </div>

                </a>

            </div>

        </div>

    </section>



    {{-- =====================================================
        MESSAGES ET DEMANDES
    ====================================================== --}}
    <section class="dashboard-section">

        <h5 class="dashboard-section-title">
            <i class="fa-solid fa-inbox text-primary"></i>
            Messages et demandes
        </h5>

        <p class="dashboard-section-subtitle">
            Interactions et sollicitations reçues depuis YOULIDA
        </p>


        <div class="row g-4">

            {{-- Contacts --}}
            <div class="col-sm-6 col-lg-4 col-xl-3">

                <a
                    href="{{ route('admin.contacts.index') }}"
                    class="kpi-link"
                >

                    <div class="stat-card dashboard-kpi-card">

                        <div class="kpi-top">

                            <div class="icon-box bg-primary-soft">
                                <i class="fa-solid fa-envelope"></i>
                            </div>

                            <i class="fa-solid fa-arrow-up-right-from-square kpi-arrow"></i>

                        </div>

                        <h6>
                            Messages de contact
                        </h6>

                        <h3>
                            {{ number_format($totalContacts, 0, ',', ' ') }}
                        </h3>

                        <div class="kpi-footer">

                            <span class="kpi-description">
                                Messages reçus
                            </span>

                            <span class="kpi-view">
                                Consulter
                                <i class="fa-solid fa-arrow-right ms-1"></i>
                            </span>

                        </div>

                    </div>

                </a>

            </div>


            {{-- Messages jeunes --}}
            <div class="col-sm-6 col-lg-4 col-xl-3">

                <a
                    href="{{ route('admin.youth-messages.index') }}"
                    class="kpi-link"
                >

                    <div class="stat-card dashboard-kpi-card">

                        <div class="kpi-top">

                            <div class="icon-box bg-danger-soft">
                                <i class="fa-solid fa-heart"></i>
                            </div>

                            <i class="fa-solid fa-arrow-up-right-from-square kpi-arrow"></i>

                        </div>

                        <h6>
                            Messages des jeunes
                        </h6>

                        <h3>
                            {{ number_format(
                                $totalYouthMessages,
                                0,
                                ',',
                                ' '
                            ) }}
                        </h3>

                        <div class="kpi-footer">

                            <span class="kpi-description">
                                Messages reçus
                            </span>

                            <span class="kpi-view">
                                Consulter
                                <i class="fa-solid fa-arrow-right ms-1"></i>
                            </span>

                        </div>

                    </div>

                </a>

            </div>


            {{-- Partenariats --}}
            <div class="col-sm-6 col-lg-4 col-xl-3">

                <a
                    href="{{ route('admin.partnership-requests.index') }}"
                    class="kpi-link"
                >

                    <div class="stat-card dashboard-kpi-card">

                        <div class="kpi-top">

                            <div class="icon-box bg-warning-soft">
                                <i class="fa-solid fa-handshake"></i>
                            </div>

                            <i class="fa-solid fa-arrow-up-right-from-square kpi-arrow"></i>

                        </div>

                        <h6>
                            Demandes partenariat
                        </h6>

                        <h3>
                            {{ number_format(
                                $totalPartnershipRequests,
                                0,
                                ',',
                                ' '
                            ) }}
                        </h3>

                        <div class="kpi-footer">

                            <span class="kpi-description">
                                Demandes reçues
                            </span>

                            <span class="kpi-view">
                                Traiter
                                <i class="fa-solid fa-arrow-right ms-1"></i>
                            </span>

                        </div>

                    </div>

                </a>

            </div>


            {{-- Interventions --}}
            <div class="col-sm-6 col-lg-4 col-xl-3">

                <a
                    href="{{ route('admin.intervention-requests.index') }}"
                    class="kpi-link"
                >

                    <div class="stat-card dashboard-kpi-card">

                        <div class="kpi-top">

                            <div class="icon-box bg-success-soft">
                                <i class="fa-solid fa-calendar-check"></i>
                            </div>

                            <i class="fa-solid fa-arrow-up-right-from-square kpi-arrow"></i>

                        </div>

                        <h6>
                            Sollicitations
                        </h6>

                        <h3>
                            {{ number_format(
                                $totalInterventionRequests,
                                0,
                                ',',
                                ' '
                            ) }}
                        </h3>

                        <div class="kpi-footer">

                            <span class="kpi-description">
                                Demandes d'intervention
                            </span>

                            <span class="kpi-view">
                                Traiter
                                <i class="fa-solid fa-arrow-right ms-1"></i>
                            </span>

                        </div>

                    </div>

                </a>

            </div>

        </div>

    </section>



    {{-- =====================================================
        ADMINISTRATION
    ====================================================== --}}
    <section class="dashboard-section mb-0">

        <h5 class="dashboard-section-title">
            <i class="fa-solid fa-chart-pie text-primary"></i>
            Administration
        </h5>

        <p class="dashboard-section-subtitle">
            Documents et suivi administratif de YOULIDA
        </p>


        <div class="row g-4">

            {{-- Rapports --}}
            <div class="col-sm-6 col-lg-4 col-xl-3">

                <a
                    href="{{ route('admin.rapports.index') }}"
                    class="kpi-link"
                >

                    <div class="stat-card dashboard-kpi-card">

                        <div class="kpi-top">

                            <div class="icon-box bg-primary-soft">
                                <i class="fa-solid fa-chart-column"></i>
                            </div>

                            <i class="fa-solid fa-arrow-up-right-from-square kpi-arrow"></i>

                        </div>

                        <h6>
                            Rapports
                        </h6>

                        <h3>
                            {{ number_format($totalRapports, 0, ',', ' ') }}
                        </h3>

                        <div class="kpi-footer">

                            <span class="kpi-description">
                                Rapports enregistrés
                            </span>

                            <span class="kpi-view">
                                Voir
                                <i class="fa-solid fa-arrow-right ms-1"></i>
                            </span>

                        </div>

                    </div>

                </a>

            </div>

        </div>

    </section>


</div>

@endsection