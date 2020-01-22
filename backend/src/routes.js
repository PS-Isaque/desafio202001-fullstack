const express = require("express");

const routes = express.Router();

//Import Controller
const PlaceController = require("./controllers/PlacesController");

//Places Routers
routes.get("/api/places", PlaceController.index);
routes.post("/api/places", PlaceController.store);
routes.get("/api/places/:id", PlaceController.show);
routes.put("/api/places/:id/update", PlaceController.update);
routes.delete("/api/places/:id/destroy", PlaceController.destroy);

module.exports = routes;
