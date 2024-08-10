import { Component, Input } from '@angular/core';

import { DialogModule } from 'primeng/dialog';
import { AvatarModule } from 'primeng/avatar';
import { ChipModule } from 'primeng/chip';

@Component({
  selector: 'app-modal-info-dev',
  standalone: true,
  imports: [DialogModule, AvatarModule, ChipModule],
  templateUrl: './modal-info-dev.component.html',
  styleUrl: './modal-info-dev.component.css',
})
export class ModalInfoDevComponent {
  @Input() display: boolean = false;
}
