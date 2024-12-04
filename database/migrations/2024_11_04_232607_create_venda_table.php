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
        Schema::create('venda', function (Blueprint $table) {
            $table->id('vda_codigo'); // Serial (Auto increment)
            $table->date('vda_data'); // Data da venda
            $table->decimal('vda_valor', 12, 2); // Valor total da venda
            $table->decimal('vda_desconto', 12, 2)->nullable(); // Desconto aplicado
            $table->decimal('vda_total', 12, 2); // Total após descontos
            $table->text('vda_obs')->nullable(); // Observações sobre a venda
            $table->unsignedBigInteger('usu_codigo'); // Chave estrangeira para a tabela usuário
            $table->unsignedBigInteger('cli_codigo'); // Chave estrangeira para a tabela cliente

            $table->timestamps(); // Created_at e Updated_at
            $table->softDeletes(); // Deleted_at

            $table->foreign('cli_codigo')->references('cli_codigo')->on('cliente'); // Relacionamento com cliente
            $table->foreign('usu_codigo')->references('usu_codigo')->on('usuario'); // Relacionamento com usuário
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venda');
    }
};
