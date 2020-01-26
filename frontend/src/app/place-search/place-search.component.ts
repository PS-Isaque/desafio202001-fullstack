import { Component, OnInit } from "@angular/core";
import { Observable, Subject } from "rxjs";

import { debounceTime, distinctUntilChanged, switchMap } from "rxjs/operators";

import { Place } from "../place";
import { PlaceService } from "../place.service";

@Component({
  selector: "app-place-search",
  templateUrl: "./place-search.component.html",
  styleUrls: ["./place-search.component.css"]
})
export class PlaceSearchComponent implements OnInit {
  places$: Observable<Place[]>;

  private searchTerms = new Subject<string>();

  constructor(private placeService: PlaceService) {}

  search(term: string): void {
    this.searchTerms.next(term);
  }

  ngOnInit() {
    this.places$ = this.searchTerms.pipe(
      //aguarda 300 ms pra casa tecla pressionada antes de pegar o termo digitado
      debounceTime(300),
      //ignora se a string passa é igual a anterior
      distinctUntilChanged(),
      switchMap((term: string) => this.placeService.searchPlaces(term))
    );
  }
}
