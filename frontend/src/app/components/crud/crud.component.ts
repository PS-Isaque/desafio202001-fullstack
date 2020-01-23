import { Component, OnInit } from '@angular/core';
import { CrudService } from 'src/app/services/crud.service';
import { Address } from 'src/app/models/address.models';

@Component({
  selector: 'app-crud',
  templateUrl: './crud.component.html',
  styleUrls: ['./crud.component.css']
})
export class CrudComponent implements OnInit {
  address: Address;
  erro: any;
  constructor(private crudService: CrudService) {
    this.getter()
  }

  ngOnInit() {
  }
  getter() {
    this.crudService.getIndex().subscribe(
      (data: Address) => {
        this.address = data;
        console.log("O data que recebemos", data);
        console.log("A variavel que preenchemos", this.address);
      },
      (error: any)=>  {
        this.erro = error;
        console.error("Error: ", error)
      })
  }

}
