<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // vamos armazenar o HASH do token (mais seguro do que salvar o token puro)
            $table->string('account_verify_token', 64)->nullable()->unique();
            $table->timestamp('account_verify_expires_at')->nullable();

            // se você já usa email_verified_at, não precisa criar outro
            // se não existir, você pode adicionar:
            // $table->timestamp('email_verified_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['account_verify_token']);
            $table->dropColumn(['account_verify_token', 'account_verify_expires_at']);
        });
    }
};

