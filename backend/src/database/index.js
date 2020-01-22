import Sequelize from 'sequelize';

import Address from '../app/models/Address';

import databaseConfig from '../config/database';

const models = [Address];

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
