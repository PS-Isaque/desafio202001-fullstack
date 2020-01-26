import { RouterModule, Routes } from '@angular/router';
import { AddAddressComponent } from './address/add-address/add-address.component';
import { ListAddressComponent } from './address/list-address/list-address.component';
import { EditAddressComponent } from './address/edit-address/edit-address.component';
import { ShowAddressComponent } from './address/show-address/show-address.component';

const routes: Routes = [
  { path: 'add', component: AddAddressComponent },
  { path: '', component: ListAddressComponent },
  { path: 'update/:id', component: EditAddressComponent },
  { path: 'show/:id', component: ShowAddressComponent },
];

export const routing = RouterModule.forRoot(routes);
