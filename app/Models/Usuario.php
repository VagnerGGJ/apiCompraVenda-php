<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'usuario';
    protected $primaryKey = 'usu_codigo';

    protected $fillable = [
        'usu_nome',
        'usu_login',
        'usu_senha',
        'usu_cadastro',
        'usu_ativo'
    ];

    protected $guarded = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // Relacionamento com model Compra
    public function compra(): HasMany {
        return $this->hasMany(Compra::class, 'usu_codigo');
    }

    // Relacionamento com model Venda
    public function venda(): HasMany {
        return $this->hasMany(Venda::class, 'usu_codigo');
    }
}
