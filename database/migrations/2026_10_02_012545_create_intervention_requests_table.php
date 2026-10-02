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
        Schema::create('intervention_requests', function (Blueprint $table) {
            $table->id();

            // Référence unique
            $table->string('reference')->unique();

            // Structure demandeuse
            $table->string('structure_type');
            $table->string('structure_name')->nullable();

            // Personne à contacter
            $table->string('contact_name');
            $table->string('contact_function')->nullable();

            // Au moins téléphone ou e-mail sera exigé
            // dans la validation Laravel
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            // Intervention demandée
            $table->string('location');
            $table->text('need');

            // Public concerné
            $table->string('target_audience');

            // Facultatif
            $table->unsignedInteger('estimated_participants')->nullable();

            // Période souhaitée
            $table->string('desired_period')->nullable();

            // Intervention ponctuelle ou sur une durée
            $table->string('intervention_format');

            $table->string('duration')->nullable();

            // Informations supplémentaires
            $table->text('additional_information')->nullable();


            /*
        |--------------------------------------------------------------------------
        | Traitement interne YOULIDA
        |--------------------------------------------------------------------------
        */

            $table->text('internal_summary')->nullable();

            $table->text('action_taken')->nullable();

            $table->text('follow_up')->nullable();

            $table->string('status')->default('nouveau');

            $table->foreignId('assigned_to')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intervention_requests');
    }
};
