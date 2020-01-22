const Sequelize = require("sequelize");

//create connection
module.exports = new Sequelize("places-app", "default", "secret", {
  host: "localhost",
  dialect: "postgres"
});
