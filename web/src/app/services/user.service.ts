import { Injectable } from '@angular/core';

import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

import { User } from '../models/User.model';
import { environment } from '../../environments/environment.development';

@Injectable({
  providedIn: 'root',
})
export class UserService {
  constructor(private http: HttpClient) {}

  register(user: User): Observable<{ data: User }> {
    return this.http.post<{ data: User }>(
      `${environment.apiBaseUrl}/api/users/register`,
      user
    );
  }

  auth(user: User): Observable<{ data: string }> {
    return this.http.post<{ data: string }>(
      `${environment.apiBaseUrl}/api/users/authenticate`,
      user
    );
  }

  getUser(): Observable<{ data: User }> {
    return this.http.get<{ data: User }>(
      `${environment.apiBaseUrl}/api/users/fetch`
    );
  }
}
