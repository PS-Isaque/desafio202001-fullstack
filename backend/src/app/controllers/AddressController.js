// import * as Yup from 'yup';
import Address from '../models/Address';

class AddressController {
  async store(req, res) {
    /*
      Fazer Validação de Entrada de Dados
    */
    // const addressExists = await Address.findOne
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
}

export default new AddressController();
