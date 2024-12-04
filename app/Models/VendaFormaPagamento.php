<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendaFormaPagamento extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'venda_forma_pagamento';
    protected $primaryKey = 'vdp_codigo';

    protected $fillable = [
        'vdp_valor',
        'vda_codigo',
        'fpg_codigo',
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

    // Relacionamento com model FomraPagamento
    public function formaPagamento(): BelongsTo {
        return $this->belongsTo(FormaPagamento::class, 'fpg_codigo', 'fpg_codigo');
    }
}
