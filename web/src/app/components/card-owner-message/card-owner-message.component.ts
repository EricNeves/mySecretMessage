import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';

import { InplaceModule } from 'primeng/inplace';
import { PanelModule } from 'primeng/panel';
import { AvatarModule } from 'primeng/avatar';
import { ButtonModule } from 'primeng/button';
import { MenuModule } from 'primeng/menu';
import { TagModule } from 'primeng/tag';
import { MessageService as MessageToast } from 'primeng/api';
import { ToastModule } from 'primeng/toast';

import { UserService } from '@services/user.service';
import { MessageService } from '@services/message.service';

import { User } from '@models/User.model';
import { Message } from '@models/Message.model';

import { forkJoin } from 'rxjs';

@Component({
  selector: 'app-card-owner-message',
  standalone: true,
  imports: [
    InplaceModule,
    PanelModule,
    AvatarModule,
    ButtonModule,
    MenuModule,
    TagModule,
    ToastModule,
  ],
  providers: [MessageToast],
  templateUrl: './card-owner-message.component.html',
  styleUrl: './card-owner-message.component.css',
})
export class CardOwnerMessageComponent implements OnInit {
  @Output() userInfo = new EventEmitter<Partial<User>>();
  @Output() showModalRegisterMessage = new EventEmitter<boolean>();
  @Output() showModalEditMessage = new EventEmitter<boolean>();
  @Input() user: Partial<User> = {};
  @Input() message: Partial<Message> = {};

  displayModalRegisterMessage: boolean = false;
  displayModalEditMessage: boolean = false;

  items: any[] = [];

  constructor(
    private userService: UserService,
    private messageService: MessageService,
    private messageToast: MessageToast
  ) {}

  ngOnInit() {
    this.items = [
      {
        label: 'Create Message',
        icon: 'pi pi-plus',
        command: () => {
          this.displayModalRegisterMessage = !this.displayModalRegisterMessage;
          this.showModalRegisterMessage.emit(this.displayModalRegisterMessage);
        },
      },
      {
        label: 'Edit Message',
        icon: 'pi pi-pencil',
        command: () => {
          if (!this.message.message) {
            this.messageToast.add({
              severity: 'warn',
              summary: 'Warning',
              detail: "You don't have any messages to edit.",
            });
            return;
          }

          this.displayModalEditMessage = !this.displayModalEditMessage;

          this.showModalEditMessage.emit(this.displayModalEditMessage);
        },
      },
      {
        separator: true,
      },
      {
        label: 'Delete Message',
        icon: 'pi pi-trash',
      },
    ];

    forkJoin({
      user: this.userService.getUser(),
      message: this.messageService.getMessage(),
    }).subscribe({
      next: (response) => {
        this.user = response.user.data;
        this.message = response.message.data;

        this.userInfo.emit(this.user);
      },
      error: (error) => {
        this.messageToast.add({
          severity: 'error',
          summary: 'Error',
          detail: error.error.message,
        });
      },
    });
  }

  openGitHub() {
    window.open('https://github.com/EricNeves/mySecretMessage', '_blank');
  }
}
