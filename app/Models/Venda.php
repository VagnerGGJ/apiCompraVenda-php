<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venda extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'venda';
    protected $primaryKey = 'vda_codigo';

    protected $fillable = [
        'vda_data',
        'vda_valor',
        'vda_desconto',
        'vda_total',
        'vda_obs',
        'usu_codigo',
        'cli_codigo', 
    ];

    protected $guarded = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // Relacionamento com model Cliente
    public function cliente(): BelongsTo {
        return $this->belongsTo(Cliente::class, 'cli_codigo', 'cli_codigo');
    }

    // Relacionamento com model Usuario
    public function usuario(): BelongsTo {
        return $this->belongsTo(Usuario::class, 'usu_codigo', 'usu_codigo');
    }

    // Relacionamento com model VendaProduto
    public function vendaProduto(): HasMany {
        return $this->hasMany(VendaProduto::class, 'vda_codigo', 'vda_codigo');
    }

    // Relacionamento com model VendaFormaPagamento
    public function vendaFormaPagamento(): HasMany {
        return $this->hasMany(VendaFormaPagamento::class, 'vda_codigo', 'vda_codigo');
    }
}
