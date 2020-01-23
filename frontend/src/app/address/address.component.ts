import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-address',
  templateUrl: './address.component.html',
  styleUrls: ['./address.component.css']
})
export class AddressComponent implements OnInit {
  street: String;
  number: number;
  complement: String;
  district: String;
  city: String;
  state: String;
  zipcode: String;
  reference: String;


  constructor() { }

  ngOnInit() {
  }

}
