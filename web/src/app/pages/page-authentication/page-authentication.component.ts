import { Component } from '@angular/core';

import { ButtonModule } from 'primeng/button';
import { PasswordModule } from 'primeng/password';

@Component({
  selector: 'app-page-authentication',
  standalone: true,
  imports: [ButtonModule, PasswordModule],
  templateUrl: './page-authentication.component.html',
  styleUrl: './page-authentication.component.css',
})
export class PageAuthenticationComponent {}
