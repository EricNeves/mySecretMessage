export interface Message {
  message_id: string;
  message: string;
  user_id: string;
  ttl_seconds: number | string;
  secret_key: string;
  old_secret_key: string;
  new_secret_key: string;
}
