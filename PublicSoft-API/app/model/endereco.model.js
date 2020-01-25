module.exports = (sequelize, Sequelize) => {
	const Endereco = sequelize.define('endereco', {
		rua: {
			type: Sequelize.STRING
		},
		numero: {
			type: Sequelize.INTEGER
		},
		bairro: {
			type: Sequelize.STRING
		},
		cep: {
			type: Sequelize.STRING
		},
	  	cidade: {
			type: Sequelize.STRING
		},
		estado: {
			type: Sequelize.STRING
		}
	});

	return Endereco;
}