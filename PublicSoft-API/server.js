var express = require('express');
var app = express();
var bodyParser = require('body-parser');
app.use(bodyParser.json())

//Conexão para o Angular
const cors = require('cors')
const corsOptions = {
  origin: 'http://localhost:4200',
  optionsSuccessStatus: 200
}
 
app.use(cors(corsOptions))

//Conexão com o Postgresql
const db = require('./app/config/db.config.js');
  
// Apagará a tabela que já existe e criará uma nova tabela
db.sequelize.sync({force: true}).then(() => {
  console.log('Drop and Resync with { force: true }');
  inicializaDados();
});
 
require('./app/route/endereco.route.js')(app);
 
// Cria um servidor
var server = app.listen(8080, function () {
 
  let host = server.address().address
  let port = server.address().port
 
  console.log("App listening at http://%s:%s", host, port);
})

//Inicializa dados para popular o banco de dados
function inicializaDados(){
 
  let enderecos = [
    {
      rua: "Rua de Cima",
      numero: 52,
      bairro: "Alvorada",
      cep: "45632-015",
      cidade: "João Pessoa",
      estado: "Paraíba"
    },
    {
      rua: "Rua do Quartel",
      numero: 07,
      bairro: "Centro",
      cep: "45689-780",
      cidade: "Natal",
      estado: "Rio Grande do Norte"
    },
    {
      rua: "Rua Elmer",
      numero: 23,
      bairro: "Vila Sésamo",
      cep: "75963-458",
      cidade: "Manaus",
      estado: "Amazonas"
    },
    {
      rua: "Avenida Central",
      numero: 40,
      bairro: "Centro",
      cep: "55900-000",
      cidade: "Goiana",
      estado: "Pernambuco"
    },
    {
      rua: "Rua das Panelas",
      numero: 37,
      bairro: "Multirão",
      cep: "45953-745",
      cidade: "Belém",
      estado: "Pará"
    },
    {
      rua: "Beco da Fruta",
      numero: 17,
      bairro: "Bela Vista",
      cep: "65469-321",
      cidade: "Salvador",
      estado: "Bahia"
    },
    {
      rua: "Rua do Vigário",
      numero: 12,
      bairro: "Vila Paraíso",
      cep: "65468-000",
      cidade: "Aracaju",
      estado: "Sergipe"
    }
  ]
 
  // Inicializa os dados e salva no Postgresql
  const Endereco = db.enderecos;
  for (let i = 0; i < enderecos.length; i++) { 
    Endereco.create(enderecos[i]);  
  }
}