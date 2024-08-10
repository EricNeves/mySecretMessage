import { Component } from '@angular/core';

import { JsonPipe } from '@angular/common';

import { NavbarComponent } from '@components/navbar/navbar.component';
import { CardOwnerMessageComponent } from '@components/card-owner-message/card-owner-message.component';
import { ModalInfoDevComponent } from '@components/modal-info-dev/modal-info-dev.component';
import { ModalEditUserComponent } from '@components/modal-edit-user/modal-edit-user.component';

import { User } from '@models/User.model';

@Component({
  selector: 'app-page-panel',
  standalone: true,
  imports: [
    NavbarComponent,
    CardOwnerMessageComponent,
    ModalInfoDevComponent,
    ModalEditUserComponent,
    JsonPipe,
  ],
  templateUrl: './page-panel.component.html',
  styleUrl: './page-panel.component.css',
})
export class PagePanelComponent {
  displayInfoDev: boolean = false;
  displayEditUser: boolean = false;

  userInfo: Partial<User> = {};

  changeDisplayInfoDev(event: any): void {
    this.displayInfoDev = event;
  }

  changeDisplayEditUser(event: any): void {
    this.displayEditUser = event;
  }

  getUserInfo(event: Partial<User>): void {
    this.userInfo = event;
  }

  changeUserInfo(event: Partial<User>): void {
    this.userInfo = event;
  }
}
