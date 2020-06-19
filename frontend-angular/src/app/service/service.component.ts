import { Component, Input } from '@angular/core';
import { Service } from '../serv/service.model';

@Component({
  selector: 'app-service',
  templateUrl: './service.component.html',
  styleUrls: ['./service.component.css']
})
export class ServiceComponent {

  @Input()
  service: Service;

  @Input()
  order: number;

}
