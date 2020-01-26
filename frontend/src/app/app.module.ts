import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppComponent } from './app.component';
import { ListAddressComponent } from './address/list-address/list-address.component';
import { AddAddressComponent } from './address/add-address/add-address.component';
import { EditAddressComponent } from './address/edit-address/edit-address.component';
import { ApiService } from './services/crud.service';
import { routing } from './app-routing.module';
import {ReactiveFormsModule} from "@angular/forms";
import {HttpClientModule} from "@angular/common/http";
import { ShowAddressComponent } from './address/show-address/show-address.component';

@NgModule({
  declarations: [
    AppComponent,
    ListAddressComponent,
    AddAddressComponent,
    EditAddressComponent,
    ShowAddressComponent
  ],
  imports: [
    BrowserModule,
    routing,
    ReactiveFormsModule,
    HttpClientModule
  ],
  providers: [ApiService],
  bootstrap: [AppComponent]
})
export class AppModule { }
