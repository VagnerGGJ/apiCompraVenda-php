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
        Schema::create('compra', function (Blueprint $table) {
            $table->id('cpr_codigo'); // Serial (Auto-Increment)
            $table->date('cpr_emissao')->nullable(); // Data de emissão da compra
            $table->decimal('cpr_valor', 18, 2)->nullable(); // Valor da compra
            $table->decimal('cpr_desconto', 18, 2)->nullable(); // Valor de desconto
            $table->decimal('cpr_total', 18, 2)->nullable(); // Valor total
            $table->date('cpr_dtemtentrada')->nullable(); // Data de entrada
            $table->text('cpr_obs')->nullable(); // Observações da compra
            $table->unsignedBigInteger('usu_codigo'); // Chave estrangeira para usuário
            $table->unsignedBigInteger('for_codigo'); // Chave estrangeira para fornecedor
    
            $table->timestamps(); // Created_at e Updated_at
            $table->softDeletes(); // Deleted_at
    
            // Chave estrangeira referenciando a tabela 'usuarios'
            $table->foreign('usu_codigo')->references('usu_codigo')->on('usuario');
            // Chave estrangeira referenciando a tabela 'fornecedores'
            $table->foreign('for_codigo')->references('for_codigo')->on('fornecedor');
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compra');
    }
};
