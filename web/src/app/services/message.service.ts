import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Message } from '../models/Message.model';
import { Observable } from 'rxjs';
import { environment } from '../../environments/environment.development';

@Injectable({
  providedIn: 'root',
})
export class MessageService {
  constructor(private http: HttpClient) {}

  getMessages(): Observable<{ data: Message }> {
    return this.http.get<{ data: Message }>(
      `${environment.apiBaseUrl}/api/messages/fetch`
    );
  }
}
