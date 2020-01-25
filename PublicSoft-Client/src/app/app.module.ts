import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { FormsModule }   from '@angular/forms';
import { HttpClientModule }    from '@angular/common/http';

import { AppRoutingModule }     from './app-routing/app-routing.module';

import { AppComponent } from './app.component';
import { EnderecoComponent } from './endereco/endereco.component';
import { EnderecoDetailsComponent } from './endereco-details/endereco-details.component';
import { AddEnderecoComponent } from './add-endereco/add-endereco.component';

@NgModule({
  declarations: [
    AppComponent,
    EnderecoComponent,
    EnderecoDetailsComponent,
    AddEnderecoComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    AppRoutingModule,
    HttpClientModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
