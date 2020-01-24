import { Injectable } from '@angular/core';
import { CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot, UrlTree, Resolve } from '@angular/router';
import { Observable, of } from 'rxjs';
import { Address } from './../models/address.models';
import { CrudService } from '../services/crud.service';

@Injectable({
  providedIn: 'root'
})
export class AddressResolverGuard implements Resolve<Address> {

  constructor(private service: CrudService) {}

  resolve(route: ActivatedRouteSnapshot, state: RouterStateSnapshot): Observable<Address> {
    if(route.params && route.params['id']) {
      return this.service.loadByID(route.params['id']);
    }

  }

}
