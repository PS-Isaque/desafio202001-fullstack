import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { EnderecoComponent } from '../endereco/endereco.component';
import { AddEnderecoComponent } from '../add-endereco/add-endereco.component';
import { EnderecoDetailsComponent } from '../endereco-details/endereco-details.component';

const routes: Routes = [
   { 
     path: 'enderecos', 
     component: EnderecoComponent 
   },
   { 
     path: 'endereco/add', 
     component: AddEnderecoComponent 
   },
   { 
     path: 'enderecos/:id', 
     component: EnderecoDetailsComponent 
   },
   { 
     path: '', 
     redirectTo: '', 
     pathMatch: 'full'
   }, 
];

@NgModule({
  imports: [ RouterModule.forRoot(routes) ],
  exports: [ RouterModule ]
})

export class AppRoutingModule {}