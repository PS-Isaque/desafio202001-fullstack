import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Endereco } from './endereco';

const httpOptions = {
  headers: new HttpHeaders({ 'Content-Type': 'application/json' })
};

@Injectable({
  providedIn: 'root'
})
export class EnderecoService {
  private enderecosUrl = 'http://localhost:8080/api/enderecos';  // URL da API
  constructor( 
    private http: HttpClient
  ) { }

  getEnderecos (): Observable<Endereco[]> {
    return this.http.get<Endereco[]>(this.enderecosUrl)
  }

  getEndereco(id: number): Observable<Endereco> {
    const url = `${this.enderecosUrl}/${id}`;
    return this.http.get<Endereco>(url);
  }

  addEndereco (endereco: Endereco): Observable<Endereco> {
    return this.http.post<Endereco>(this.enderecosUrl, endereco, httpOptions);
  }

  deleteEndereco (endereco: Endereco | number): Observable<Endereco> {
    const id = typeof endereco === 'number' ? endereco : endereco.id;
    const url = `${this.enderecosUrl}/${id}`;

    return this.http.delete<Endereco>(url, httpOptions);
  }

  updateEndereco (endereco: Endereco): Observable<any> {
    const id = typeof endereco === 'number' ? endereco : endereco.id;
    const url = `${this.enderecosUrl}/${id}`;
    return this.http.put(url, endereco, httpOptions);
  }
}