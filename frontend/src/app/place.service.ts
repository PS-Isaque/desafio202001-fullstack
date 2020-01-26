import { Injectable } from "@angular/core";
import { Observable, of } from "rxjs";
import { catchError, map, tap } from "rxjs/operators";
import { HttpClient, HttpHeaders } from "@angular/common/http";

import { Place } from "./place";
import { MessageService } from "./message.service";

@Injectable({
  providedIn: "root"
})
export class PlaceService {
  private BaseUrl = "http://localhost:3333/api/places";
  httpOptions = {
    headers: new HttpHeaders({ "Content-Type": "application/json" })
  };
  constructor(
    private messageService: MessageService,
    private http: HttpClient
  ) {}

  getPlaces(): Observable<Place[]> {
    return this.http.get<Place[]>(this.BaseUrl).pipe(
      tap(_ => this.log("fetched from api, places")),
      catchError(this.handleError<Place[]>("getPlaces", []))
    );
  }

  getPlace(id: number): Observable<Place> {
    const url = `${this.BaseUrl}/${id}`;

    return this.http.get<Place>(url).pipe(
      tap(_ => this.log(`fetched from api... place id=${id}`)),
      catchError(this.handleError<Place>(`getHero id=${id}`))
    );
  }

  updatePlace(place: Place): Observable<any> {
    const url = `${this.BaseUrl}/${place.id}/update`;
    return this.http.put(url, place, this.httpOptions).pipe(
      tap(_ => this.log(`updated place id=${place.id}`)),
      catchError(this.handleError<any>("updateHero"))
    );
  }

  addPlace(place: Place): Observable<Place> {
    return this.http.post<Place>(this.BaseUrl, place, this.httpOptions).pipe(
      tap((newPlace: Place) => this.log(`added place w/ id=${newPlace.id}`)),
      catchError(this.handleError<Place>("addPlace"))
    );
  }

  deletePlace(place: Place | number): Observable<Place> {
    const id = typeof place === "number" ? place : place.id;
    const url = `${this.BaseUrl}/${id}/destroy`;

    return this.http.delete<Place>(url, this.httpOptions).pipe(
      tap(_ => this.log(`deleted place id=${id}`)),
      catchError(this.handleError<Place>("Delete Place"))
    );
  }

  searchPlaces(term: string): Observable<Place[]> {
    if (!term.trim()) {
      return of([]);
    }

    return this.http.get<Place[]>(`${this.BaseUrl}/?name=${term}`).pipe(
      tap(_ => this.log(`Found places mathing "${term}"`)),
      catchError(this.handleError<Place[]>("Search Places", []))
    );
  }

  private log(message: string) {
    this.messageService.add(`PlaceService: ${message}`);
  }

  private handleError<T>(operation = "operation", result?: T) {
    return (error: any): Observable<T> => {
      console.error(error);

      this.log(`${operation} failed: ${error.message}`);

      return of(result as T);
    };
  }
}
