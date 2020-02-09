import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DetalheEnderecoComponent } from './detalhe-endereco.component';

describe('DetalheEnderecoComponent', () => {
  let component: DetalheEnderecoComponent;
  let fixture: ComponentFixture<DetalheEnderecoComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DetalheEnderecoComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DetalheEnderecoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
