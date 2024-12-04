<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fornecedor extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'fornecedor';
    protected $primaryKey = 'for_codigo';

    protected $fillable = [
        'for_contato',
        'pes_codigo'
    ];

    protected $guarded = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // Relacionamento com model Pessoa
    public function pessoa(): BelongsTo {
        return $this->belongsTo(Pessoa::class, 'pes_codigo', 'pes_codigo');
    }

    // Relacionamento com model Compra
    public function compra(): HasMany {
        return $this->hasMany(Compra::class, 'for_codigo', 'for_codigo');
    }
}
