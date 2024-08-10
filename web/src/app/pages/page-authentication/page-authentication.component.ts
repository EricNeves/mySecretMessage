import { Component } from '@angular/core';

import { RouterModule } from '@angular/router';

import { FormAuthenticationComponent } from '@components/form-authentication/form-authentication.component';

@Component({
  selector: 'app-page-authentication',
  standalone: true,
  imports: [FormAuthenticationComponent, RouterModule],
  templateUrl: './page-authentication.component.html',
  styleUrl: './page-authentication.component.css',
})
export class PageAuthenticationComponent {}
