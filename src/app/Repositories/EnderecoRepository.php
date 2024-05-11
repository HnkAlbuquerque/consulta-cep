<?php

namespace App\Repositories;

use App\Exceptions\SQLException;
use App\Models\Endereco;

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
}
