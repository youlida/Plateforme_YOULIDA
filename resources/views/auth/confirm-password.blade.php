<x-guest-layout>

    {{-- Logo YOULIDA --}}
    <div class="text-center mb-6">
        <img
            src="{{ asset('images/logo.png') }}"
            alt="Logo YOULIDA"
            style="
                max-width: 200px;
                max-height: 120px;
                margin: 0 auto 20px auto;
                display: block;
            "
        >

        <h2 style="
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 8px;
        ">
            Confirmation du mot de passe
        </h2>
    </div>

    {{-- Message --}}
    <div class="mb-4 text-sm text-gray-600">
        Cette section est sécurisée.
        Veuillez confirmer votre mot de passe avant de continuer.
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        {{-- Mot de passe --}}
        <div>
            <x-input-label
                for="password"
                value="Mot de passe"
            />

            <div style="position: relative;">

                <x-text-input
                    id="password"
                    class="block mt-1 w-full"
                    style="padding-right: 50px;"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    autofocus
                />

                {{-- Bouton œil --}}
                <button
                    type="button"
                    id="togglePassword"
                    aria-label="Afficher le mot de passe"
                    aria-pressed="false"
                    style="
                        position: absolute;
                        right: 12px;
                        top: 50%;
                        transform: translateY(-50%);
                        border: none;
                        background: transparent;
                        cursor: pointer;
                        padding: 5px;
                        color: #6b7280;
                        z-index: 10;
                    "
                >
                    {{-- Œil --}}
                    <svg
                        id="eyeOpen"
                        xmlns="http://www.w3.org/2000/svg"
                        width="21"
                        height="21"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="M2.062 12.348a1 1 0 0 1 0-.696
                                 10.75 10.75 0 0 1 19.876 0
                                 1 1 0 0 1 0 .696
                                 10.75 10.75 0 0 1-19.876 0"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>

                    {{-- Œil barré --}}
                    <svg
                        id="eyeClosed"
                        xmlns="http://www.w3.org/2000/svg"
                        width="21"
                        height="21"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        style="display: none;"
                    >
                        <path d="m2 2 20 20"/>
                        <path d="M6.71 6.71
                                 C4.98 7.89 3.61 9.6 2.75 11.6
                                 a1 1 0 0 0 0 .8
                                 C4.6 16.7 8 19 12 19
                                 c1.43 0 2.76-.29 3.96-.82"/>
                        <path d="M10.73 5.08
                                 C11.15 5.03 11.57 5 12 5
                                 c4 0 7.4 2.3 9.25 6.6
                                 a1 1 0 0 1 0 .8
                                 c-.46 1.08-1.04 2.04-1.72 2.87"/>
                        <path d="M14.12 14.12
                                 A3 3 0 0 1 9.88 9.88"/>
                    </svg>

                </button>
            </div>

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />
        </div>

        {{-- Bouton confirmation --}}
        <div class="flex justify-end mt-6">
            <x-primary-button>
                Confirmer
            </x-primary-button>
        </div>

    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const password = document.getElementById('password');
            const toggle = document.getElementById('togglePassword');

            const eyeOpen = document.getElementById('eyeOpen');
            const eyeClosed = document.getElementById('eyeClosed');

            if (!password || !toggle) {
                return;
            }

            toggle.addEventListener('click', function () {

                const hidden = password.type === 'password';

                password.type = hidden
                    ? 'text'
                    : 'password';

                eyeOpen.style.display = hidden
                    ? 'none'
                    : 'block';

                eyeClosed.style.display = hidden
                    ? 'block'
                    : 'none';

                toggle.setAttribute(
                    'aria-label',
                    hidden
                        ? 'Masquer le mot de passe'
                        : 'Afficher le mot de passe'
                );

                toggle.setAttribute(
                    'aria-pressed',
                    hidden ? 'true' : 'false'
                );

            });

        });
    </script>

</x-guest-layout>
