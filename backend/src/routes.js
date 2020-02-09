import { Router } from 'express';
import EnderecoController from './app/controllers/EnderecoController';

const routes = new Router();

routes.get('/enderecos', EnderecoController.index); // Rota para listar todos os endereços
routes.get('/enderecos/:id', EnderecoController.show); // Rota para listar um endereço pelo id
routes.post('/enderecos', EnderecoController.store); // Rota para cadastrar endereço
routes.put('/enderecos/:id', EnderecoController.update); // Rota para editar um endereço pelo id
routes.delete('/enderecos/:id', EnderecoController.destroy); // Rota para deletar um endereço pelo id

export default routes;
