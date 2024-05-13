# Consulta Cep

## Objetivo

- Criar uma API para consultas de CEPs e endereços

## Dependencias
- Docker

## Tecnologias
- PHP
- Laravel
- MySQL

## Iniciando o projeto

### Clonar Repositório
```bash
git clone https://github.com/HnkAlbuquerque/consulta-cep.git
```

### Antes de rodar o docker certifique que você tenha as seguintes portas disponíveis em seu ambiente
```bash
NGINX: 7000
MYSQL: 9306
PHP: 9004
```

### Executar o docker
```bash
docker-compose up -d --build
```

### Rode o composer para instalar as dependencias
```bash
docker-compose exec php composer install
```

### Arquivo de ambiente
```bash
docker-compose exec php cp .env.example .env
```

### Configure a conexão com o banco de dados no seu .env
```bash
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=db_app
DB_USERNAME=db_app
DB_PASSWORD=root
```

### Aplicações laravel precisam de uma chave de aplicação
```bash
docker-compose exec php php artisan key:generate
```

### Execute as migrations
```bash
docker-compose exec php php artisan migrate
```

### Popule o banco de dados para realizar transações
```bash
docker-compose exec php php artisan db:seed DatabaseSeeder
```

### Execute os testes
```bash
docker-compose exec php php artisan test
```

## Sobre a API
- Você poderá acessar a aplicação a partir do host http://localhost:7000
- A api conta com documentação online feita com SWAGGER, basta acessar http://localhost:7000/api/documentation/ para ver os detalhes das rotas.

### Consulta
- Faça uma requisição `GET` para `api/consultar-cep/{cep}` onde `{cep}` é o número do logadrouro que deja as informações.

### Resposta do Payload
Se tudo ocorrer bem será retornado o endereço completo como resultado da consulta
```json
{
  "cep": "13181796",
  "logradouro": "Rua Rozendo Alves de Souza",
  "bairro": "Jardim Calegari (Nova Veneza)",
  "municipio": "Sumaré",
  "uf": "SP"
}
```

### Cadastro de um novo cep na base de dados
- Faça uma requisição `POST` para `api/cadastrar-cep`.

### Payload
Informe um payload JSON no seguinte formato abaixo
```json
{
  "cep": "13181796",
  "logradouro": "Rua Rozendo Alves de Souza",
  "bairro": "Jardim Calegari (Nova Veneza)",
  "municipio": "Sumaré",
  "uf": "SP"
}
```
### Resposta do Payload
Se tudo ocorrer bem será retornado o endereço completo como resultado da consulta como na requisição `GET` acima.

### Consultas por logradouro ou UF
- Faça uma requisição `GET` para `api/consultar-uf/{uf}` onde `{uf}` é a unidade federal.
- Faça uma requisição `GET` para `api/consultar-endereco/{endereco}` onde `{endereco}` é o nome do logradouro.

### Resposta do Payload
Ambas as requisições retornarão uma lista de endereços.
Exemplo de uma resposta em que foi filtrado um endereço por `UF`

```json
{
  "data": [
    {
      "cep": "14535174",
      "logradouro": "R. Paz",
      "bairro": "Brito do Norte",
      "municipio": "Arruda do Sul",
      "uf": "SP"
    },
    {
      "cep": "13181796",
      "logradouro": "Rua Rozendo Alves de Souza",
      "bairro": "Jardim Calegari (Nova Veneza)",
      "municipio": "Sumaré",
      "uf": "SP"
    }
  ]
}
```

### Em caso de ERROS
Erros são retornados no formato abaixo onde `message` poderá ser mais de uma
```json
{
    "errors": {
        "message": "error message"
    }
}
```

### Aplicação disponível na plataforma RAILWAY
<https://consulta-cep-railway-production.up.railway.app/api/documentation>
