<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;

    protected $table = 'clientes';

    protected $fillable = [
        'primeiro_nome',
        'ultimo_nome',
        'email',
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
