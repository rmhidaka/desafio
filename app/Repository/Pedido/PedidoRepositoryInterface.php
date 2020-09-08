<?php

namespace App\Repository\Pedido;

use App\Models\Pedido;
use Illuminate\Database\Eloquent\Collection;

interface PedidoRepositoryInterface
{
    public function all();
    public function find($id): Pedido;
    public function store($data): Pedido;
    public function update($data, Pedido $pedido): bool ;
    public function destroy(Pedido $pedido):bool ;
}
