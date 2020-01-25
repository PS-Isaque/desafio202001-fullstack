import { Component } from '@angular/core';
import { Endereco } from '../endereco';
import { EnderecoService } from '../endereco.service';

import { Location } from '@angular/common';

@Component({
  selector: 'app-add-endereco',
  templateUrl: './add-endereco.component.html',
  styleUrls: ['./add-endereco.component.css']
})

export class AddEnderecoComponent{

  endereco = new Endereco();
  submitted = false;

  constructor(
    private enderecoService: EnderecoService,
    private location: Location
  ) { }

  newEndereco(): void {
    this.submitted = false;
    this.endereco = new Endereco();
  }

 addEndereco() {
   this.submitted = true;
   this.save();
 }

  goBack(): void {
    this.location.back();
  }

  private save(): void {
    console.log(this.endereco);
    this.enderecoService.addEndereco(this.endereco)
        .subscribe();
  }
}
