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
            Réinitialiser le mot de passe
        </h2>

        <p style="
            color: #6b7280;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        ">
            Définissez un nouveau mot de passe sécurisé
            pour votre compte YOULIDA.
        </p>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        {{-- Token de réinitialisation --}}
        <input
            type="hidden"
            name="token"
            value="{{ $request->route('token') }}"
        >

        {{-- Adresse email --}}
        <div>
            <x-input-label
                for="email"
                value="Adresse email"
            />

            <x-text-input
                id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                :value="old('email', $request->email)"
                required
                autofocus
                autocomplete="username"
            />

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2"
            />
        </div>

        {{-- Nouveau mot de passe --}}
        <div class="mt-4">

            <x-input-label
                for="password"
                value="Nouveau mot de passe"
            />

            <div style="position: relative;">

                <x-text-input
                    id="password"
                    class="block mt-1 w-full"
                    style="padding-right: 50px;"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                />

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

                    {{-- Œil visible --}}
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
                        <path
                            d="M2.062 12.348a1 1 0 0 1 0-.696
                            10.75 10.75 0 0 1 19.876 0
                            1 1 0 0 1 0 .696
                            10.75 10.75 0 0 1-19.876 0"
                        />
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
                        <path
                            d="M6.71 6.71
                            C4.98 7.89 3.61 9.6 2.75 11.6
                            a1 1 0 0 0 0 .8
                            C4.6 16.7 8 19 12 19
                            c1.43 0 2.76-.29 3.96-.82"
                        />
                        <path
                            d="M10.73 5.08
                            C11.15 5.03 11.57 5 12 5
                            c4 0 7.4 2.3 9.25 6.6
                            a1 1 0 0 1 0 .8
                            c-.46 1.08-1.04 2.04-1.72 2.87"
                        />
                        <path
                            d="M14.12 14.12
                            A3 3 0 0 1 9.88 9.88"
                        />
                    </svg>

                </button>
            </div>

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />

        </div>

        {{-- Confirmation du mot de passe --}}
        <div class="mt-4">

            <x-input-label
                for="password_confirmation"
                value="Confirmer le nouveau mot de passe"
            />

            <div style="position: relative;">

                <x-text-input
                    id="password_confirmation"
                    class="block mt-1 w-full"
                    style="padding-right: 50px;"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <button
                    type="button"
                    id="togglePasswordConfirmation"
                    aria-label="Afficher la confirmation du mot de passe"
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

                    {{-- Œil visible --}}
                    <svg
                        id="eyeConfirmOpen"
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
                        <path
                            d="M2.062 12.348a1 1 0 0 1 0-.696
                            10.75 10.75 0 0 1 19.876 0
                            1 1 0 0 1 0 .696
                            10.75 10.75 0 0 1-19.876 0"
                        />
                        <circle cx="12" cy="12" r="3"/>
                    </svg>

                    {{-- Œil barré --}}
                    <svg
                        id="eyeConfirmClosed"
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
                        <path
                            d="M6.71 6.71
                            C4.98 7.89 3.61 9.6 2.75 11.6
                            a1 1 0 0 0 0 .8
                            C4.6 16.7 8 19 12 19
                            c1.43 0 2.76-.29 3.96-.82"
                        />
                        <path
                            d="M10.73 5.08
                            C11.15 5.03 11.57 5 12 5
                            c4 0 7.4 2.3 9.25 6.6
                            a1 1 0 0 1 0 .8
                            c-.46 1.08-1.04 2.04-1.72 2.87"
                        />
                        <path
                            d="M14.12 14.12
                            A3 3 0 0 1 9.88 9.88"
                        />
                    </svg>

                </button>
            </div>

            <x-input-error
                :messages="$errors->get('password_confirmation')"
                class="mt-2"
            />

        </div>

        {{-- Bouton --}}
        <div class="mt-6">

            <x-primary-button
                style="
                    width: 100%;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    padding: 12px 20px;
                "
            >
                Réinitialiser le mot de passe
            </x-primary-button>

        </div>

    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            /**
             * Active le bouton afficher / masquer
             * pour un champ de mot de passe.
             */
            function setupPasswordToggle(
                inputId,
                buttonId,
                eyeOpenId,
                eyeClosedId
            ) {
                const input = document.getElementById(inputId);
                const button = document.getElementById(buttonId);
                const eyeOpen = document.getElementById(eyeOpenId);
                const eyeClosed = document.getElementById(eyeClosedId);

                if (!input || !button || !eyeOpen || !eyeClosed) {
                    return;
                }

                button.addEventListener('click', function () {

                    const isHidden = input.type === 'password';

                    input.type = isHidden
                        ? 'text'
                        : 'password';

                    eyeOpen.style.display = isHidden
                        ? 'none'
                        : 'block';

                    eyeClosed.style.display = isHidden
                        ? 'block'
                        : 'none';

                    button.setAttribute(
                        'aria-pressed',
                        isHidden ? 'true' : 'false'
                    );

                    button.setAttribute(
                        'aria-label',
                        isHidden
                            ? 'Masquer le mot de passe'
                            : 'Afficher le mot de passe'
                    );
                });
            }

            {{-- Nouveau mot de passe --}}
            setupPasswordToggle(
                'password',
                'togglePassword',
                'eyeOpen',
                'eyeClosed'
            );

            {{-- Confirmation --}}
            setupPasswordToggle(
                'password_confirmation',
                'togglePasswordConfirmation',
                'eyeConfirmOpen',
                'eyeConfirmClosed'
            );

        });
    </script>

</x-guest-layout>
