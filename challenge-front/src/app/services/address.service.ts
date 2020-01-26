import {Injectable} from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {Observable} from 'rxjs';
import {IAddress} from '../address/address';

const httpOptions = {
  headers: new HttpHeaders({
    'Content-Type': 'application/json',
    'Access-Control-Allow-Origin': '*',
  })
};

@Injectable({
  providedIn: 'root'
})
export class AddressService {

  private _url: string = 'http://localhost:4200/api/v1';

  constructor(private http: HttpClient) {
  }

  getAddresses(): Observable<IAddress[]> {
    return this.http.get<IAddress[]>(this._url + '/address/all', httpOptions);
  }

  getAddress(id): Observable<IAddress> {
    return this.http.get<IAddress>(this._url + '/address/' + id, httpOptions);
  }

  createAddress(address) {
    const body = JSON.stringify(address);
    console.log(body)
    return this.http.post(this._url + '/address/create', body, httpOptions);
  }

  updateAddress(id, address) {
    const body = JSON.stringify(address);
    return this.http.patch(this._url + '/address/update/' + id, body, httpOptions);
  }

  deleteAddress(address) {
    return this.http.delete(this._url + '/address/' + address.id, httpOptions);
  }
}
