import { Component, Input } from '@angular/core';

import { PanelModule } from 'primeng/panel';

@Component({
  selector: 'app-card-shared-message',
  standalone: true,
  imports: [PanelModule],
  templateUrl: './card-shared-message.component.html',
  styleUrl: './card-shared-message.component.css',
})
export class CardSharedMessageComponent {
  @Input() message: string = '';
}
