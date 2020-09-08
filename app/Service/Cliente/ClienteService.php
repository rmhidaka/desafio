<?php

namespace App\Service\Cliente;

use App\Models\Cliente;
use App\Repository\Cliente\ClienteRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ClienteService implements ClienteServiceInterface
{
    protected $repository;

    public function __construct( ClienteRepositoryInterface $repository )
    {
        $this->repository = $repository;
    }

    public function all()
    {
        return $this->repository->all();
    }
    public function show($id): Cliente
    {
        return $this->repository->find($id);
    }
    public function store($data): Cliente
    {
        return $this->repository->store($data);
    }
    public function update($data,  $id): bool
    {
        $cliente = $this->repository->find($id);
        return $this->repository->update($data, $cliente);
    }
    public function destroy($id):bool
    {
        $cliente = $this->repository->find($id);
        return $this->repository->destroy($cliente);
    }


}
