import { Component, OnInit } from '@angular/core';
import {FormControl, Validators, FormGroup} from '@angular/forms';
import {ActivatedRoute, Router, ParamMap} from '@angular/router';
import { switchMap } from 'rxjs/operators';
import {AddressService} from '../../services/address.service';
import {IAddress} from '../address';

@Component({
  selector: 'app-address-form',
  templateUrl: './address-form.component.html',
  styleUrls: ['./address-form.component.scss']
})
export class AddressFormComponent implements OnInit {

  street = new FormControl('', [Validators.required]);
  city = new FormControl('', [Validators.required]);
  number = new FormControl('', [Validators.required, Validators.pattern('^[0-9]*$')]);
  zipcode = new FormControl('', [Validators.required, Validators.pattern('^[0-9]*$')]);
  neighbourhood = new FormControl('', [Validators.required]);
  state = new FormControl('', [Validators.required, Validators.maxLength(2)]);
  complement = new FormControl('', [Validators.required]);

  address: IAddress;

  constructor(private route: ActivatedRoute, private router: Router, private _addressService: AddressService) { }

  ngOnInit() {
    this.route.params.subscribe(params => {
      if (params.id) {
        return this._addressService.getAddress(params.id)
          .subscribe(data => {
            this.street.patchValue(data.street)
            this.city.patchValue(data.city)
            this.number.patchValue(data.number)
            this.zipcode.patchValue(data.zipcode)
            this.neighbourhood.patchValue(data.neighborhood)
            this.state.patchValue(data.state)
            this.complement.patchValue(data.complement);
          });
      }
    });
  }

  onCancel() {
    this.router.navigate(['/']);
  }

  onSubmit() {
    let body = {
      street: this.street.value,
      city: this.city.value,
      number: this.number.value,
      zipcode: this.zipcode.value,
      neighborhood: this.neighbourhood.value,
      state: this.state.value,
      complement: this.complement.value,
    };

    this.route.params.subscribe(params => {
      if (params.id) {
        return this._addressService.updateAddress(params.id, body)
          .subscribe(data => {
            console.log(data);
            this.router.navigate(['/']);
          });
      } else {
        return this._addressService.createAddress(body)
          .subscribe(data => {
            console.log(data);
            this.router.navigate(['/']);
          });
      }
    });
  }
}
