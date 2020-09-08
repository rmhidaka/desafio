<?php

namespace App\Service\Cliente;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Collection;

interface ClienteServiceInterface
{
    public function all();
    public function show($id): Cliente;
    public function store($data): Cliente;
    public function update($data,  $id): bool ;
    public function destroy($id):bool ;
}
