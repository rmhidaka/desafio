<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ClienteStoreRequest;
use App\Http\Requests\ClienteUpdateRequest;
use App\Service\Cliente\ClienteServiceInterface;

class ClienteController extends ApiBaseController
{
    protected $service;

    public function __construct( ClienteServiceInterface $service )
    {
        $this->service = $service;
    }
    public function index()
    {
        try {
            $result = $this->service->all();
            return $this->sendResponse($result,'Listagem de clientes.');
        } catch (\Exception $e) {
            return $this->sendError($e, 'Não foi possível listar os clientes.');
        }
    }

    public function store(ClienteStoreRequest $request)
    {
        try {
            $validated = $request->validated();
            $result = $this->service->store($validated);
            return $this->sendResponse($result,'Cliente cadastrado.');
        } catch (\Exception $e) {
            return $this->sendError($e, 'Não foi possível cadastrar o cliente.');
        }
    }

    public function show($id)
    {
        try {
            $result = $this->service->show($id);
            return $this->sendResponse($result,'Cliente localizado.');
        } catch (\Exception $e) {
            return $this->sendError($e, 'Não foi possível localizar o cliente.');
        }
    }

    public function update(ClienteUpdateRequest $request, $id)
    {
        try {
            $validated = $request->validated();
            $result = $this->service->update($validated, $id);
            return $this->sendResponse($result,'Cliente atualizado.');
        } catch (\Exception $e) {
            return $this->sendError($e, 'Não foi possível atualizar o cliente.');
        }
    }

    public function destroy( $id)
    {
        try {
            $result = $this->service->destroy($id);
            return $this->sendResponse($result,'Cliente deletado.');
        } catch (\Exception $e) {
            return $this->sendError($e, 'Não foi possível deletar o cliente.');
        }
    }
}
