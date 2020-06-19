import { Injectable } from "@angular/core";
import { HttpHeaders, HttpClient, HttpResponse} from '@angular/common/http';
import { Realisation } from './realisation.model';
import { Observable } from 'rxjs';

@Injectable({
    providedIn: 'root'
})
export class RealisationService {
    SERVER_URL = 'https://kevinw-portfolio.xyz/admin/api.php?entity=realisation';

    private httpHeaders = new HttpHeaders({
        'Content-Type':  'application/json',
        'Accept': 'application/json',
    });

    constructor(private http: HttpClient) {}

    findAll(): Observable<HttpResponse<Realisation[]>> {
        return this.http.get<Realisation[]>(this.SERVER_URL, {headers: this.httpHeaders, observe: 'response'}) ;
    }
}
