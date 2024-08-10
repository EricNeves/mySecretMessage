import { Routes } from '@angular/router';

import { PageAuthenticationComponent } from './pages/page-authentication/page-authentication.component';
import { PageRegisterComponent } from './pages/page-register/page-register.component';
import { PagePanelComponent } from './pages/page-panel/page-panel.component';
import { authenticatedGuard } from './guards/authenticated.guard';
import { Page404Component } from './pages/page-404/page-404.component';
import { PageSharedMessageComponent } from './pages/page-shared-message/page-shared-message.component';

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
  {
    path: 'messages/shared/:id/:uuid',
    component: PageSharedMessageComponent,
    title: 'My Secret Message - Shared Message',
  },
  {
    path: '**',
    component: Page404Component,
    title: 'My Secret Message - 404',
  },
];
