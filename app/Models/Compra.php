<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Compra extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'compra';
    protected $primaryKey = 'cpr_codigo';

    protected $fillable = [
        'cpr_emissao',
        'cpr_valor',
        'cpr_desconto',
        'cpr_total',
        'cpr_dtentrada',
        'cpr_obs',
        'usu_codigo',
        'for_codigo'
    ];

    protected $guarded = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // Relacionamento com model de Usuario
    public function usuario(): BelongsTo {
        return $this->belongsTo(Usuario::class, 'usu_codigo', 'usu_codigo');
    }

    // Relacionamento com modelo de Fornecedor
    public function fornecedor(): BelongsTo {
        return $this->belongsTo(Fornecedor::class, 'for_codigo', 'for_codigo');
    }

    // Relacionamento com modelo de CompraProduto
    public function compraProdutos(): HasMany {
        return $this->hasMany(CompraProduto::class, 'cpr_codigo', 'cpra_codigo');
    }
}
