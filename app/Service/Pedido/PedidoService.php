<?php

namespace App\Service\Pedido;

use App\Models\Pedido;
use App\Repository\Pedido\PedidoRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PedidoService implements PedidoServiceInterface
{
    protected $repository;

    public function __construct( PedidoRepositoryInterface $repository )
    {
        $this->repository = $repository;
    }

    public function all()
    {
        return $this->repository->all();
    }
    public function show($id): Pedido
    {
        return $this->repository->find($id);
    }
    public function store($data): Pedido
    {
        return $this->repository->store($data);
    }
    public function update($data,  $id): bool
    {
        $pedido = $this->repository->find($id);
        return $this->repository->update($data, $pedido);
    }
    public function destroy($id):bool
    {
        $pedido = $this->repository->find($id);
        return $this->repository->destroy($pedido);
    }


}
