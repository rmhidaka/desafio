<?php

namespace App\Repository\Cliente;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Collection;

interface ClienteRepositoryInterface
{
    public function all();
    public function find($id): Cliente;
    public function store($data): Cliente;
    public function update($data, Cliente $cliente): bool ;
    public function destroy(Cliente $cliente):bool ;
}
