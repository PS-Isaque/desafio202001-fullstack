import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import {MatDialog} from '@angular/material/dialog';
import { AddressRemoveDialogComponent } from '../address-remove-dialog/address-remove-dialog.component';
import {AddressService} from '../../services/address.service';

@Component({
  selector: 'app-address-list',
  templateUrl: './address-list.component.html',
  styleUrls: ['./address-list.component.scss']
})
export class AddressListComponent implements OnInit {
  addresses: Array<object> = [];

  constructor(private router: Router, public dialog: MatDialog, private _addressService: AddressService) { }

  ngOnInit() {
    this._addressService.getAddresses()
      .subscribe(data => this.addresses = data);
  }

  onAdd() {
    this.router.navigate(['/address/add']);
  }

  onEdit(address) {
    this.router.navigate(['/address/edit/' + address.id]);
  }

  onRemove(address, index) {
    const dialogRef = this.dialog.open(AddressRemoveDialogComponent, {
      data: { address }
    });

    dialogRef.afterClosed().subscribe(result => {
      if (result) {
        this._addressService.deleteAddress(address)
          .subscribe(res => {
              console.log('success');
              this.addresses.splice(index, 1);
              this.addresses = this.addresses.slice(0);
            },
            err => {
              console.log('Error occurred.');
          });
      }
    });
  }

}
