import { Component, OnInit, OnDestroy } from "@angular/core";
import { DataService } from "../data.service";

import { takeUntil } from "rxjs/operators";
import { Subject } from "rxjs";

@Component({
  selector: "app-place",
  templateUrl: "./place.component.html",
  styleUrls: ["./place.component.css"]
})
export class PlaceComponent implements OnInit, OnDestroy {
  places = [];
  lat;
  log;
  destroy$: Subject<boolean> = new Subject<boolean>();
  constructor(private ds: DataService) {}

  ngOnInit() {
    navigator.geolocation.getCurrentPosition(position => {
      const { latitude, longitude } = position.coords;
      this.lat = latitude;
      this.log = longitude;
    });
    console.log("component mounted");
    this.ds
      .getPlaces()
      .pipe(takeUntil(this.destroy$))
      .subscribe((data: any[]) => {
        console.log(data);
        this.places = data.data;
      });
  }

  ngOnDestroy() {
    this.destroy$.next(true);

    //Unsubscribe request
    this.destroy$.unsubscribe();
  }
}
