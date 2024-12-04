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
        Schema::create('compra_produto', function (Blueprint $table) {
            $table->id('cpp_codigo'); // Serial (Auto-increment)
            $table->decimal('cpp_qtde', 18, 4)->nullable(); // Quantidade
            $table->decimal('cpp_preco', 18, 2)->nullable(); // Preço
            $table->decimal('cpp_desconto', 18, 2)->nullable(); // Desconto
            $table->decimal('cpp_total', 18, 2)->nullable(); // Total
            $table->unsignedBigInteger('cpr_codigo'); // Chave estrangeira para compra
            $table->unsignedBigInteger('pro_codigo'); // Chave estrangeira para produto

            $table->timestamps(); // Created_at & Updated_at
            $table->softDeletes(); // Deleted_at

            // Chave estrangeira referenciando a tabela 'compra'
            $table->foreign('cpr_codigo')->references('cpr_codigo')->on('compra');
            // Chave estrangeira referenciando a tabela 'produto'
            $table->foreign('pro_codigo')->references('pro_codigo')->on('produto');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compra_produto');
    }
};
