import {
  Component,
  EventEmitter,
  Input,
  OnChanges,
  OnInit,
  Output,
  SimpleChanges,
} from '@angular/core';

import { ModalSharedLinkComponent } from '@components/modal-shared-link/modal-shared-link.component';

import { InplaceModule } from 'primeng/inplace';
import { PanelModule } from 'primeng/panel';
import { AvatarModule } from 'primeng/avatar';
import { ButtonModule } from 'primeng/button';
import { MenuModule } from 'primeng/menu';
import { TagModule } from 'primeng/tag';
import {
  ConfirmationService,
  MessageService as MessageToast,
} from 'primeng/api';
import { ToastModule } from 'primeng/toast';
import { ConfirmDialogModule } from 'primeng/confirmdialog';

import { UserService } from '@services/user.service';
import { MessageService } from '@services/message.service';

import { User } from '@models/User.model';
import { Message } from '@models/Message.model';

import { forkJoin } from 'rxjs';
import { environment } from 'src/environments/environment.development';

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
    ConfirmDialogModule,
    ModalSharedLinkComponent,
  ],
  providers: [MessageToast, ConfirmationService],
  templateUrl: './card-owner-message.component.html',
  styleUrl: './card-owner-message.component.css',
})
export class CardOwnerMessageComponent implements OnInit, OnChanges {
  @Output() userInfo = new EventEmitter<Partial<User>>();
  @Output() showModalRegisterMessage = new EventEmitter<boolean>();
  @Output() showModalEditMessage = new EventEmitter<boolean>();
  @Input() user: Partial<User> = {};
  @Input() message: Partial<Message> = {};

  displayModalRegisterMessage: boolean = false;
  displayModalEditMessage: boolean = false;
  displayModalSharedMessage: boolean = false;

  sharedLink: string = '';

  items: any[] = [];

  constructor(
    private userService: UserService,
    private messageService: MessageService,
    private messageToast: MessageToast,
    private confirmationService: ConfirmationService
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
              detail: "You don't have any message to edit.",
            });
            return;
          }

          this.displayModalEditMessage = !this.displayModalEditMessage;

          this.showModalEditMessage.emit(this.displayModalEditMessage);
        },
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

  ngOnChanges(changes: SimpleChanges): void {
    if (changes['message']) {
      this.sharedLink = `${environment.sharedMessageBaseUrl}/${this.message.user_id}/${this.message.message_id}`;
    }
  }

  confirmDelete(event: Event) {
    if (!this.message.message) {
      this.messageToast.add({
        severity: 'warn',
        summary: 'Warning',
        detail: "You don't have any message to delete.",
      });
      return;
    }

    this.confirmationService.confirm({
      target: event.target as EventTarget,
      message: 'Do you want to delete this record?',
      header: 'Delete Confirmation',
      icon: 'pi pi-info-circle',
      acceptButtonStyleClass: 'p-button-danger p-button-text',
      rejectButtonStyleClass: 'p-button-text p-button-text',
      acceptIcon: 'none',
      rejectIcon: 'none',

      accept: () => {
        this.messageService.deleteMessage().subscribe({
          next: () => {
            this.message = {};
            this.messageToast.add({
              severity: 'success',
              summary: 'Confirmed',
              detail: 'Message deleted successfully',
            });
          },
          error: (error) => {
            this.messageToast.add({
              severity: 'error',
              summary: 'Error',
              detail: error.error.message,
            });
          },
        });
      },
    });
  }

  openSharedLink() {
    if (!this.message.message) {
      this.messageToast.add({
        severity: 'warn',
        summary: 'Warning',
        detail: "You don't have any message yet.",
      });
      return;
    }

    this.sharedLink = `${environment.sharedMessageBaseUrl}/${this.message.user_id}/${this.message.message_id}`;

    this.displayModalSharedMessage = !this.displayModalSharedMessage;
  }

  openGithubLink() {
    window.open(`${environment.githubRepoUrl}`, '_blank');
  }
}
