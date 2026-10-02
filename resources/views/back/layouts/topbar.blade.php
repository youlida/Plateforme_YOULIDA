@php
    $adminUser = auth()->user();

    $unreadNotificationsCount = $adminUser
        ->unreadNotifications()
        ->count();

    $recentNotifications = $adminUser
        ->notifications()
        ->latest()
        ->limit(6)
        ->get();
@endphp

<div class="topbar">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

        {{-- Message de bienvenue --}}
        <div>
            <span class="text-muted">Bonjour,</span>

            <strong>
                {{ $adminUser->name ?? 'Administrateur' }}
            </strong>
        </div>

        {{-- Actions de droite --}}
        <div class="d-flex align-items-center gap-3">

            {{-- Notifications --}}
            <div class="admin-notification-wrapper">

                <button
                    type="button"
                    class="admin-notification-toggle"
                    id="notificationToggle"
                    aria-label="Afficher les notifications"
                    aria-expanded="false"
                    aria-controls="notificationDropdown"
                >

                    <i class="fa-regular fa-bell"></i>

                    @if($unreadNotificationsCount > 0)

                        <span class="admin-notification-badge">

                            {{ $unreadNotificationsCount > 99
                                ? '99+'
                                : $unreadNotificationsCount }}

                        </span>

                    @endif

                </button>

                {{-- Menu des notifications --}}
                <div
                    class="admin-notification-dropdown"
                    id="notificationDropdown"
                >

                    {{-- En-tête --}}
                    <div class="admin-notification-header">

                        <div>
                            <strong>Notifications</strong>

                            <p>
                                {{ $unreadNotificationsCount }}
                                non lue(s)
                            </p>
                        </div>

                        @if($unreadNotificationsCount > 0)

                            <form
                                action="{{ route('admin.notifications.mark-all-read') }}"
                                method="POST"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="admin-notification-read-all"
                                >
                                    Tout marquer comme lu
                                </button>

                            </form>

                        @endif

                    </div>

                    {{-- Liste --}}
                    <div class="admin-notification-list">

                        @forelse($recentNotifications as $notification)

                            @php
                                $notificationData = $notification->data;
                            @endphp

                            <a
                                href="{{ route('admin.notifications.open', $notification->id) }}"
                                class="admin-notification-item {{ $notification->read_at ? '' : 'unread' }}"
                            >

                                <div class="admin-notification-icon">

                                    @if(($notificationData['type'] ?? '') === 'youth_message')

    <i class="fa-solid fa-heart"></i>

@elseif(($notificationData['type'] ?? '') === 'partnership_request')

    <i class="fa-solid fa-handshake"></i>

@elseif(($notificationData['type'] ?? '') === 'intervention_request')

    <i class="fa-solid fa-calendar-check"></i>

@elseif(($notificationData['type'] ?? '') === 'benevole')

    <i class="fa-solid fa-hands-helping"></i>

@else

    <i class="fa-solid fa-bell"></i>

