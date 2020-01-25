import { RouterModule, Routes } from '@angular/router';
import { AddAddressComponent } from './address/add-address/add-address.component';
import { ListAddressComponent } from './address/list-address/list-address.component';
import { EditAddressComponent } from './address/edit-address/edit-address.component';

const routes: Routes = [
  { path: 'add-address', component: AddAddressComponent },
  { path: '', component: ListAddressComponent },
  { path: 'edit-address/:id', component: EditAddressComponent },
];

export const routing = RouterModule.forRoot(routes);
