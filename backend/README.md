# Backend

O projeto é feito em Node.js

## Ferramentas principais

Yarn

## Iniciar o projeto

yarn start || npm start

## Rotas

Rota POST http://${IP}:3333/address => Adicionar Endereços
Rota GET http://${IP}:3333/address => Listar Endereços
Rota GET http://${IP}:3333/address/:id => Visualizar Endereço
Rota PUT http://${IP}:3333/address/:id/update => Atualizar Endereço
Rota DELETE http://${IP}:3333/address/:id/destroy => Deletar Endereço

## Arquivos para modificação

.\src\config\database.js => Referente a configuração do banco de dados

## Docker

Dockerfile e docker-compose.yml => Implementado.

Basta dar: docker-compose up

## Feitos

Validações de dados (Registro e Edição)
