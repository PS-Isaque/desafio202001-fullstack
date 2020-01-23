import * as Yup from 'yup';
import Address from '../models/Address';

class AddressController {
  async store(req, res) {
    const schema = Yup.object().shape({
      street: Yup.string().required(),
      number: Yup.string().required(),
      complement: Yup.string().required(),
      district: Yup.string().required(),
      city: Yup.string().required(),
      state: Yup.string().required(),
      zipcode: Yup.string().required(),
      reference: Yup.string().required(),
    });

    if (!(await schema.isValid(req.body))) {
      return res.status(400).json({ error: 'Validation fails' });
    }

    const {
      id,
      street,
      number,
      complement,
      district,
      city,
      state,
      zipcode,
      reference,
    } = await Address.create(req.body);

    return res.json({
      id,
      street,
      number,
      complement,
      district,
      city,
      state,
      zipcode,
      reference,
    });
  }

  async index(req, res) {
    const addresses = await Address.findAll();

    return res.status(200).json(addresses);
  }

  async show(req, res) {
    const address = await Address.findByPk(req.params.id);

    if (!address) {
      return res.status(400).json({ message: 'Address not registered' });
    }

    return res.status(202).json(address);
  }

  async update(req, res) {
    const schema = Yup.object().shape({
      street: Yup.string().required(),
      number: Yup.string().required(),
      complement: Yup.string().required(),
      district: Yup.string().required(),
      city: Yup.string().required(),
      state: Yup.string().required(),
      zipcode: Yup.string().required(),
      reference: Yup.string().required(),
    });

    if (!(await schema.isValid(req.body))) {
      return res.status(400).json({ error: 'Validation fails' });
    }

    const address = await Address.findByPk(req.params.id);

    if (!address) {
      return res.status(400).json({ message: 'Address not registered' });
    }

    const newAddress = await address.update(req.body);

    return res.status(202).json(newAddress);
  }

  async destroy(req, res) {
    const address = await Address.findByPk(req.params.id);

    if (!address) {
      return res.status(400).json({ message: 'Address not registered' });
    }

    address.destroy();

    return res.status(202).json({ message: 'The address has been deleted!' });
  }
}

export default new AddressController();
