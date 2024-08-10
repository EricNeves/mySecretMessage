import { Component, Input } from '@angular/core';

import { DialogModule } from 'primeng/dialog';
import { InputTextModule } from 'primeng/inputtext';
import { ButtonModule } from 'primeng/button';

@Component({
  selector: 'app-modal-shared-link',
  standalone: true,
  imports: [DialogModule, InputTextModule, ButtonModule],
  templateUrl: './modal-shared-link.component.html',
  styleUrl: './modal-shared-link.component.css',
})
export class ModalSharedLinkComponent {
  @Input() display: boolean = false;
  @Input() link: string = '';

  openLink(link: string) {
    window.open(link, '_blank');
  }
}
