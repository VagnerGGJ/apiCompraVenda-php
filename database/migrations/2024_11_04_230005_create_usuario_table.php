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
        Schema::create('usuario', function (Blueprint $table) {
            $table->id('usu_codigo');
            $table->unsignedBigInteger('gru_codigo');
            $table->string('usu_nome', 80)->nullable();
            $table->string('usu_login', 50)->unique();
            $table->string('usu_senha', 80);
            $table->date('usu_cadastro')->nullabel(); 
            $table->char('usu_ativo', 1)->default('1');

          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
