<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormaPagamento extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'forma_pagamento';
    protected $primaryKey = 'fpg_codigo';

    protected $fillable = [
        'fpg_nome',
        'fpg_ativo'
    ];

    protected $guarded = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // Relacionamento com model VendaFormaPagamento
    public function vendasFormaPagamento(): HasMany {
        return $this->hasMany(VendaFormaPagamento::class, 'fpg_codigo');
    }
}
