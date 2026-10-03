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
            Vérifiez votre adresse email
        </h2>

        <p style="
            color: #6b7280;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        ">
            Merci pour votre inscription sur YOULIDA.
            Avant de continuer, veuillez vérifier votre adresse email
            en cliquant sur le lien que nous venons de vous envoyer.
        </p>
    </div>


    {{-- Message si un nouvel email a été envoyé --}}
    @if (session('status') == 'verification-link-sent')

        <div style="
            background-color: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #047857;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 20px;
            line-height: 1.5;
        ">
            ✓ Un nouveau lien de vérification a été envoyé
            à l'adresse email associée à votre compte.
        </div>

    @endif


    {{-- Information --}}
    <div style="
        background-color: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 16px;
        margin-bottom: 20px;
    ">

        <p style="
            color: #4b5563;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        ">
            Vous n'avez pas reçu l'email ?
            Vérifiez d'abord votre dossier
            <strong>Spam / Courrier indésirable</strong>.
            Vous pouvez également demander l'envoi
            d'un nouveau lien ci-dessous.
        </p>

    </div>


    {{-- Renvoyer l'email --}}
    <form
        method="POST"
        action="{{ route('verification.send') }}"
    >
        @csrf

        <div style="margin-top: 20px;">

            <x-primary-button
                style="
                    width: 100%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    padding: 12px 20px;
                "
            >
                Renvoyer l'email de vérification
            </x-primary-button>

        </div>

    </form>


    {{-- Séparateur --}}
    <div style="
        display: flex;
        align-items: center;
        margin: 24px 0;
    ">

        <div style="
            flex: 1;
            height: 1px;
            background-color: #e5e7eb;
        "></div>

        <span style="
            padding: 0 12px;
            color: #9ca3af;
            font-size: 12px;
        ">
            OU
        </span>

        <div style="
            flex: 1;
            height: 1px;
            background-color: #e5e7eb;
        "></div>

    </div>


    {{-- Déconnexion --}}
    <form
        method="POST"
        action="{{ route('logout') }}"
    >
        @csrf

        <button
            type="submit"
            style="
                width: 100%;
                padding: 11px 20px;
                background: white;
                color: #4b5563;
                border: 1px solid #d1d5db;
                border-radius: 7px;
                cursor: pointer;
                font-size: 14px;
                font-weight: 600;
                transition: 0.2s;
            "
            onmouseover="
                this.style.backgroundColor='#f9fafb';
                this.style.color='#111827';
            "
            onmouseout="
                this.style.backgroundColor='white';
                this.style.color='#4b5563';
            "
        >
            Se déconnecter
        </button>

    </form>

</x-guest-layout>
