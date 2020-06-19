import { Component, OnInit } from '@angular/core';
import { Service } from '../serv/service.model';
import { ServiceService } from '../serv/service-service.service';
import { HttpResponse } from '@angular/common/http';

@Component({
  selector: 'app-services',
  templateUrl: './services.component.html',
  styleUrls: ['./services.component.css']
})
export class ServicesComponent implements OnInit {

  mainParagraphe: string;
  services?: Service[];

  constructor(private serviceService: ServiceService) { }

  ngOnInit(): void {
    this.mainParagraphe = "Mes compétences en web développement.";

    this.serviceService.findAll()
      .subscribe((res: HttpResponse<Service[]>) => this.services = res.body );
  }
}
