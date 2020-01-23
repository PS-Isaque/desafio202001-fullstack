import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Address } from './../models/address.models';

@Injectable({
  providedIn: 'root'
})

export class CrudService {
  private BASE_URL = 'http://localhost:3333';

  constructor(private http: HttpClient) { }
  public getIndex(): Observable<any> {
    return this.http.get(`${this.BASE_URL}/address`);
  }
}
