import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';

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
  selector: 'app-modal-edit-message',
  standalone: true,
  imports: [
    DialogModule,
    InputTextModule,
    MessagesModule,
    PasswordModule,
    ButtonModule,
    ToastModule,
    ReactiveFormsModule,
    InputTextareaModule,
  ],
  providers: [MessageToast],
  templateUrl: './modal-edit-message.component.html',
  styleUrl: './modal-edit-message.component.css',
})
export class ModalEditMessageComponent implements OnInit {
  @Input() display: boolean = false;
  @Output() changeMessageInfo = new EventEmitter<Message>();
  @Output() messageUpdated = new EventEmitter<Message>();

  messageEditForm!: FormGroup;
  messageSecretKeyForm!: FormGroup;

  submitted: boolean = false;

  enableEdit: boolean = false;

  controlNames: { [key: string]: string } = {
    message: 'Message',
    ttl_seconds: 'Message Duration (seconds)',
    old_secret_key: 'Old Secret Key',
    new_secret_key: 'New Secret Key',
  };

  constructor(
    private messageToast: MessageToast,
    private fb: FormBuilder,
    private messageService: MessageService
  ) {
    this.messageSecretKeyForm = this.fb.group({
      secret_key: ['', Validators.required],
    });
  }

  ngOnInit() {
    this.initForm();
  }

  initForm(): void {
    this.messageEditForm = this.fb.group({
      message: ['', Validators.required],
      ttl_seconds: ['', Validators.required],
      old_secret_key: ['', Validators.required],
      new_secret_key: ['', Validators.required],
    });
  }

  onSubmit() {
    this.submitted = true;

    if (this.messageEditForm.invalid) {
      Object.keys(this.messageEditForm.controls).map((key) => {
        this.getErrorMessage(key);
      });

      this.submitted = false;
      return;
    }

    const message: Message = this.messageEditForm.value;

    this.messageService.updateMessage(message).subscribe({
      next: (response) => {
        this.messageToast.add({
          severity: 'success',
          summary: 'Success',
          detail: 'Message updated successfully',
        });

        this.messageUpdated.emit(response.data);
        this.messageEditForm.reset();
        this.display = false;
        this.submitted = false;
        this.enableEdit = false;
      },
      error: (error) => {
        this.messageToast.add({
          severity: 'error',
          summary: 'Error',
          detail: error.error.message,
        });
        return;
      },
    });
  }

  enableEditMessageForm(): void {
    if (this.messageSecretKeyForm.invalid) {
      Object.keys(this.messageSecretKeyForm.controls).map((key) => {
        this.getErrorMessage(key);
      });

      this.submitted = false;
      return;
    }

    const message: Message = this.messageSecretKeyForm.value;

    this.messageService.getSecretMessage(message).subscribe({
      next: (response) => {
        this.messageEditForm.patchValue({
          message: response.data.message,
          ttl_seconds: response.data.ttl_seconds,
          old_secret_key: response.data.secret_key,
        });

        this.messageSecretKeyForm.reset();
        this.enableEdit = true;
      },
      error: (error) => {
        this.messageToast.add({
          severity: 'error',
          summary: 'Error',
          detail: error.error.message,
        });
        return;
      },
    });
  }

  getErrorMessage(controlName: string): void {
    const control = this.messageEditForm.get(controlName);

    if (control?.hasError('required')) {
      this.messageToast.add({
        severity: 'warn',
        summary: 'Warning',
        detail: `The field ${this.controlNames[controlName]} is required`,
      });
    }
  }
}
