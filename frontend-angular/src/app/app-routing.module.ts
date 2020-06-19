import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { RealisationsComponent } from './realisations/realisations.component';
import { ServicesComponent } from './services/services.component';
import { ContactComponent } from './contact/contact.component';


const routes: Routes = [
  {path: '', component: HomeComponent},
  {path: 'contact', component: ContactComponent},
  {path: 'realisations', component: RealisationsComponent},
  {path: 'services', component: ServicesComponent},
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
