import { Component, OnInit } from '@angular/core';
import { ApiService } from '../../service/api.service';
import { Endereco } from '../../models/endereco';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-listar-enderecos',
  templateUrl: './listar-enderecos.component.html',
  styleUrls: ['./listar-enderecos.component.css']
})
export class ListarEnderecosComponent implements OnInit {

  displayedColumns: string[] = ['rua', 'bairro', 'cidade', 'complemento', 'numero', 'estado', 'cep', 'acao', 'acao1'];
  data: Endereco[] = [];
  isLoadingResults = true;

  constructor(private api: ApiService, private route: ActivatedRoute, private router: Router) { }

  ngOnInit() {
    this.api.getEnderecos()
      .subscribe(res => {
        this.data = res;
        console.log(this.data);
        this.isLoadingResults = false;
      }, err => {
        console.log(err);
        this.isLoadingResults = false;
      });
  }

  deleteEndereco(id) {
    this.isLoadingResults = true;
    this.api.deleteEndereco(id)
      .subscribe(res => {
          this.isLoadingResults = false;
          this.router.navigate(['/enderecos']);
        }, (err) => {
          console.log(err);
          this.isLoadingResults = false;
        }
      );
  }

}
