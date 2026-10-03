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
            Mot de passe oublié ?
        </h2>

        <p style="
            color: #6b7280;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        ">
            Aucun problème. Saisissez l'adresse email associée
            à votre compte YOULIDA et nous vous enverrons un lien
            permettant de définir un nouveau mot de passe.
        </p>
    </div>

    {{-- Message de succès --}}
    <x-auth-session-status
        class="mb-4"
        :status="session('status')"
    />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

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
                :value="old('email')"
                required
                autofocus
                autocomplete="email"
                placeholder="exemple@email.com"
            />

            <x-input-error
                :messages="$errors->get('email')"
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
                Envoyer le lien de réinitialisation
            </x-primary-button>

        </div>

        {{-- Retour connexion --}}
        <div style="
            text-align: center;
            margin-top: 20px;
        ">

            <a
                href="{{ url('/94f7e939e071893f12e157ef3d5abc5932d776e9') }}"
                style="
                    color: #2563eb;
                    text-decoration: none;
                    font-size: 14px;
                    font-weight: 500;
                "
            >
                ← Retour à la connexion
            </a>

        </div>

    </form>

</x-guest-layout>
