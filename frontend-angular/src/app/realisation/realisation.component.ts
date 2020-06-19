import { Component, Input } from '@angular/core';
import { Realisation } from '../serv/realisation.model';

@Component({
  selector: 'app-realisation',
  templateUrl: './realisation.component.html',
  styleUrls: ['./realisation.component.css']
})
export class RealisationComponent {

  @Input()
  realisation: Realisation;

  @Input()
  order: number;

}
