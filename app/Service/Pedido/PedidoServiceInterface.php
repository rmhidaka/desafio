<?php

namespace App\Service\Pedido;

use App\Models\Pedido;
use Illuminate\Database\Eloquent\Collection;

interface PedidoServiceInterface
{
    public function all();
    public function show($id): Pedido;
    public function store($data): Pedido;
    public function update($data,  $id): bool ;
    public function destroy($id):bool ;
}
