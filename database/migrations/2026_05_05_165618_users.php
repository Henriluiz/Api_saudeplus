<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('nome');
            $table->string('email')->unique();

            $table->enum('genero', [
                'MASCULINO',
                'FEMININO',
                'OUTRO',
                'PREFIRO_NAO_INFORMAR'
            ]);

            $table->string('senha');
            $table->date('data_nascimento');

            // NOVOS CAMPOS
            $table->decimal('peso', 5, 2)->nullable();
            $table->decimal('altura', 5, 2)->nullable(); // cm
            $table->enum('tipo_sanguineo', [
                'A+', 'A-',
                'B+', 'B-',
                'AB+', 'AB-',
                'O+', 'O-'
            ])->nullable();

            // FOTO
            $table->string('foto_perfil')->nullable();

            $table->string('status_usuario')->default('ativo');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};