@endif

                                </div>

                                <div class="admin-notification-content">

                                    <strong>
                                        {{ $notificationData['title'] ?? 'Nouvelle notification' }}
                                    </strong>

                                    <p>
                                        {{ $notificationData['message'] ?? '' }}
                                    </p>

                                    @if(!empty($notificationData['reference']))

                                        <small class="admin-notification-reference">
                                            {{ $notificationData['reference'] }}
                                        </small>

                                    @endif

                                    <small class="admin-notification-date">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </small>

                                </div>

                                @if(!$notification->read_at)

                                    <span class="admin-notification-dot"></span>

                                @endif

                            </a>

                        @empty

                            <div class="admin-notification-empty">

                                <i class="fa-regular fa-bell-slash"></i>

                                <p>Aucune notification pour le moment.</p>

                            </div>

                        @endforelse

                    </div>

                </div>

            </div>

            {{-- Menu utilisateur existant --}}
            {{-- =====================================================
    MENU UTILISATEUR
====================================================== --}}
<div class="user-dropdown">

    <button
        type="button"
        class="user-box border-0 bg-transparent"
        id="userDropdownToggle"
        aria-expanded="false"
        aria-controls="userDropdownMenu"
    >

        <div class="text-end">

            <p class="user-name">
                {{ $adminUser->prenom }}
                {{ $adminUser->name ?? 'Admin' }}
            </p>

            <p class="user-role">
                {{ $adminUser->role->name ?? 'Administrateur' }}
            </p>

        </div>


        {{-- Photo / Avatar --}}
        <div class="avatar overflow-hidden">

            @if(
                $adminUser->photo &&
                \Illuminate\Support\Facades\Storage::disk('public')
                    ->exists($adminUser->photo)
            )

                <img
                    src="{{ asset('storage/' . $adminUser->photo) }}"
                    alt="Photo de {{ $adminUser->name }}"
                    style="
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                        border-radius: 50%;
                    "
                >

            @else

                {{ strtoupper(
                    substr(
                        $adminUser->prenom ?: ($adminUser->name ?? 'A'),
                        0,
                        1
                    )
                ) }}

            @endif

        </div>


        <i
            class="fa-solid fa-chevron-down
                   text-muted ms-1"
            style="font-size: 11px;"
        ></i>

    </button>


    {{-- Dropdown utilisateur --}}
    <div
        class="dropdown-menu-user"
        id="userDropdownMenu"
    >

        {{-- Résumé du compte --}}
        <div class="px-3 py-3 border-bottom">

            <div class="d-flex align-items-center gap-3">

                <div
                    class="avatar overflow-hidden"
                    style="
                        width: 45px;
                        height: 45px;
                        min-width: 45px;
                    "
                >

                    @if(
                        $adminUser->photo &&
                        \Illuminate\Support\Facades\Storage::disk('public')
                            ->exists($adminUser->photo)
                    )

                        <img
                            src="{{ asset('storage/' . $adminUser->photo) }}"
                            alt="Photo de profil"
                            style="
                                width: 100%;
                                height: 100%;
                                object-fit: cover;
                                border-radius: 50%;
                            "
                        >

                    @else

                        {{ strtoupper(
                            substr(
                                $adminUser->prenom ?: ($adminUser->name ?? 'A'),
                                0,
                                1
                            )
                        ) }}

                    @endif

                </div>


                <div style="min-width: 0;">

                    <strong class="d-block text-truncate">
                        {{ $adminUser->prenom }}
                        {{ $adminUser->name }}
                    </strong>

                    <small
                        class="text-muted d-block text-truncate"
                    >
                        {{ $adminUser->email }}
                    </small>

                </div>

            </div>

        </div>


        <a href="{{ route('admin.profile.show') }}">

            <i class="fa-regular fa-user"></i>

            Mon profil

        </a>


        <a href="{{ route('admin.profile.edit') }}">

            <i class="fa-solid fa-user-pen"></i>

            Modifier mon profil

        </a>


        <a href="{{ route('admin.settings.index') }}">

            <i class="fa-solid fa-gear"></i>

            Paramètres

        </a>


        <hr>


        <a
            href="#"
            class="text-danger"
            onclick="
                event.preventDefault();
                document.getElementById('logout-form').submit();
            "
        >

            <i class="fa-solid fa-right-from-bracket"></i>

            Déconnexion

        </a>


        <form
            id="logout-form"
            action="{{ route('logout') }}"
            method="POST"
            style="display:none;"
        >
            @csrf
        </form>

    </div>


            </div>

        </div>

    </div>

</div>

{{-- Script des notifications --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const toggle = document.getElementById('notificationToggle');
    const dropdown = document.getElementById('notificationDropdown');

    if (!toggle || !dropdown) {
        return;
    }

    toggle.addEventListener('click', function (event) {

        event.stopPropagation();

        const isOpen = dropdown.classList.toggle('show');

        toggle.setAttribute('aria-expanded', String(isOpen));

        // Fermer le menu utilisateur s'il est ouvert.
        const userMenu = document.getElementById('userDropdownMenu');

        if (userMenu) {
            userMenu.classList.remove('show');
        }

    });

    dropdown.addEventListener('click', function (event) {
        event.stopPropagation();
    });

    document.addEventListener('click', function () {

        dropdown.classList.remove('show');

        toggle.setAttribute('aria-expanded', 'false');

    });

});
</script>
