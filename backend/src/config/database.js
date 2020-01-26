const Sequelize = require("sequelize");

//create connection(database,user,password,host,driver)
module.exports = new Sequelize("places-app", "default", "secret", {
  host: "localhost",
  dialect: "postgres"
});
