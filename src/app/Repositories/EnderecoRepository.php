<?php

namespace App\Repositories;

use App\Exceptions\SQLException;
use App\Models\Endereco;
use Illuminate\Support\Facades\DB;

class EnderecoRepository
{
    public function encontrarCep($cep) {
        try {
            return Endereco::where('cep', $cep)->first();
        } catch (\Exception $exception) {
            throw new SQLException('Erro ao consultar banco de dados', 500);
        }
    }

    public function encontrarEndereco($logradouro) {
        try {
            return Endereco::where('logradouro', 'like', "%{$logradouro}%")->get();
        } catch (\Exception $exception) {
            throw new SQLException('Erro ao consultar banco de dados', 500);
        }
    }

    public function encontrarUf($uf) {
        try {
            return Endereco::where('uf', $uf)->get();
        } catch (\Exception $exception) {
            throw new SQLException('Erro ao consultar banco de dados', 500);
        }
    }

    public function cadastrarEndereco($request) {
        $fields = [
            'cep' => $request->cep,
            'logradouro' => $request->logradouro,
            'bairro' => $request->logradouro,
            'municipio' => $request->municipio,
            'uf' => $request->uf
        ];
        return DB::transaction(function () use($fields) {
            return Endereco::create($fields);
        });
    }

    public function editarEndereco($request) {
        $fields = [
            'cep' => $request->cep,
            'logradouro' => $request->logradouro,
            'bairro' => $request->logradouro,
            'municipio' => $request->municipio,
            'uf' => $request->uf
        ];
        return DB::transaction(function () use($fields) {
            Endereco::where('cep', $fields['cep'])->update($fields);
            return Endereco::where('cep', $fields['cep'])->first();
        });
    }
}
