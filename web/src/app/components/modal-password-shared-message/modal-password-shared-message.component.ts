import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';

import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ReactiveFormsModule } from '@angular/forms';

import { DialogModule } from 'primeng/dialog';
import { ButtonModule } from 'primeng/button';
import { PasswordModule } from 'primeng/password';
import { ToastModule } from 'primeng/toast';

import { MessageService } from '@services/message.service';
import { Message } from '@models/Message.model';
import { MessageService as MessageToast } from 'primeng/api';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-modal-password-shared-message',
  standalone: true,
  imports: [
    DialogModule,
    ReactiveFormsModule,
    PasswordModule,
    ToastModule,
    ButtonModule,
  ],
  providers: [MessageToast],
  templateUrl: './modal-password-shared-message.component.html',
  styleUrl: './modal-password-shared-message.component.css',
})
export class ModalPasswordSharedMessageComponent implements OnInit {
  @Input() display: boolean = true;
  @Output() changeMessageVisibility = new EventEmitter<boolean>();
  @Output() message = new EventEmitter<Message>();

  messageSecretKeyForm!: FormGroup;

  userId: string = '';
  messageId: string = '';

  submitted: boolean = false;

  controlNames: { [key: string]: string } = {
    secret_key: 'Secret Key',
  };

  constructor(
    private fb: FormBuilder,
    private messageService: MessageService,
    private messageToast: MessageToast,
    private route: ActivatedRoute
  ) {
    this.messageSecretKeyForm = this.fb.group({
      secret_key: ['', Validators.required],
    });
  }

  ngOnInit(): void {
    this.userId = this.route.snapshot.params['id'];
    this.messageId = this.route.snapshot.params['uuid'];
  }

  showMessageSubmit() {
    this.submitted = true;

    if (this.messageSecretKeyForm.invalid) {
      Object.keys(this.messageSecretKeyForm.controls).map((key) => {
        this.getErrorMessage(key);
      });

      this.submitted = false;
      return;
    }

    const message: Message = {
      ...this.messageSecretKeyForm.value,
      user_id: this.userId,
      message_id: this.messageId,
    };

    this.messageService.getSharedMessage(message).subscribe({
      next: (response) => {
        this.messageToast.add({
          severity: 'success',
          summary: 'Success',
          detail: "You've successfully decrypted the message",
        });

        this.message.emit(response.data);
        this.changeMessageVisibility.emit(true);

        this.submitted = false;
        this.messageSecretKeyForm.reset();
        this.display = false;
      },
      error: (error) => {
        this.messageToast.add({
          severity: 'error',
          summary: 'Error',
          detail: error.error.message,
        });

        this.submitted = false;
        this.messageSecretKeyForm.reset();

        return;
      },
    });
  }

  getErrorMessage(controlName: string): void {
    const control = this.messageSecretKeyForm.get(controlName);

    if (control?.hasError('required')) {
      this.messageToast.add({
        severity: 'warn',
        summary: 'Warning',
        detail: `The field ${this.controlNames[controlName]} is required`,
      });
    }
  }
}
