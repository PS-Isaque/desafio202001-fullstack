const Sequelize = require("sequelize");

const db = require("../config/database");

const Place = db.define("place", {
  address: {
    type: Sequelize.STRING
  },
  zipcode: {
    type: Sequelize.STRING
  },
  city: {
    type: Sequelize.STRING
  },
  neighborhood: {
    type: Sequelize.STRING
  },
  state: {
    type: Sequelize.STRING
  }
});

module.exports = Place;
