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
        Schema::create('venda_forma_pagamento', function (Blueprint $table) {
            $table->id('vdp_codigo'); // Serial (Auto-increment)
            $table->decimal('vdp_valor', 18, 2); // Valor do pagamento
            $table->unsignedBigInteger('vda_codigo'); // Chave estrangeira para a tabela venda
            $table->unsignedBigInteger('fpg_codigo'); // Chave estrangeira para a tabela formapagto

            $table->timestamps(); // Created_at & Updated_at
            $table->softDeletes(); // Deleted_at

            $table->foreign('fpg_codigo')->references('fpg_codigo')->on('forma_pagamento'); // Relacionamento com formapagto
            $table->foreign('vda_codigo')->references('vda_codigo')->on('venda'); // Relacionamento com venda
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venda_forma_pagamento');
    }
};
