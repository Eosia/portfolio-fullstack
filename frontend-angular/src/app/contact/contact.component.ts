import { Component, OnInit } from '@angular/core';
import { ContactModel } from '../serv/contact.model';
import { ContactService } from '../serv/contact-service.service';

@Component({
  selector: 'app-contact',
  templateUrl: './contact.component.html',
  styleUrls: ['./contact.component.css']
})
export class ContactComponent implements OnInit {

  contactMessage: ContactModel = new ContactModel();

  contactSuccess = false;
  contactSubmit = false;

  constructor(private contactService: ContactService) { }

  ngOnInit(): void {
  }

  submitForm() {
    //if (this.isContactValid())
    // on envoie le message au serveur
  }

  private isContactValid() {
    return this.contactMessage.email && this.contactMessage.name && this.contactMessage.message;
  }

  isNameValid() {
    return this.contactMessage.name.length > 3;
  }

  isEmailValid() {
    return /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/.test(this.contactMessage.email);
  }

  isMessageValid() {
    return this.contactMessage.message.length > 10;
  }

  postContactForm() {
    if(this.isContactValid()) {
      this.contactSubmit = true;
      this.contactService.postContactForm(this.contactMessage)
      .subscribe(
        (res) => {
          this.contactSuccess = true;
          this.contactSubmit = true;
        },
          () => this.contactSuccess = false
      );
    }
  }
}
