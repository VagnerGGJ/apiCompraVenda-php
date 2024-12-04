<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendaProduto extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'venda_produto';
    protected $primaryKey = 'vep_codigo';

    protected $fillable = [
        'vep_qtde',
        'vep_preco',
        'vep_desconto',
        'vep_total',
        'vda_codigo',
        'pro_codigo',
    ];

    protected $guarded = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // Relacionamento com model Venda
    public function venda(): BelongsTo {
        return $this->belongsTo(Venda::class, 'vda_codigo', 'vda_codigo');
    }

    // Relacionamento com model Produto
    public function produto(): BelongsTo {
        return $this->belongsTo(Produto::class, 'pro_codigo', 'pro_codigo');
    }
}
