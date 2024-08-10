import { Component, Input } from '@angular/core';

import { DialogModule } from 'primeng/dialog';

@Component({
  selector: 'app-modal-register-message',
  standalone: true,
  imports: [DialogModule],
  templateUrl: './modal-register-message.component.html',
  styleUrl: './modal-register-message.component.css',
})
export class ModalRegisterMessageComponent {
  @Input() display: boolean = false;
}
