<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompraProduto extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'compra_produto';
    protected $primaryKey = 'cpr_codigo';

    protected $fillable = [
        'cpr_qtde',
        'cpr_preco',
        'cpr_desconto',
        'cpr_total',
        'cpr_codigo',
        'pro_codigo'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // Relacionamento com modelo de Compra
    public function compra(): BelongsTo {
        return $this->belongsTo(Compra::class, 'cpr_codigo');
    }

    // Relacionamento com modelo de Produto
    public function protudo(): BelongsTo {
        return $this->belongsTo(Produto::class, 'pro_codigo');
    }
}
