<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('youth_messages', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Référence interne
            |--------------------------------------------------------------------------
            */
            $table->string('reference')->unique();

            /*
            |--------------------------------------------------------------------------
            | Contenu envoyé par le jeune
            |--------------------------------------------------------------------------
            */

            // Message écrit - facultatif
            $table->text('message')->nullable();

            // Catégorie choisie - facultative
            $table->string('category')->nullable();

            // Chemin du fichier audio - facultatif
            $table->string('audio_path')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Demande de rappel
            |--------------------------------------------------------------------------
            */

            $table->boolean('wants_callback')->default(false);

            // WhatsApp, appel, SMS, email, autre
            $table->string('callback_channel')->nullable();

            // Numéro de téléphone ou adresse email
            $table->string('contact')->nullable();

            // matin, après-midi, soir, indifférent
            $table->string('callback_time')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Suivi interne YOULIDA
            |--------------------------------------------------------------------------
            */

            // web, whatsapp, sms, appel...
            $table->string('source_channel')->default('web');

            // A, B, C ou D
            $table->string('qualification', 10)->nullable();

            // Résumé interne réalisé par YOULIDA
            $table->text('internal_summary')->nullable();

            // Action effectuée par l'équipe
            $table->text('action_taken')->nullable();

            // Informations de suivi
            $table->text('follow_up')->nullable();

            // nouveau, en_cours, traite, ferme...
            $table->string('status')->default('nouveau');

            /*
            |--------------------------------------------------------------------------
            | Responsable interne
            |--------------------------------------------------------------------------
            */

            $table->foreignId('assigned_to')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Dates
            |--------------------------------------------------------------------------
            */

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('youth_messages');
    }
};
