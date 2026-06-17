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
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_usuario');

            $table->string('nome');
            // $table->string('username')->unique();
            $table->string('email')->unique();

            $table->string('genero')->nullable();

            $table->decimal('peso_kg', 5, 2)->nullable();
            $table->unsignedSmallInteger('altura_cm')->nullable();

            $table->date('data_nascimento')->nullable();

            $table->string('senha_hash');

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};