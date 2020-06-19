import { Component, OnInit } from '@angular/core';
import { Realisation } from '../serv/realisation.model';
import { RealisationService } from '../serv/realisation-service.service';
import { HttpResponse } from '@angular/common/http';

@Component({
  selector: 'app-realisations',
  templateUrl: './realisations.component.html',
  styleUrls: ['./realisations.component.css']
})
export class RealisationsComponent implements OnInit {

  mainParagraphe: string;
  realisations?: Realisation[];

  constructor(private realisationService: RealisationService) { }

  ngOnInit(): void {
    this.mainParagraphe = "Mes différents sites réalisés";

    this.realisationService.findAll()
      .subscribe((res: HttpResponse<Realisation[]>) => this.realisations = res.body );
  }
}
