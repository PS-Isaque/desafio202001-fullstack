import Sequelize, { Model } from 'sequelize';

class Endereco extends Model {
  static init(sequelize) {
    super.init(
      {
        rua: Sequelize.STRING,
        bairro: Sequelize.STRING,
        cidade: Sequelize.STRING,
        complemento: Sequelize.STRING,
        numero: Sequelize.STRING,
        estado: Sequelize.STRING,
        cep: Sequelize.STRING,
      },
      {
        sequelize,
      }
    );
  }
}

export default Endereco;
