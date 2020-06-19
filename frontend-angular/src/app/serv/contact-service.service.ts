import { Injectable } from "@angular/core";
import { HttpClient, HttpResponse} from '@angular/common/http';
import { ContactModel } from './contact.model';
import { Observable } from 'rxjs';

@Injectable({
    providedIn: 'root'
})
export class ContactService {
    SERVER_URL = 'https://kevinw-portfolio.xyz/admin/api.php?entity=contactMessage';

    constructor(private http: HttpClient) {}

    postContactForm(contactMessage: ContactModel) : Observable<HttpResponse<ContactModel>> {
        return this.http.post<ContactModel>(this.SERVER_URL, contactMessage, {observe: 'response'});
    }
}
