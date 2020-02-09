import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { ApiService } from '../../service/api.service';
import { Endereco } from '../../models/endereco';

@Component({
  selector: 'app-detalhe-endereco',
  templateUrl: './detalhe-endereco.component.html',
  styleUrls: ['./detalhe-endereco.component.css']
})
export class DetalheEnderecoComponent implements OnInit {

  endereco: Endereco = { id: '', rua: '', bairro: '', cidade: '', complemento: '', numero: '', estado: '', cep: '' };
  isLoadingResults = true;

  constructor(private route: ActivatedRoute, private api: ApiService, private router: Router) { }

  ngOnInit() {
    console.log(this.route.snapshot.params['id']);
    this.getDetalheEndereco(this.route.snapshot.params['id']);
  }

  getDetalheEndereco(id) {
    this.api.getEndereco(id)
      .subscribe(data => {
        this.endereco = data;
        console.log(this.endereco);
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
