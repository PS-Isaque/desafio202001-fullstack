import { Component, OnInit } from "@angular/core";
import { FormGroup, FormBuilder, Validators } from "@angular/forms";
import { CrudService } from "../services/crud.service";
import { Location } from "@angular/common";
import { ActivatedRoute } from "@angular/router";
import { map, switchMap } from "rxjs/operators";

@Component({
  selector: "app-address-form",
  templateUrl: "./address-form.component.html",
  styleUrls: ["./address-form.component.css"]
})
export class AddressFormComponent implements OnInit {
  form: FormGroup;
  submitted = false;
  location: Location;

  constructor(
    private fb: FormBuilder,
    private service: CrudService,
    private route: ActivatedRoute
  ) {}

  ngOnInit() {
    this.route.params
    .pipe(
      map((params: any) => params['id']),
      switchMap(id => this.service.loadByID(id))
    )
    .subscribe(
        address => {
          this.updateForm(address);
        });


    this.form = this.fb.group({
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
    this.form.patchValue({
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
    return this.form.get(field).errors;
  }

  onSubmit() {
    this.submitted = true;
    console.log(this.form.value);
    if (this.form.valid) {
      console.log("submit");
      if(this.form.value.id) {
        this.service.update(this.form.value.id).subscribe(
          success => {
            console.log("Update completed");
          },
          error => console.error(error),
          () => console.log("Update error")
        )
      } else {
        this.service.create(this.form.value).subscribe(
          success => {
            console.log("success");
          },
          error => console.error(error),
          () => console.log("request completed")
        );
      }
    }
  }
  onCancel() {
    this.submitted = false;
    this.form.reset();
    //console.log('cancel');
  }
}
