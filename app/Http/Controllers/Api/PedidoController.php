<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\PedidoStoreRequest;
use App\Http\Requests\PedidoUpdateRequest;
use App\Service\Pedido\PedidoServiceInterface;

class PedidoController extends ApiBaseController
{
    protected $service;

    public function __construct( PedidoServiceInterface $service )
    {
        $this->service = $service;
    }
    public function index()
    {
        try {
            $result = $this->service->all();
            return $this->sendResponse($result,'Listagem de pedidos.');
        } catch (\Exception $e) {
            return $this->sendError($e, 'Não foi possível listar os pedidos.');
        }
    }

    public function store(PedidoStoreRequest $request)
    {
        try {
            $validated = $request->validated();
            $result = $this->service->store($validated);
            return $this->sendResponse($result,'pedido cadastrado.');
        } catch (\Exception $e) {
            return $this->sendError($e, 'Não foi possível cadastrar o pedido.');
        }
    }

    public function show($id)
    {
        try {
            $result = $this->service->show($id);
            return $this->sendResponse($result,'pedido localizado.');
        } catch (\Exception $e) {
            return $this->sendError($e, 'Não foi possível localizar o pedido.');
        }
    }

    public function update(PedidoUpdateRequest $request, $id)
    {
        try {
            $validated = $request->validated();
            $result = $this->service->update($validated, $id);
            return $this->sendResponse($result,'pedido atualizado.');
        } catch (\Exception $e) {
            return $this->sendError($e, 'Não foi possível atualizar o pedido.');
        }
    }

    public function destroy( $id)
    {
        try {
            $result = $this->service->destroy($id);
            return $this->sendResponse($result,'pedido deletado.');
        } catch (\Exception $e) {
            return $this->sendError($e, 'Não foi possível deletar o pedido.');
        }
    }
}
