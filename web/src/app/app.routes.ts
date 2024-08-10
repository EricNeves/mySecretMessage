import { Routes } from '@angular/router';

import { PageAuthenticationComponent } from './pages/page-authentication/page-authentication.component';
import { PageRegisterComponent } from './pages/page-register/page-register.component';
import { PagePanelComponent } from './pages/page-panel/page-panel.component';
import { authenticatedGuard } from './guards/authenticated.guard';

export const routes: Routes = [
  {
    path: '',
    component: PageAuthenticationComponent,
    title: 'My Secret Message - Login',
  },
  {
    path: 'register',
    component: PageRegisterComponent,
    title: 'My Secret Message - Register',
  },
  {
    path: 'panel',
    component: PagePanelComponent,
    canActivate: [authenticatedGuard],
    title: 'My Secret Message - Panel',
  },
];
