<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnderecoRequest;
use App\Http\Resources\EnderecoCollection;
use App\Http\Resources\EnderecoResource;
use App\Repositories\EnderecoRepository;
use App\Services\EnderecoService;
use Illuminate\Http\Request;

class EnderecoController extends Controller
{
    private $enderecoRepository;

    public function __construct(EnderecoRepository $enderecoRepository) {
        $this->enderecoRepository  = $enderecoRepository;
    }
    public function consultarCep(Request $request) {
        $result = $this->enderecoRepository->encontrarCep($request->cep);
        return new EnderecoResource($result);
    }

    public function consultarEndereco(Request $request) {
        $result = $this->enderecoRepository->encontrarEndereco($request->endereco);
        return new EnderecoCollection($result);
    }

    public function consultarUf(Request $request) {
        $result = $this->enderecoRepository->encontrarUf($request->uf);
        return new EnderecoCollection($result);
    }

    public function cadastrar(EnderecoRequest $request) {
        $fields = [
            'cep' => $request->cep,
            'logradouro' => $request->logradouro,
            'bairro' => $request->bairro,
            'municipio' => $request->municipio,
            'uf' => $request->uf
        ];
        try {
            $result = $this->enderecoRepository->cadastrarEndereco($fields);
            return new EnderecoResource($result);
        } catch (\Exception $exception) {
            return response()->json(['errors' => ['message' => 'Erro interno ao tentar inserir no banco de dados']], 500);
        }
    }

    public function editar(EnderecoRequest $request) {
        $fields = [
            'cep' => $request->cep,
            'logradouro' => $request->logradouro,
            'bairro' => $request->bairro,
            'municipio' => $request->municipio,
            'uf' => $request->uf
        ];
        try {
            $result = $this->enderecoRepository->editarEndereco($fields);
            return new EnderecoResource($result);
        } catch (\Exception $exception) {
            return response()->json(['errors' => ['message' => 'Erro interno ao tentar editar no banco de dados']], 500);
        }
    }
}
