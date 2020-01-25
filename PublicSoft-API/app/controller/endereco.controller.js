const db = require('../config/db.config.js');
const Endereco = db.enderecos;

// Cria um novo endereco
exports.create = (req, res) => {	
	// Salva no banco de dados
	Endereco.create({
				"rua": req.body.rua,
				"numero": req.body.numero,
				"bairro": req.body.bairro,
				"cep": req.body.cep,
				"cidade": req.body.cidade,
				"estado": req.body.estado
			}).then(endereco => {		
			// Envia o endereço criado para o cliente
			res.json(endereco);
		}).catch(err => {
			console.log(err);
			res.status(500).json({msg: "error", details: err});
		});
};
 
// Recupera todos os enderecos
exports.findAll = (req, res) => {
	Endereco.findAll().then(enderecos => {
			// Envia todos os enderecos para o client
			res.json(enderecos.sort(function(c1, c2){return c1.id - c2.id}));
		}).catch(err => {
			console.log(err);
			res.status(500).json({msg: "error", details: err});
		});
};

// // Recupera apenas um endereco pelo Id
exports.findById = (req, res) => {	
	Endereco.findById(req.params.id).then(endereco => {
			res.json(endereco);
		}).catch(err => {
			console.log(err);
			res.status(500).json({msg: "error", details: err});
		});
};
 
// Atualizar um endereco pelo Id
exports.update = (req, res) => {
	const id = req.body.id;
	Endereco.update( req.body, 
			{ where: {id: id} }).then(() => {
				res.status(200).json( { mgs: "Informação atualizada com sucesso! -> Endereco Id = " + id } );
			}).catch(err => {
				console.log(err);
				res.status(500).json({msg: "error", details: err});
			});
};

// Deletar um endereco pelo Id
exports.delete = (req, res) => {
	const id = req.params.id;
	Endereco.destroy({
			where: { id: id }
		}).then(() => {
			res.status(200).json( { msg: 'O endereço de código ' + id + ' foi deletado com sucesso!'} );
		}).catch(err => {
			console.log(err);
			res.status(500).json({msg: "error", details: err});
		});
};