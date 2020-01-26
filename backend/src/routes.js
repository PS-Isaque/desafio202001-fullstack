import { Router } from 'express';

import AddressController from './app/controllers/AddressController';

const routes = new Router();

routes.post('/address', AddressController.store);
routes.get('/address', AddressController.index);
routes.get('/address/:id', AddressController.show);
routes.put('/address/:id/update', AddressController.update);
routes.delete('/address/:id/destroy', AddressController.destroy);

export default routes;
