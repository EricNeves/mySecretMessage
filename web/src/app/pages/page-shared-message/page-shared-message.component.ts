import { Component, OnInit } from '@angular/core';

import { ModalPasswordSharedMessageComponent } from '@components/modal-password-shared-message/modal-password-shared-message.component';
import { CardSharedMessageComponent } from '@components/card-shared-message/card-shared-message.component';

import { Message } from '@models/Message.model';

@Component({
  selector: 'app-page-shared-message',
  standalone: true,
  imports: [ModalPasswordSharedMessageComponent, CardSharedMessageComponent],
  templateUrl: './page-shared-message.component.html',
  styleUrl: './page-shared-message.component.css',
})
export class PageSharedMessageComponent implements OnInit {
  displayModalPasswordSharedMessage: boolean = true;
  displaySharedMessage: boolean = false;
  messageInfo!: Message;

  constructor() {}

  ngOnInit(): void {}

  changeMessageVisibility(event: boolean): void {
    this.displaySharedMessage = event;
  }

  getMessage(message: Message): void {
    this.messageInfo = message;
  }
}
