import { Component, OnInit } from '@angular/core';
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {Router} from "@angular/router";
import { ActivatedRoute } from "@angular/router";
import { ApiService } from 'src/app/services/crud.service';

@Component({
  selector: 'app-add-address',
  templateUrl: './add-address.component.html',
  styleUrls: ['./add-address.component.css']
})
export class AddAddressComponent implements OnInit {

  constructor(private formBuilder: FormBuilder,private router: Router, private apiService: ApiService) { }

  addForm: FormGroup;
  submitted = false;

  ngOnInit() {

    this.addForm = this.formBuilder.group({
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

  hasError(field: string) {
    return this.addForm.get(field).errors;
  }

  onSubmit() {
    this.submitted = true;
    console.log(this.addForm.value)
    this.apiService.createAddress(this.addForm.value).subscribe( data => {
      console.log('Efetuado')
        this.router.navigate(['']);
      });
  }

  onCancel() {
    this.submitted = false;
    this.addForm.reset();
    this.router.navigate(['']);
  }
}
