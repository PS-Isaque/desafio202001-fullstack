import { Component, OnInit } from '@angular/core';
import { Endereco } from '../endereco';
import { EnderecoService } from '../endereco.service';


@Component({
  selector: 'app-endereco',
  templateUrl: './endereco.component.html',
  styleUrls: ['./endereco.component.css']
})

export class EnderecoComponent  implements OnInit {

  enderecos: Endereco[];

  constructor(private enderecoService: EnderecoService) {}

  ngOnInit(): void {
     this.getEnderecos();
  }

  getEnderecos() {
    return this.enderecoService.getEnderecos()
               .subscribe(
                 enderecos => {
                  console.log(enderecos);
                  this.enderecos = enderecos
                 }
                );
 }
}
