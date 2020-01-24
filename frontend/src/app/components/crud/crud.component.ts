import { Component, OnInit } from '@angular/core';
import { CrudService } from 'src/app/services/crud.service';
import { Address } from 'src/app/models/address.models';
import { Router, ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-crud',
  templateUrl: './crud.component.html',
  styleUrls: ['./crud.component.css']
})
export class CrudComponent implements OnInit {
  address = new Address();
  erro: any;
  constructor(private crudService: CrudService,
    private router: Router,
    private route: ActivatedRoute) {
  }

  ngOnInit() {
    this.onRefresh()
  }
  onRefresh() {
    this.crudService.getIndex().subscribe(
      (data: Address) => {
        this.address = data;
      },
      (error: any)=>  {
        this.erro = error;
        console.error("Error: ", error)
      })
  }

    onEdit(id) {
      this.router.navigate([`update`, id], {relativeTo: this.route});
    }

}
