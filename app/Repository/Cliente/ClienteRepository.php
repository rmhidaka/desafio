<?php

namespace App\Repository\Cliente;

use App\Models\Cliente;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class ClienteRepository implements ClienteRepositoryInterface
{
    protected $cliente;

    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }
    public function all()
    {
        $clientes = $this->cliente->orderBy('primeiro_nome')->get();
        $data['clientes'] = $clientes;

        return collect($data);
    }
    public function find($id): Cliente
    {
        $cliente = $this->cliente->find($id);
        if(!$cliente)
            throw new Exception("Cliente não localizado");
        return $cliente;
    }
    public function store($data): Cliente
    {
        return $this->cliente->create($data);
    }
    public function update($data, Cliente $cliente): bool
    {
        return !!$cliente->update($data);
    }
    public function destroy(Cliente $cliente):bool
    {
        return !!$cliente->delete();
    }
}
