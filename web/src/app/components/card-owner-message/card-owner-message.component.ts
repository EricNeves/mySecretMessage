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

  items: {
    label?: string;
    icon?: string;
    separator?: boolean;
    command?: () => any;
  }[] = [];

  @Input() user: Partial<User> = {
    name: '',
  };

  message: Partial<Message> = {
    message_id: '',
    message: '',
    user_id: '',
    ttl_seconds: 0,
  };

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
          alert('ok');
        },
      },
      {
        label: 'Edit Message',
        icon: 'pi pi-pencil',
      },
      {
        separator: true,
      },
      {
        label: 'Delete Message',
        icon: 'pi pi-times',
      },
    ];

    forkJoin({
      user: this.userService.getUser(),
      message: this.messageService.getMessages(),
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
}
