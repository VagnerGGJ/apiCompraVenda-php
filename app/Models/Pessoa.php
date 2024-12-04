<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pessoa extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'pessoa';
    protected $primaryKey = 'pes_codigo';

    protected $fillable = [
        'pes_nome',
        'pes_fantasia',
        'pes_fisica',
        'pes_cpfcnpj',
        'pes_rgie',
        'pes_dtcadastro',
        'pes_endereco',
        'pes_numero',
        'pes_complemento',
        'pes_bairro',
        'pes_cidade',
        'pes_uf',
        'pes_cep',
        'pes_fone1',
        'pes_fone2',
        'pes_celular',
        'pes_site',
        'pes_email',
        'pes_ativo'
    ];

    protected $guarded = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // Relacionamento com model Fornecedor
    public function fornecedor(): HasOne {
        return $this->hasOne(Fornecedor::class, 'pes_codigo', 'pes_codigo');
    }

    // Relacionamento com model Cliente
    public function cliente(): HasOne {
        return $this->hasOne(Cliente::class, 'pes_codigo', 'pes_codigo');
    }
}
