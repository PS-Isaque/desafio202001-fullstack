import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { EnderecoDetailsComponent } from './endereco-details.component';

describe('EnderecoDetailsComponent', () => {
  let component: EnderecoDetailsComponent;
  let fixture: ComponentFixture<EnderecoDetailsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ EnderecoDetailsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(EnderecoDetailsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
