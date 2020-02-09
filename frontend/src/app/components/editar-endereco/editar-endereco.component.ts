import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';
import { ApiService } from '../../service/api.service';
import { FormControl, FormGroupDirective, FormBuilder, FormGroup, NgForm, Validators } from '@angular/forms';


@Component({
  selector: 'app-editar-endereco',
  templateUrl: './editar-endereco.component.html',
  styleUrls: ['./editar-endereco.component.css']
})
export class EditarEnderecoComponent implements OnInit {

  enderecoForm: FormGroup;
  id: string = '';
  rua:string = '';
  bairro:string = '';
  cidade:string = '';
  complemento:string = '';
  numero:string = '';
  estado:string = '';
  cep:string = '';
  isLoadingResults = false;

  constructor(private router: Router, private route: ActivatedRoute, private api: ApiService, private formBuilder: FormBuilder) { }

  ngOnInit() {
    this.getEndereco(this.route.snapshot.params['id']);
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

  getEndereco(id: number) {
    this.api.getEndereco(id).subscribe(data => {
      this.id = data.id;
      this.enderecoForm.setValue({
        rua: data.rua,
        bairro: data.bairro,
        cidade: data.cidade,
        complemento: data.complemento,
        numero: data.numero,
        estado: data.estado,
        cep: data.cep,
      });
    });
  }

  onFormSubmit(form:NgForm) {
    this.isLoadingResults = true;
    this.api.updateEndereco(this.id, form)
      .subscribe(res => {
          let id = res['id'];
          this.isLoadingResults = false;
          this.router.navigate(['/detalhe-endereco', id]);
        }, (err) => {
          console.log(err);
          this.isLoadingResults = false;
        }
      );
  }

  detalheEndereco() {
    this.router.navigate(['/detalhe-endereco', this.id]);
  }

}
