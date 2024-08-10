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

  register(message: Message): Observable<{ data: Message }> {
    return this.http.post<{ data: Message }>(
      `${environment.apiBaseUrl}/api/messages/register`,
      message
    );
  }

  getMessage(): Observable<{ data: Message }> {
    return this.http.get<{ data: Message }>(
      `${environment.apiBaseUrl}/api/messages/fetch`
    );
  }

  getSecretMessage(message: Message): Observable<{ data: Message }> {
    return this.http.post<{ data: Message }>(
      `${environment.apiBaseUrl}/api/messages/secure/fetch`,
      message
    );
  }

  updateMessage(message: Message): Observable<{ data: Message }> {
    return this.http.put<{ data: Message }>(
      `${environment.apiBaseUrl}/api/messages/update`,
      message
    );
  }

  deleteMessage(): Observable<{ data: string }> {
    return this.http.delete<{ data: string }>(
      `${environment.apiBaseUrl}/api/messages/delete`
    );
  }

  getSharedMessage(message: Message): Observable<{ data: Message }> {
    return this.http.post<{ data: Message }>(
      `${environment.apiBaseUrl}/api/messages/shared/${message.user_id}/${message.message_id}`,
      message
    );
  }
}
