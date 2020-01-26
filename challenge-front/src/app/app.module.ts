import { BrowserModule } from '@angular/platform-browser';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { NgModule } from '@angular/core';

import { AppRoutingModule, RoutingComponents } from './app-routing.module';
import { AppComponent } from './app.component';
import {MatToolbarModule} from '@angular/material/toolbar';
import {MatSidenavModule} from '@angular/material/sidenav';
import {MatIconModule} from '@angular/material/icon';
import {MatButtonModule} from '@angular/material/button';
import {MatListModule} from '@angular/material/list';
import {MatDialogModule} from '@angular/material/dialog';
import {AddressRemoveDialogComponent} from './address/address-remove-dialog/address-remove-dialog.component';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import {MatInputModule} from '@angular/material';
import {MatFormFieldModule} from '@angular/material/form-field';
import { HttpClientModule } from '@angular/common/http';
import { AddressService } from './services/address.service';

// @ts-ignore
@NgModule({
  declarations: [
    AppComponent,
    RoutingComponents,
    AddressRemoveDialogComponent,
  ],
  imports: [
    BrowserModule,
    BrowserAnimationsModule,
    AppRoutingModule,
    FormsModule,
    MatFormFieldModule,
    MatToolbarModule,
    MatSidenavModule,
    MatIconModule,
    MatButtonModule,
    MatListModule,
    MatDialogModule,
    MatInputModule,
    MatFormFieldModule,
    HttpClientModule,
  ],
  entryComponents: [
    AddressRemoveDialogComponent
  ],
  providers: [ AddressService ],
  bootstrap: [AppComponent]
})
export class AppModule { }
