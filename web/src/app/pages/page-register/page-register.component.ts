import { Component } from '@angular/core';

import { RouterModule } from '@angular/router';

import { FormRegisterComponent } from '@components/form-register/form-register.component';

@Component({
  selector: 'app-page-register',
  standalone: true,
  imports: [FormRegisterComponent, RouterModule],
  templateUrl: './page-register.component.html',
  styleUrl: './page-register.component.css',
})
export class PageRegisterComponent {}
