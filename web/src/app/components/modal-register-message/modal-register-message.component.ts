import { Component, EventEmitter, Input, Output } from '@angular/core';

import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ReactiveFormsModule } from '@angular/forms';

import { DialogModule } from 'primeng/dialog';
import { InputTextModule } from 'primeng/inputtext';
import { MessagesModule } from 'primeng/messages';
import { PasswordModule } from 'primeng/password';
import { ButtonModule } from 'primeng/button';
import { ToastModule } from 'primeng/toast';
import { InputTextareaModule } from 'primeng/inputtextarea';

import { MessageService as MessageToast } from 'primeng/api';
import { MessageService } from '@services/message.service';
import { Message } from '@models/Message.model';

@Component({
  selector: 'app-modal-register-message',
  standalone: true,
  imports: [
    DialogModule,
    InputTextModule,
    MessagesModule,
    PasswordModule,
    ButtonModule,
    ToastModule,
    InputTextareaModule,
    ReactiveFormsModule,
  ],
  providers: [MessageToast],
  templateUrl: './modal-register-message.component.html',
  styleUrl: './modal-register-message.component.css',
})
export class ModalRegisterMessageComponent {
  @Input() display: boolean = false;
  @Output() changeMessageInfo = new EventEmitter<Message>();

  messageForm!: FormGroup;

  submitted: boolean = false;

  controlNames: { [key: string]: string } = {
    message: 'Message',
    ttl_seconds: 'Message Duration (seconds)',
    secret_key: 'Secret Key',
  };

  constructor(
    private messageToast: MessageToast,
    private fb: FormBuilder,
    private messageService: MessageService
  ) {
    this.messageForm = this.fb.group({
      message: ['', Validators.required],
      ttl_seconds: ['', Validators.required],
      secret_key: ['', Validators.required],
    });
  }

  onSubmit() {
    this.submitted = true;

    if (this.messageForm.invalid) {
      Object.keys(this.messageForm.controls).map((key) => {
        this.getErrorMessage(key);
      });

      this.submitted = false;
      return;
    }

    const message: Message = this.messageForm.value;

    this.messageService.register(message).subscribe({
      next: (response) => {
        this.messageToast.add({
          severity: 'success',
          summary: 'Success',
          detail: 'Message registered successfully',
        });

        this.changeMessageInfo.emit(response.data);

        this.messageForm.reset();
        this.submitted = false;
        this.display = false;
        return;
      },
      error: (error) => {
        this.messageToast.add({
          severity: 'error',
          summary: 'Error',
          detail: error.error.message,
        });

        this.messageForm.reset();
        this.submitted = false;
        return;
      },
    });
  }

  getErrorMessage(controlName: string): void {
    const control = this.messageForm.get(controlName);

    if (control?.hasError('required')) {
      this.messageToast.add({
        severity: 'warn',
        summary: 'Warning',
        detail: `The field ${this.controlNames[controlName]} is required`,
      });
    }
  }
}
