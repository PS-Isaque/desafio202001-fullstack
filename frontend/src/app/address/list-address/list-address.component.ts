import { Component, OnInit } from '@angular/core';
import { Address } from 'src/app/models/address.models';
import { Router, ActivatedRoute } from '@angular/router';
import { ApiService } from 'src/app/services/crud.service';

@Component({
  selector: 'app-list-address',
  templateUrl: './list-address.component.html',
  styleUrls: ['./list-address.component.css']
})
export class ListAddressComponent implements OnInit {

  addresses: Address[];

  constructor(private router: Router, private route: ActivatedRoute, private apiService: ApiService) { }

  ngOnInit() {
    this.apiService.getAddresses()
      .subscribe( data => {
        this.addresses = data;
      });
  }

  deleteAddress(address: Address): void {
    this.apiService.deleteAddress(address.id)
      .subscribe( data => {
        this.addresses = this.addresses.filter(u => u !== address);
      })
  };

  editAddress(id: number): void {
    this.router.navigate([`update`, id], {relativeTo: this.route});
  };

  showAddress(id: number): void {
    this.router.navigate([`show`, id], {relativeTo: this.route});
  };

  addAddress(): void {
    this.router.navigate(['add']);
  };
}
