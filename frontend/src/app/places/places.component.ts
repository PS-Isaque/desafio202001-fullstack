import { Component, OnInit } from "@angular/core";
import { Place } from "../place";
import { PlaceService } from "../place.service";

@Component({
  selector: "app-places",
  templateUrl: "./places.component.html",
  styleUrls: ["./places.component.css"]
})
export class PlacesComponent implements OnInit {
  places: Place[];

  constructor(private placeService: PlaceService) {}
  ngOnInit() {
    this.getPlaces();
  }

  getPlaces(): void {
    this.placeService.getPlaces().subscribe(places => (this.places = places));
  }

  add(address: string): void {
    address = address.trim();

    if (!address) {
      return;
    }

    this.placeService
      .addPlace({ address } as Place)
      .subscribe(place => this.places.push(place));
  }

  delete(place: Place): void {
    alert("deletar");
    this.places = this.places.filter(p => p !== place);
    this.placeService.deletePlace(place).subscribe();
  }
}
