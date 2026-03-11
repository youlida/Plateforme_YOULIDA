<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('prenom')->nullable()->after('name');
            $table->string('telephone')->nullable()->after('email');
            $table->string('ip_address', 45)->nullable()->after('telephone');
            $table->string('pays')->nullable()->after('ip_address');
            $table->string('ville')->nullable()->after('pays');
            $table->boolean('is_active')->default(true)->after('ville');
            $table->timestamp('last_login_at')->nullable()->after('is_active');
            $table->foreignId('role_id')->nullable()->after('last_login_at')->constrained('roles')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn([
                'prenom',
                'telephone',
                'ip_address',
                'pays',
                'ville',
                'is_active',
                'last_login_at',
                'role_id',
            ]);
        });
    }
};