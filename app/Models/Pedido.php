<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use SoftDeletes;

    const NOVO = 1;
    const PENDENTE = 2;
    const ENTREGUE = 3;

    protected $table = 'pedidos';

    protected $casts = [
        'created_at' => 'date'
    ];

    protected $fillable = [
        'cliente_id',
        'status',
        'valor',
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    public function getValorAttribute($value)
    {
        return  number_format($value,2,',','.');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
