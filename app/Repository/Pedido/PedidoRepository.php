<?php

namespace App\Repository\Pedido;

use App\Models\Pedido;
use App\Repository\Pedido\PedidoRepositoryInterface;
use Exception;

class PedidoRepository implements PedidoRepositoryInterface
{
    protected $pedido;

    public function __construct(Pedido $pedido)
    {
        $this->pedido = $pedido;
    }
    public function all()
    {
        $pedidos = $this->pedido->with('cliente')->orderBy('status')->get();
        $data['pedidos'] = $pedidos;
        $data['novos'] =  $pedidos->where('status', Pedido::NOVO)->count();
        $data['pendentes'] =  $pedidos->where('status', Pedido::PENDENTE)->count();
        $data['entregues'] =  $pedidos->where('status', Pedido::ENTREGUE)->count();
        $data['valorNovos'] =  $pedidos->where('status', Pedido::ENTREGUE)->sum('valor');

        return collect($data);
    }
    public function find($id): Pedido
    {
        $pedido = $this->pedido->find($id);
        if(!$pedido)
            throw new Exception("Pedido não localizado");
        return $pedido;
    }
    public function store($data): Pedido
    {
        return $this->pedido->create($data);
    }
    public function update($data, Pedido $pedido): bool
    {
        return !!$pedido->update($data);
    }
    public function destroy(Pedido $pedido):bool
    {
        return !!$pedido->delete();
    }
}
