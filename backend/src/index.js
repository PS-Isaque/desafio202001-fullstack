const express = require("express");
const app = express();
const cors = require("cors");
const db = require("./config/database");

//testing connection
db.authenticate()
  .then(() => console.log("Database Connected"))
  .catch(err => console.log(`Error to connect database: ${err}`));

//import routes
const routes = require("./routes");

//settup the server
app.use(cors());
app.use(express.json());
app.use(routes);

//setting port on server
const PORT = process.env.PORT || 3333;
app.listen(PORT, console.log(`The Server started on port: ${PORT}`));
