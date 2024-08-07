import { Component, OnInit } from '@angular/core';

import { NavbarComponent } from '../../components/navbar/navbar.component';

@Component({
  selector: 'app-page-panel',
  standalone: true,
  imports: [NavbarComponent],
  templateUrl: './page-panel.component.html',
  styleUrl: './page-panel.component.css',
})
export class PagePanelComponent {}
