import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import {AddressListComponent} from './address/address-list/address-list.component';
import {AddressFormComponent} from './address/address-form/address-form.component';


const routes: Routes = [
  {path: '', component: AddressListComponent},
  {path: 'address/add', component: AddressFormComponent},
  {path: 'address/edit/:id', component: AddressFormComponent},
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
export const RoutingComponents = [
  AddressFormComponent,
  AddressListComponent
]
