export interface Message {
  message_id: string;
  message: string;
  user_id: string;
  ttl_seconds: number | string;
}
