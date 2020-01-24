import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { take } from 'rxjs/operators';
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

  public loadByID(id): Observable<any> {
    return this.http.get<Address>(`${this.BASE_URL}/address/${id}`).pipe(take(1));
  }

  public create(address) {
    return this.http.post(`${this.BASE_URL}/address`, address).pipe(take(1));
  }

  public update(id): Observable<any> {
    return this.http.put(`${this.BASE_URL}/address/${id}/update`, id).pipe(take(1));
  }
}
