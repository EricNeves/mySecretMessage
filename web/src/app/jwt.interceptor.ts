import { HttpInterceptorFn } from '@angular/common/http';
import { inject } from '@angular/core';
import { StorageService } from './services/storage.service';

export const jwtInterceptor: HttpInterceptorFn = (req, next) => {
  const localstorage = inject(StorageService);

  const token = localstorage.getItem('jwt');

  const reqAuth = req.clone({
    setHeaders: {
      Authorization: `Bearer ${token}`,
    },
  });

  return next(reqAuth);
};
