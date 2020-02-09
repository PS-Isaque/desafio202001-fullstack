import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { ListarEnderecosComponent } from './components/listar-enderecos/listar-enderecos.component';
import { DetalheEnderecoComponent } from './components/detalhe-endereco/detalhe-endereco.component';
import { NovoEnderecoComponent } from './components/novo-endereco/novo-endereco.component';
import { EditarEnderecoComponent } from './components/editar-endereco/editar-endereco.component';

const routes: Routes = [
  {
    path: 'enderecos',
    component: ListarEnderecosComponent,
  },
  {
    path: 'detalhe-endereco/:id',
    component: DetalheEnderecoComponent,
  },
  {
    path: 'novo-endereco',
    component: NovoEnderecoComponent,
  },
  {
    path: 'editar-endereco/:id',
    component: EditarEnderecoComponent,
  },
  {
    path: '',
    redirectTo: '/enderecos',
    pathMatch: 'full',
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
