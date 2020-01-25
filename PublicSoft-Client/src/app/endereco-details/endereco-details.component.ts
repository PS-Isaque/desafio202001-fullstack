import { Component, OnInit } from '@angular/core';
import { Endereco } from '../endereco';
import { EnderecoService } from '../endereco.service';

import { ActivatedRoute, Params } from '@angular/router';
import { Location } from '@angular/common';

@Component({
  selector: 'app-endereco-details',
  templateUrl: './endereco-details.component.html',
  styleUrls: ['./endereco-details.component.css']
})
export class EnderecoDetailsComponent implements OnInit {

  endereco = new Endereco() ;
  submitted = false;
  message: string;

  constructor(
    private enderecoService: EnderecoService,
    private route: ActivatedRoute,
    private location: Location
  ) {}

  ngOnInit(): void {
    const id = +this.route.snapshot.paramMap.get('id');
    this.enderecoService.getEndereco(id)
      .subscribe(endereco => this.endereco = endereco);
  }

  update(): void {
    this.submitted = true;
    this.enderecoService.updateEndereco(this.endereco)
        .subscribe(result => this.message = "Endereço atualizado com sucesso!");
  }

  delete(): void {
    this.submitted = true;
    this.enderecoService.deleteEndereco(this.endereco.id)
        .subscribe(result => this.message = "Endereço deletado com sucesso!");
  }

  goBack(): void {
    this.location.back();
  }
}