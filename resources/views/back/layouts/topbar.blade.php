<div class="topbar">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

        <div>
            <span class="text-muted">Bonjour,</span>
            <strong>{{ auth()->user()->name ?? 'Administrateur' }}</strong>
        </div>

        <div class="user-dropdown">

            <div class="user-box" id="userDropdownToggle">

                <div class="text-end">
                    <p class="user-name">
                        {{ auth()->user()->name ?? 'Admin' }}
                    </p>

                    <p class="user-role">
                        {{ auth()->user()->role->name ?? 'Administrateur' }}
                    </p>
                </div>

                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A',0,1)) }}
                </div>

            </div>

            {{-- Dropdown menu --}}
            <div class="dropdown-menu-user" id="userDropdownMenu">

                <a href="{{ route('admin.profile.edit') }}">
                    <i class="fa-solid fa-user"></i>
                    Profil
                </a>

                <a href="{{ route('admin.settings.index') }}">
                    <i class="fa-solid fa-gear"></i>
                    Paramètres
                </a>

                <hr>

                <a href="#"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Déconnexion
                </a>

                <form id="logout-form"
                      action="{{ route('logout') }}"
                      method="POST"
                      style="display:none;">
                    @csrf
                </form>

            </div>

        </div>

    </div>

</div>