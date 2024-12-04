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
        Schema::create('produto', function (Blueprint $table) {
            $table->id('pro_codigo'); // Serial (Auto-increment)
            $table->string('pro_nome', 80)->nullable(); // Nome do produto
            $table->decimal('pro_estoque', 18, 4)->nullable(); // Quantidade em estoque
            $table->string('pro_unidade', 5)->nullable(); // Unidade de medida
            $table->decimal('pro_preco', 18, 2)->nullable(); // Preço de venda
            $table->decimal('pro_custo', 18, 2)->nullable(); // Custo do produto
            $table->decimal('pro_atacado', 18, 2)->nullable(); // Preço de atacado
            $table->decimal('pro_min', 18, 4)->nullable(); // Estoque mínimo
            $table->decimal('pro_max', 18, 4)->nullable(); // Estoque máximo
            $table->decimal('pro_embalagem', 18, 4)->nullable(); // Tipo de embalagem (PC, MT, KG)
            $table->decimal('pro_peso', 18, 4)->nullable(); // Peso do produto
            $table->date('pro_dtcadastro')->nullable(); // Data de cadastro
            $table->text('pro_obs')->nullable(); // Observações
            $table->char('pro_ativo', 1)->default('1'); // Ativo (1="Sim" e 0="Não")
            $table->char('pro_tipo', 1)->nullable(); // Tipo de produto (por exemplo: F - físico, V - virtual)

            $table->timestamps(); // Created_at e Updated_at
            $table->softDeletes(); // Deleted_at
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produto');
    }
};
