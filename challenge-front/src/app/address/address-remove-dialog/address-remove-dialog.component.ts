import { Component, OnInit, Inject } from '@angular/core';
import {MAT_DIALOG_DATA} from '@angular/material/dialog';

@Component({
  selector: 'app-address-remove-dialog',
  templateUrl: './address-remove-dialog.component.html',
  styleUrls: ['./address-remove-dialog.component.scss']
})
export class AddressRemoveDialogComponent implements OnInit {
  constructor(@Inject(MAT_DIALOG_DATA) public data: object) { }

  ngOnInit() {
  }

}
