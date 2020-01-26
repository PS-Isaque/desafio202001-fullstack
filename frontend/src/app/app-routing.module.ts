import { NgModule } from "@angular/core";
import { Routes, RouterModule } from "@angular/router";
import { CommonModule } from "@angular/common";

import { PlacesComponent } from "./places/places.component";
import { DashboardComponent } from "./dashboard/dashboard.component";
import { PlaceDetailComponent } from "./place-detail/place-detail.component";

const routes: Routes = [
  { path: "", redirectTo: "/dashboard", pathMatch: "full" },
  { path: "places", component: PlacesComponent },
  { path: "detail/:id", component: PlaceDetailComponent },
  {
    path: "dashboard",
    component: DashboardComponent
  }
];
@NgModule({
  exports: [RouterModule],
  imports: [RouterModule.forRoot(routes)]
})
export class AppRoutingModule {}
