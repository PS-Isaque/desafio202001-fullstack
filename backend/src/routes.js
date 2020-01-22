import { Router } from 'express';

import AddressController from './app/controllers/AddressController';

const routes = new Router();

routes.post('/address', AddressController.store);
// routes.get('/address', AddressController.index);
// routes.get('/address', AddressController.show);
// routes.put('/address', AddressController.update);
// routes.delete('/address', AddressController.delete);

export default routes;
