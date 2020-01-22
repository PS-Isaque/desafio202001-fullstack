const Place = require("../models/Place");

module.exports = {
  async index(req, res) {
    const places = await Place.findAll();

    return res.status(200).json({ data: places });
  },

  async show(req, res) {
    const place = await Place.findByPk(req.params.id);

    if (!place) {
      return res.status(400).json({ message: "Place not found" });
    }

    return res.status(202).json(place);
  },

  async store(req, res) {
    const place = req.body;

    const newPlace = await Place.create(place);

    return res.status(202).json(newPlace);
  },

  async update(req, res) {
    const place_id = req.params.id;
    const place = await Place.findByPk(place_id);

    if (!place) {
      return res.status(400).json({ message: "Place not found" });
    }

    const placeUpdated = await place.update(req.body);

    return res.status(202).json(placeUpdated);
  },

  async destroy(req, res) {
    const place_id = req.params.id;

    const place = await Place.findByPk(place_id);

    if (!place) {
      return res.status(400).json({ message: "Place not found" });
    }

    place.destroy();

    return res.status(202).json({ message: "Place has been deleted!" });
  }
};
