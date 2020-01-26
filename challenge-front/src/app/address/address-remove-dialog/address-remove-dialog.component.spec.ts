import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AddressRemoveDialogComponent } from './address-remove-dialog.component';

describe('AddressRemoveDialogComponent', () => {
  let component: AddressRemoveDialogComponent;
  let fixture: ComponentFixture<AddressRemoveDialogComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AddressRemoveDialogComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AddressRemoveDialogComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
