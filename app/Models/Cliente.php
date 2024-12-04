<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'cliente';
    protected $primaryKey = 'cli_codigo';

    protected $fillable = [
        'cli_limitecred',
        'pes_codigo'
    ];

    protected $guarded = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // Relacionamento com o model de Pessoa.
    public function pessoa(): BelongsTo {
        return $this->belongsTo(Pessoa::class, 'pes_codigo', 'pes_codigo');
    }

    // Relacionamento com o model de Vendas.
    public function vendas(): HasMany {
        return $this->hasMany(Venda::class, 'cli_codigo', 'cli_codigo');
    }
}
