import {
  Component,
  EventEmitter,
  Input,
  OnChanges,
  OnInit,
  Output,
  SimpleChanges,
} from '@angular/core';

import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ReactiveFormsModule } from '@angular/forms';

import { DialogModule } from 'primeng/dialog';
import { InputTextModule } from 'primeng/inputtext';
import { MessagesModule } from 'primeng/messages';
import { PasswordModule } from 'primeng/password';
import { ButtonModule } from 'primeng/button';
import { ToastModule } from 'primeng/toast';

import { MessageService } from 'primeng/api';

import { User } from '@models/User.model';
import { UserService } from '@services/user.service';

@Component({
  selector: 'app-modal-edit-user',
  standalone: true,
  imports: [
    DialogModule,
    InputTextModule,
    MessagesModule,
    PasswordModule,
    ButtonModule,
    ToastModule,
    ReactiveFormsModule,
  ],
  providers: [MessageService],
  templateUrl: './modal-edit-user.component.html',
  styleUrl: './modal-edit-user.component.css',
})
export class ModalEditUserComponent implements OnInit, OnChanges {
  @Output() updatedUser = new EventEmitter<User>();
  @Input() display: boolean = false;
  @Input() userInfo: Partial<User> = { name: '' };

  submitted: boolean = false;

  editForm!: FormGroup;

  constructor(
    private messageService: MessageService,
    private fb: FormBuilder,
    private userService: UserService
  ) {}

  ngOnInit(): void {
    this.initForm();
  }

  ngOnChanges(changes: SimpleChanges): void {
    if (changes['userInfo']) {
      this.initForm();
    }
  }

  initForm(): void {
    this.editForm = this.fb.group({
      name: [this.userInfo.name, Validators.required],
      password: ['', Validators.required],
    });
  }

  onSubmit(): void {
    this.submitted = true;

    if (this.editForm.invalid) {
      Object.keys(this.editForm.controls).map((key) => {
        this.getErrorMessage(key);
      });

      this.submitted = false;
      return;
    }

    const user: User = this.editForm.value;

    this.userService.updateUser(user).subscribe({
      next: (response) => {
        this.messageService.add({
          severity: 'success',
          summary: 'Success',
          detail: 'User updated successfully',
        });

        this.updatedUser.emit(response.data);

        this.submitted = false;
        this.display = false;
      },
      error: (error) => {
        this.messageService.add({
          severity: 'error',
          summary: 'Error',
          detail: error.error.message,
        });

        this.submitted = false;
        return;
      },
    });
  }

  getErrorMessage(controlName: string): void {
    const control = this.editForm.get(controlName);

    if (control?.hasError('required')) {
      this.messageService.add({
        severity: 'warn',
        summary: 'Warning',
        detail: `The field ${controlName} is required`,
      });
    }
  }
}
