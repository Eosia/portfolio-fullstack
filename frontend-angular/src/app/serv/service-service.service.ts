import { Injectable } from "@angular/core";
import { HttpHeaders, HttpClient, HttpResponse} from '@angular/common/http';
import { Service } from './service.model';
import { Observable } from 'rxjs';

@Injectable({
    providedIn: 'root'
})
export class ServiceService {
    SERVER_URL = 'https://kevinw-portfolio.xyz/admin/api.php?entity=service';

    private httpHeaders = new HttpHeaders({
        'Content-Type':  'application/json',
        'Accept': 'application/json',
    });

    constructor(private http: HttpClient) {}

    findAll(): Observable<HttpResponse<Service[]>> {
        return this.http.get<Service[]>(this.SERVER_URL, {headers: this.httpHeaders, observe: 'response'}) ;
    }
}
