import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AddressFormComponent } from './address-form/address-form.component';
import { CrudComponent } from './components/crud/crud.component';


const routes: Routes = [
  { path: '', component: CrudComponent},
  { path: 'new', component: AddressFormComponent },
  { path: 'update/:id', component: AddressFormComponent },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }

/*
{
    path: "new",
    component: AddressFormComponent,
    resolve: {
      address: AddressResolverGuard
    }
  },{
    path: "update/:id/",
    component: AddressFormComponent,
    resolve: {
      address: AddressResolverGuard
    }
  },
  */
