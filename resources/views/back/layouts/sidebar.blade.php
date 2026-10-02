<aside class="sidebar" id="sidebar">

    <div class="sidebar-brand">

        <div class="sidebar-brand-text">
            <h4>YOULIDA</h4>
            <small>Administration</small>
        </div>

        <button type="button" class="sidebar-collapse-btn" id="collapseSidebar" title="Réduire le menu"
            aria-label="Réduire le menu">
            <i class="fa-solid fa-angles-left"></i>
        </button>

    </div>

    <div class="sidebar-menu">
        <div class="menu-title">Navigation</div>

        <ul>
            <li>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-gauge-high"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            {{-- Utilisateurs --}}
            <li class="has-submenu {{ request()->routeIs('admin.utilisateurs.*') ? 'open' : '' }}">
                <a href="javascript:void(0);"
                    class="submenu-toggle {{ request()->routeIs('admin.utilisateurs.*') ? 'active' : '' }}">
                    <div>
                        <i class="fa-solid fa-users"></i>
                        <span>Utilisateurs</span>
                    </div>
                    <i class="fa-solid fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="submenu">

                    <li>
                        <a href="{{ route('admin.utilisateurs.index') }}"
                            class="{{ request()->routeIs('admin.utilisateurs.index') ? 'active' : '' }}">
                            Liste des utilisateurs
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.utilisateurs.create') }}"
                            class="{{ request()->routeIs('admin.utilisateurs.create') ? 'active' : '' }}">
                            Ajouter un utilisateur
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Rôles --}}
            <li class="has-submenu {{ request()->routeIs('admin.roles.*') ? 'open' : '' }}">
                <a href="javascript:void(0);"
                    class="submenu-toggle {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                    <div>
                        <i class="fa-solid fa-user-shield"></i>
                        <span>Rôles</span>
                    </div>
                    <i class="fa-solid fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{ route('admin.roles.index') }}"
                            class="{{ request()->routeIs('admin.roles.index') ? 'active' : '' }}">
                            Liste des rôles
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.roles.create') }}"
                            class="{{ request()->routeIs('admin.roles.create') ? 'active' : '' }}">
                            Ajouter un rôle
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Catégories --}}
            <li class="has-submenu {{ request()->routeIs('admin.categories.*') ? 'open' : '' }}">
                <a href="javascript:void(0);"
                    class="submenu-toggle {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <div>
                        <i class="fa-solid fa-folder-tree"></i>
                        <span>Catégories</span>
                    </div>
                    <i class="fa-solid fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{ route('admin.categories.index') }}"
                            class="{{ request()->routeIs('admin.categories.index') ? 'active' : '' }}">
                            Liste des catégories
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.create') }}"
                            class="{{ request()->routeIs('admin.categories.create') ? 'active' : '' }}">
                            Ajouter une catégorie
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Articles --}}
            <li class="has-submenu {{ request()->routeIs('admin.articles.*') ? 'open' : '' }}">
                <a href="javascript:void(0);"
                    class="submenu-toggle {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
                    <div>
                        <i class="fa-solid fa-newspaper"></i>
                        <span>Articles</span>
                    </div>
                    <i class="fa-solid fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{ route('admin.articles.index') }}"
                            class="{{ request()->routeIs('admin.articles.index') ? 'active' : '' }}">
                            Liste des articles
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.articles.create') }}"
                            class="{{ request()->routeIs('admin.articles.create') ? 'active' : '' }}">
                            Ajouter un article
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Programmes --}}
            <li class="has-submenu {{ request()->routeIs('admin.programmes.*') ? 'open' : '' }}">
                <a href="javascript:void(0);"
                    class="submenu-toggle {{ request()->routeIs('admin.programmes.*') ? 'active' : '' }}">
                    <div>
                        <i class="fa-solid fa-diagram-project"></i>
                        <span>Programmes</span>
                    </div>
                    <i class="fa-solid fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{ route('admin.programmes.index') }}"
                            class="{{ request()->routeIs('admin.programmes.index') ? 'active' : '' }}">
                            Liste des programmes
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.programmes.create') }}"
                            class="{{ request()->routeIs('admin.programmes.create') ? 'active' : '' }}">
                            Ajouter un programme
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Témoignages --}}
            <li class="has-submenu {{ request()->routeIs('admin.temoignages.*') ? 'open' : '' }}">
                <a href="javascript:void(0);"
                    class="submenu-toggle {{ request()->routeIs('admin.temoignages.*') ? 'active' : '' }}">
                    <div>
                        <i class="fa-solid fa-comments"></i>
                        <span>Témoignages</span>
                    </div>
                    <i class="fa-solid fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{ route('admin.temoignages.index') }}"
                            class="{{ request()->routeIs('admin.temoignages.index') ? 'active' : '' }}">
                            Liste des témoignages
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.temoignages.create') }}"
                            class="{{ request()->routeIs('admin.temoignages.create') ? 'active' : '' }}">
                            Ajouter un témoignage
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Messages des jeunes --}}
            {{-- Messages des jeunes --}}
            @php
                $newYouthMessagesCount = \App\Models\YouthMessage::where(
                    'status',
                    'nouveau'
                )->count();
            @endphp

            <li class="youth-messages-menu">
                <a href="{{ route('admin.youth-messages.index') }}"
                    class="{{ request()->routeIs('admin.youth-messages.*') ? 'active' : '' }}"
                    title="Messages des jeunes">
                    <div>
                        <i class="fa-solid fa-headset"></i>

                        <span class="sidebar-label">
                            Messages des jeunes
                        </span>
                    </div>

                    @if($newYouthMessagesCount > 0)
                        <span class="youth-message-badge">
                            {{ $newYouthMessagesCount }}
                        </span>
                    @endif
                </a>
            </li>

            <li>
                <a href="{{ route('admin.youth-messages.index') }}"
                    class="{{ request()->routeIs('admin.youth-messages.*') ? 'active' : '' }}"
                    title="Messages des jeunes">
                    <i class="fa-solid fa-headset"></i>

                    <span>Messages des jeunes</span>

                    @if($newYouthMessagesCount > 0)
                        <span class="youth-message-badge">
                            {{ $newYouthMessagesCount }}
                        </span>
                    @endif
                </a>
            </li>

            {{-- Demandes d'intervention --}}
            @php
                $newInterventionRequestsCount =
                    \App\Models\InterventionRequest::where(
                        'status',
                        'nouveau'
                    )->count();
            @endphp

            <li class="intervention-requests-menu">

                <a href="{{ route('admin.intervention-requests.index') }}" class="{{
    request()->routeIs(
        'admin.intervention-requests.*'
    ) ? 'active' : ''
        }}" title="Demandes d'intervention">

                    <div>

                        <i class="fa-solid fa-bullhorn"></i>

                        <span class="sidebar-label">
                            Demandes d'intervention
                        </span>

                    </div>


                    @if($newInterventionRequestsCount > 0)

                        <span class="youth-message-badge">
                            {{ $newInterventionRequestsCount }}
                        </span>

                    @endif

                </a>

            </li>

            {{-- Dons --}}
            <li class="has-submenu {{ request()->routeIs('admin.dons.*') ? 'open' : '' }}">
                <a href="javascript:void(0);"
                    class="submenu-toggle {{ request()->routeIs('admin.dons.*') ? 'active' : '' }}">
                    <div>
                        <i class="fa-solid fa-hand-holding-heart"></i>
                        <span>Dons</span>
                    </div>
                    <i class="fa-solid fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{ route('admin.dons.index') }}"
                            class="{{ request()->routeIs('admin.dons.index') ? 'active' : '' }}">
                            Liste des dons
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.dons.create') }}"
                            class="{{ request()->routeIs('admin.dons.create') ? 'active' : '' }}">
                            Ajouter un don
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Partenaires --}}
            <li
                class="has-submenu {{ request()->routeIs('admin.partenaires.*', 'admin.partnership-requests.*') ? 'open' : '' }}">
                <a href="javascript:void(0);"
                    class="submenu-toggle {{ request()->routeIs('admin.partenaires.*', 'admin.partnership-requests.*') ? 'active' : '' }}">
                    <div>
                        <i class="fa-solid fa-handshake"></i>
                        <span>Partenaires</span>
                    </div>
                    <i class="fa-solid fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="submenu">
                    @php
                        $newPartnershipRequestsCount =
                            \App\Models\PartnershipRequest::where(
                                'status',
                                'nouveau'
                            )->count();
                    @endphp

                    <li>
                        <a href="{{ route('admin.partnership-requests.index') }}"
                            class="{{ request()->routeIs('admin.partnership-requests.*') ? 'active' : '' }}">
                            Demandes reçues

                            @if($newPartnershipRequestsCount > 0)
                                <span class="youth-message-badge">
                                    {{ $newPartnershipRequestsCount }}
                                </span>
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.partenaires.index') }}"
                            class="{{ request()->routeIs('admin.partenaires.index') ? 'active' : '' }}">
                            Liste des partenaires
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.partenaires.create') }}"
                            class="{{ request()->routeIs('admin.partenaires.create') ? 'active' : '' }}">
                            Ajouter un partenaire
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Bénévoles --}}
            <li class="has-submenu {{ request()->routeIs('admin.benevoles.*') ? 'open' : '' }}">
                <a href="javascript:void(0);"
                    class="submenu-toggle {{ request()->routeIs('admin.benevoles.*') ? 'active' : '' }}">
                    <div>
                        <i class="fa-solid fa-hands-helping"></i>
                        <span>Bénévoles</span>
                    </div>
                    <i class="fa-solid fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{ route('admin.benevoles.index') }}"
                            class="{{ request()->routeIs('admin.benevoles.index') ? 'active' : '' }}">
                            Liste des bénévoles
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.benevoles.create') }}"
                            class="{{ request()->routeIs('admin.benevoles.create') ? 'active' : '' }}">
                            Ajouter un bénévole
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Contacts --}}
            <li class="has-submenu {{ request()->routeIs('admin.contacts.*') ? 'open' : '' }}">
                <a href="javascript:void(0);"
                    class="submenu-toggle {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                    <div>
                        <i class="fa-solid fa-envelope"></i>
                        <span>Contacts</span>
                    </div>
                    <i class="fa-solid fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{ route('admin.contacts.index') }}"
                            class="{{ request()->routeIs('admin.contacts.index') ? 'active' : '' }}">
                            Liste des messages
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.contacts.create') }}"
                            class="{{ request()->routeIs('admin.contacts.create') ? 'active' : '' }}">
                            Ajouter un message
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Newsletter --}}
            <li class="has-submenu {{ request()->routeIs('admin.newsletters.*') ? 'open' : '' }}">
                <a href="javascript:void(0);"
                    class="submenu-toggle {{ request()->routeIs('admin.newsletters.*') ? 'active' : '' }}">
                    <div>
                        <i class="fa-solid fa-paper-plane"></i>
                        <span>Newsletter</span>
                    </div>
                    <i class="fa-solid fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{ route('admin.newsletters.index') }}"
                            class="{{ request()->routeIs('admin.newsletters.index') ? 'active' : '' }}">
                            Liste des abonnés
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.newsletters.create') }}"
                            class="{{ request()->routeIs('admin.newsletters.create') ? 'active' : '' }}">
                            Ajouter un abonné
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <div class="menu-title mt-3">Système</div>

        <ul>
            {{-- Médias --}}
            <li class="has-submenu {{ request()->routeIs('admin.media.*') ? 'open' : '' }}">
                <a href="javascript:void(0);"
                    class="submenu-toggle {{ request()->routeIs('admin.media.*') ? 'active' : '' }}">
                    <div>
                        <i class="fa-solid fa-image"></i>
                        <span>Médias</span>
                    </div>
                    <i class="fa-solid fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{ route('admin.media.index') }}"
                            class="{{ request()->routeIs('admin.media.index') ? 'active' : '' }}">
                            Bibliothèque
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.media.create') }}"
                            class="{{ request()->routeIs('admin.media.create') ? 'active' : '' }}">
                            Ajouter un média
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Pages --}}
            <li class="has-submenu {{ request()->routeIs('admin.pages.*') ? 'open' : '' }}">
                <a href="javascript:void(0);"
                    class="submenu-toggle {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
                    <div>
                        <i class="fa-solid fa-file-lines"></i>
                        <span>Pages</span>
                    </div>
                    <i class="fa-solid fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{ route('admin.pages.index') }}"
                            class="{{ request()->routeIs('admin.pages.index') ? 'active' : '' }}">
                            Liste des pages
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pages.create') }}"
                            class="{{ request()->routeIs('admin.pages.create') ? 'active' : '' }}">
                            Créer une page
                        </a>
                    </li>
                </ul>
            </li>

            {{-- À propos --}}
            <li class="has-submenu {{ request()->routeIs('admin.apropos.*') ? 'open' : '' }}">
                <a href="javascript:void(0);"
                    class="submenu-toggle {{ request()->routeIs('admin.apropos.*') ? 'active' : '' }}">
                    <div>
                        <i class="fa-solid fa-circle-info"></i>
                        <span>À propos</span>
                    </div>
                    <i class="fa-solid fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{ route('admin.apropos.index') }}"
                            class="{{ request()->routeIs('admin.apropos.index') ? 'active' : '' }}">
                            Contenu de la page
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.apropos.vision.edit') }}"
                            class="{{ request()->routeIs('admin.apropos.vision.edit') ? 'active' : '' }}">
                            Vision & Mission
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.apropos.valeurs.index') }}"
                            class="{{ request()->routeIs('admin.apropos.valeurs.index') ? 'active' : '' }}">
                            Nos valeurs
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.apropos.stats.index') }}"
                            class="{{ request()->routeIs('admin.apropos.stats.index') ? 'active' : '' }}">
                            Statistiques
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Équipe --}}
            <li class="has-submenu {{ request()->routeIs('admin.equipes.*') ? 'open' : '' }}">
                <a href="javascript:void(0);"
                    class="submenu-toggle {{ request()->routeIs('admin.equipes.*') ? 'active' : '' }}">
                    <div>
                        <i class="fa-solid fa-user-group"></i>
                        <span>Équipe</span>
                    </div>
                    <i class="fa-solid fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{ route('admin.equipes.index') }}"
                            class="{{ request()->routeIs('admin.equipes.index') ? 'active' : '' }}">
                            Liste des membres
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.equipes.create') }}"
                            class="{{ request()->routeIs('admin.equipes.create') ? 'active' : '' }}">
                            Ajouter un membre
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Rapports --}}
            <li class="has-submenu {{ request()->routeIs('admin.rapports.*') ? 'open' : '' }}">
                <a href="javascript:void(0);"
                    class="submenu-toggle {{ request()->routeIs('admin.rapports.*') ? 'active' : '' }}">
                    <div>
                        <i class="fa-solid fa-chart-line"></i>
                        <span>Rapports</span>
                    </div>
                    <i class="fa-solid fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{ route('admin.rapports.index') }}"
                            class="{{ request()->routeIs('admin.rapports.index') ? 'active' : '' }}">
                            Liste des rapports
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.rapports.create') }}"
                            class="{{ request()->routeIs('admin.rapports.create') ? 'active' : '' }}">
                            Ajouter un rapport
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Historique --}}
            <li class="has-submenu {{ request()->routeIs('admin.historiques.*') ? 'open' : '' }}">
                <a href="javascript:void(0);"
                    class="submenu-toggle {{ request()->routeIs('admin.historiques.*') ? 'active' : '' }}">
                    <div>
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        <span>Historique</span>
                    </div>
                    <i class="fa-solid fa-chevron-down submenu-arrow"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{ route('admin.historiques.index') }}"
                            class="{{ request()->routeIs('admin.historiques.index') ? 'active' : '' }}">
                            Toutes les actions
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Déconnexion</span>
                </a>
            </li>
        </ul>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</aside>
<style>
    .youth-message-badge {
        margin-left: auto;
        min-width: 22px;
        height: 22px;
        padding: 0 6px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        border-radius: 999px;

        background: #dc3545;
        color: #fff;

        font-size: 12px;
        font-weight: 700;
        line-height: 1;
    }
</style>
