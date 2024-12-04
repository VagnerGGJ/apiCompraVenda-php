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
        Schema::create('pessoa', function (Blueprint $table) {
            $table->id('pes_codigo'); // Serial (Auto-increment)
            $table->string('pes_nome', 80)->nullable(); // Nome
            $table->string('pes_fantasia', 80)->nullable(); // Nome Fantasia
            $table->char('pes_fisica', 1)->default('F'); // Pessoa (F)ísica ou (J)urídica
            $table->string('pes_cpfcnpj', 20)->nullable(); // CPF ou CNPJ
            $table->string('pes_rgie', 20)->nullable(); // RG ou IE
            $table->date('pes_dtcadastro')->nullable(); // Data de Cadastro
            $table->string('pes_endereco', 120)->nullable(); // Endereço
            $table->string('pes_numero', 10)->nullable(); // Número
            $table->string('pes_complemento', 30)->nullable(); // Complemento
            $table->string('pes_bairro', 50)->nullable(); // Bairro
            $table->string('pes_cidade', 80)->nullable(); // Cidade
            $table->char('pes_uf', 2)->nullable(); // UF (2 caracteres)
            $table->string('pes_cep', 9)->nullable(); // CEP
            $table->string('pes_fone1', 15)->nullable(); // Telefone 1
            $table->char('pes_fone2', 20)->nullable(); // Telefone 2
            $table->string('pes_celular', 20)->nullable(); // Celular
            $table->string('pes_site', 200)->nullable(); // Site
            $table->string('pes_email', 200)->nullable(); // E-mail
            $table->char('pes_ativo', 1)->default('1'); // Ativo (1="Sim" e 0="Não")
    
            $table->timestamps(); // Created_at e Updated_at
            $table->softDeletes(); // Deleted_at
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pessoa');
    }
};
