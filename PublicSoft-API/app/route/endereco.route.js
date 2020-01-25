module.exports = function(app) {
    const enderecos = require('../controller/endereco.controller.js');
 
    // Criar um novo endereco
    app.post('/api/enderecos', enderecos.create);
 
    // Recuperar todos os enderecos
    app.get('/api/enderecos', enderecos.findAll);
 
    // Recuperar apenas um endereco pelo Id
    app.get('/api/enderecos/:id', enderecos.findById);
 
    // Atualizar um endereco pelo Id
    app.put('/api/enderecos/:id', enderecos.update);
 
    // Deletar um endereco pelo Id
    app.delete('/api/enderecos/:id', enderecos.delete);
}