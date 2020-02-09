import * as Yup from 'yup'; // Biblioteca necessária para fazer a validação dos dados
import Endereco from '../models/Endereco';

class EnderecoController {
  // Lista todos os endereços
  async index(req, res) {
    const endereco = await Endereco.findAll();
    return res.status(200).json(endereco);
  }

  // Exibe endereço
  async show(req, res) {
    const endereco = await Endereco.findByPk(req.params.id);
    if (!endereco) {
      return res.status(400).json({ message: 'Endereço não encontrado' });
    }
    return res.json(endereco);
  }

  // Cadastra endereço
  async store(req, res) {
    // Schema de validaçao
    const endSchema = Yup.object().shape({
      rua: Yup.string().required(),
      bairro: Yup.string().required(),
      cidade: Yup.string().required(),
      complemento: Yup.string(),
      numero: Yup.string().required(),
      estado: Yup.string().required(),
      cep: Yup.string().required(),
    });

    if (!(await endSchema.isValid(req.body))) {
      return res.status(400).json({ error: 'Validação falhou' });
    }

    const endereco = await Endereco.create(req.body);
    return res.status(200).json(endereco);
  }

  // Edita endereço
  async update(req, res) {
    const endereco = await Endereco.findByPk(req.params.id);
    if (!endereco) {
      return res.status(400).json({ message: 'Endereço não registrado' });
    }
    const novoEndereco = await endereco.update(req.body);
    return res.json(novoEndereco);
  }

  // Deleta endereço
  async destroy(req, res) {
    const endereco = await Endereco.findByPk(req.params.id);
    if (!endereco) {
      return res.status(400).json({ message: 'Endereço não existe' });
    }
    endereco.destroy();
    return res.status(202).json({ message: 'Endereço deletado com sucesso' });
  }
}

export default new EnderecoController();
