import { CanActivateFn, Router } from '@angular/router';

import { inject } from '@angular/core';

import { UserService } from '../services/user.service';

export const authenticatedGuard: CanActivateFn = (route, state) => {
  const router = inject(Router);
  const userService = inject(UserService);

  userService.getUser().subscribe({
    error: (error: any) => {
      if (error.status === 0 || error.status === 401) {
        router.navigate(['/']);
      }
    },
  });

  return true;
};
