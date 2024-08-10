import { Component } from '@angular/core';

import { JsonPipe } from '@angular/common';

import { NavbarComponent } from '@components/navbar/navbar.component';
import { CardOwnerMessageComponent } from '@components/card-owner-message/card-owner-message.component';
import { ModalInfoDevComponent } from '@components/modal-info-dev/modal-info-dev.component';
import { ModalEditUserComponent } from '@components/modal-edit-user/modal-edit-user.component';
import { ModalRegisterMessageComponent } from '@components/modal-register-message/modal-register-message.component';
import { ModalEditMessageComponent } from '@components/modal-edit-message/modal-edit-message.component';

import { User } from '@models/User.model';
import { Message } from '@models/Message.model';

@Component({
  selector: 'app-page-panel',
  standalone: true,
  imports: [
    NavbarComponent,
    CardOwnerMessageComponent,
    ModalInfoDevComponent,
    ModalEditUserComponent,
    ModalRegisterMessageComponent,
    ModalEditMessageComponent,
    JsonPipe,
  ],
  templateUrl: './page-panel.component.html',
  styleUrl: './page-panel.component.css',
})
export class PagePanelComponent {
  displayInfoDev: boolean = false;
  displayEditUser: boolean = false;
  displayRegisterMessage: boolean = false;
  displayEditMessage: boolean = false;

  userInfo: Partial<User> = {};
  messageInfo: Partial<Message> = {};

  changeDisplayInfoDev(event: boolean): void {
    this.displayInfoDev = event;
  }

  changeDisplayEditUser(event: boolean): void {
    this.displayEditUser = event;
  }

  getUserInfo(event: Partial<User>): void {
    this.userInfo = event;
  }

  changeUserInfo(event: Partial<User>): void {
    this.userInfo = event;
  }

  showModalRegisterMessage(event: boolean): void {
    this.displayRegisterMessage = event;
  }

  showModalEditMessage(event: boolean): void {
    this.displayEditMessage = event;
  }

  changeMessageInfo(event: Message): void {
    this.messageInfo = event;
  }

  messageUpdated(event: Message): void {
    this.messageInfo = event;
  }
}
