import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { ApiService } from '../../service/api.service';
import { FormControl, FormGroupDirective, FormBuilder, FormGroup, NgForm, Validators } from '@angular/forms';

@Component({
  selector: 'app-novo-endereco',
  templateUrl: './novo-endereco.component.html',
  styleUrls: ['./novo-endereco.component.css']
})
export class NovoEnderecoComponent implements OnInit {

  enderecoForm: FormGroup;
  rua:string='';
  bairro:string='';
  cidade:string='';
  complemento:string='';
  numero:string='';
  estado:string='';
  cep:string='';
  isLoadingResults = false;

  constructor(private router: Router, private api: ApiService, private formBuilder: FormBuilder) { }

  ngOnInit() {
    this.enderecoForm = this.formBuilder.group({
      'rua' : [null, Validators.required],
      'bairro' : [null, Validators.required],
      'cidade' : [null, Validators.required],
      'complemento' : [null, Validators.required],
      'numero' : [null, Validators.required],
      'estado' : [null, Validators.required],
      'cep' : [null, Validators.required],
    });
  }

  onFormSubmit(form:NgForm) {
    this.isLoadingResults = true;
    this.api.postEndereco(form)
      .subscribe(res => {
          let id = res['id'];
          this.isLoadingResults = false;
          this.router.navigate(['/detalhe-endereco', id]);
        }, (err) => {
          console.log(err);
          this.isLoadingResults = false;
        });
  }

}
