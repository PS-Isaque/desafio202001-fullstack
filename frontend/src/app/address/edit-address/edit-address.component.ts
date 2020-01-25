import { Component, OnInit , Inject} from '@angular/core';
import {Router} from "@angular/router";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {first} from "rxjs/operators";
import { ApiService } from 'src/app/services/crud.service';
import { Address } from 'src/app/models/address.models';
import { ActivatedRoute } from "@angular/router";
import { map, switchMap } from "rxjs/operators";

@Component({
  selector: 'app-edit-address',
  templateUrl: './edit-address.component.html',
  styleUrls: ['./edit-address.component.css']
})
export class EditAddressComponent implements OnInit {

  address: Address;
  editForm: FormGroup;
  submitted = false;
  constructor(private formBuilder: FormBuilder,private router: Router,private route: ActivatedRoute, private apiService: ApiService) { }

  ngOnInit() {
    this.route.params
    .pipe(
      map((params: any) => params['id']),
      switchMap(id => this.apiService.getAddressById(id))
      )
      .subscribe(
        address => {
          this.updateForm(address);
        });

        this.editForm = this.formBuilder.group({
          id: [null],
          street: [null, [Validators.required, Validators.maxLength(250)]],
          number: [null, [Validators.required, Validators.maxLength(250)]],
      complement: [null, [Validators.required, Validators.maxLength(250)]],
      district: [null, [Validators.required, Validators.maxLength(250)]],
      city: [null, [Validators.required, Validators.maxLength(250)]],
      state: [null, [Validators.required, Validators.maxLength(250)]],
      zipcode: [
        null,
        [
          Validators.required,
          Validators.minLength(8),
          Validators.maxLength(250)
        ]
      ],
      reference: [null, [Validators.required, Validators.maxLength(250)]]
    });

  }

    updateForm(address){
      this.editForm.patchValue({
        id: address.id,
        street: address.street,
        number: address.number,
        complement: address.complement,
        district: address.district,
        city: address.city,
        state: address.state,
        zipcode: address.zipcode,
        reference: address.reference
      })
    }

  hasError(field: string) {
    return this.editForm.get(field).errors;
  }

  onSubmit() {
    this.submitted = true;

    console.log(this.editForm.value)
    this.apiService.updateAddress(this.editForm.value)
      .subscribe(
        data => {
          if(data == '') {
            alert(data.message);
          }else {
            alert('User updated successfully.');
            this.router.navigate(['']);
          }
        },
        error => {
          alert(error);
        });
  }

  onCancel() {
    this.submitted = false;
    this.router.navigate(['']);
  }
}
