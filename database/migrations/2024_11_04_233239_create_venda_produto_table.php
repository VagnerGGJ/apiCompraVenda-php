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
        Schema::create('venda_produto', function (Blueprint $table) {
            $table->id('vep_codigo'); // Serial (Auto-increment)
            $table->decimal('vep_qtde', 18, 4); // Quantidade vendida
            $table->decimal('vep_preco', 18, 2); // Preço unitário
            $table->decimal('vep_desconto', 18, 2)->nullable(); // Desconto aplicado
            $table->decimal('vep_total', 18, 2); // Total da venda
            $table->unsignedBigInteger('vda_codigo'); // Chave estrangeira para a tabela venda
            $table->unsignedBigInteger('pro_codigo'); // Chave estrangeira para a tabela produto

            $table->timestamps(); // Created_at e Updated_at
            $table->softDeletes(); // Deleted_at

            $table->foreign('pro_codigo')->references('pro_codigo')->on('produto'); // Relacionamento com produto
            $table->foreign('vda_codigo')->references('vda_codigo')->on('venda'); // Relacionamento com venda
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venda_produto');
    }
};
