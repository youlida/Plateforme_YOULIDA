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
        Schema::create('dons', function (Blueprint $table) {
    $table->id();

    $table->string('donor_name');
    $table->string('email')->nullable();

    $table->decimal('amount', 10, 2);

    $table->string('payment_method')->nullable();
    $table->string('transaction_id')->nullable();

    $table->text('message')->nullable();

    $table->timestamp('donated_at')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dons');
    }
};
