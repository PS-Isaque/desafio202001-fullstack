import { Injectable } from '@angular/core';
import { Observable, of, throwError } from 'rxjs';
import { HttpClient, HttpHeaders, HttpErrorResponse } from '@angular/common/http';
import { catchError, tap, map } from 'rxjs/operators';
import { Endereco } from '../models/endereco';

const httpOptions = {
  headers: new HttpHeaders({'Content-Type': 'application/json'})
};
const apiUrl = "/api/enderecos";

@Injectable({
  providedIn: 'root'
})
export class ApiService {

  constructor(private http: HttpClient) { }

  getEnderecos():Observable<Endereco[]> {
    return this.http.get<Endereco[]>(apiUrl)
      .pipe(
        tap(enderecos => console.log('Endereços lidos')),
        catchError(this.handleError('getEnderecos', []))
      );
  }

  getEndereco(id: number):Observable<Endereco> {
    const url = `${apiUrl}/${id}`;
    return this.http.get<Endereco>(url).pipe(
      tap(_ => console.log(`Leu o endereço id=${id}`)),
      catchError(this.handleError<Endereco>(`getEndereco id=${id}`))
    );
  }

  postEndereco(endereco):Observable<Endereco> {
    return this.http.post<Endereco>(apiUrl, endereco, httpOptions).pipe(
      tap((endereco: Endereco) => {
        alert('ENDEREÇO CADASTRADO COM SUCESSO!');
        console.log(`Adicionou o endereço com o id=${endereco.id}`);
      }),
      catchError(this.handleError<Endereco>('postEndereco'))
    );
  }

  updateEndereco(id, endereco):Observable<any> {
    const url = `${apiUrl}/${id}`;
    return this.http.put(url, endereco, httpOptions).pipe(
      tap(_ => {
        alert('ENDEREÇO EDITADO COM SUCESSO!');
        console.log(`Atualizou o id=${id}`);
      }),
      catchError(this.handleError<any>('updateEndereco'))
    );
  }

  deleteEndereco(id):Observable<Endereco> {
    const url = `${apiUrl}/${id}`;
    return this.http.delete<Endereco>(url, httpOptions).pipe(
      tap(_ => console.log(`Removeu o endereço com id=${id}`)),
      catchError(this.handleError<Endereco>('deleteEndereco'))
    );
  }

  private handleError<T> (operation = 'operation', result?: T) {
    return (error: any): Observable<T> => {
      console.error(error);
      return of(result as T);
    };
  }
}
