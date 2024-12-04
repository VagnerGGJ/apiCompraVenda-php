<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'produto';
    protected $primaryKey = 'pro_codigo';

    protected $fillable = [
        'pro_nome',
        'pro_estoque',
        'pro_unidade',
        'pro_preco',
        'pro_custo',
        'pro_atacado',
        'pro_min',
        'pro_max',
        'pro_embalagem',
        'pro_peso',
        'pro_dtcadastro',
        'pro_obs',
        'pro_ativo',
        'pro_tipo'
    ];

    protected $guarded = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // Relacionamento com model CompraProduto
    public function compraProdutos(): HasMany {
        return $this->hasMany(CompraProduto::class, 'pro_codigo', 'pro_codigo');
    }

    // Relacionamento com model VendaProduto
    public function vendaProduto(): HasMany {
        return $this->hasMany(VendaProduto::class, 'pro_codigo', 'pro_codigo');
    }
}
