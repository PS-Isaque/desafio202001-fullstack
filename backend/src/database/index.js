import Sequelize from 'sequelize';
import databaseConfig from '../config/database';
import Endereco from '../app/models/Endereco';

const models = [Endereco];

class Database {
  constructor() {
    this.init();
  }

  init() {
    this.connection = new Sequelize(databaseConfig);
    models.map(model => model.init(this.connection));
  }
}

export default new Database();
