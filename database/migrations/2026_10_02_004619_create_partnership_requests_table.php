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
        Schema::create('partnership_requests', function (Blueprint $table) {
            $table->id();

            $table->string('reference')->unique();

            // Informations du partenaire
            $table->string('organization');
            $table->string('contact_name');
            $table->string('contact_function')->nullable();

            $table->string('email');
            $table->string('phone')->nullable();

            // Proposition de collaboration
            $table->text('proposal');

            // Souhaite être recontacté
            $table->boolean('wants_callback')->default(true);

            // Gestion interne YOULIDA
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
        Schema::dropIfExists('partnership_requests');
    }
};
