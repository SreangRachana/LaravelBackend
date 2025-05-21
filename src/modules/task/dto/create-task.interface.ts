export interface CreateTask {
  name: string;
  createdAt?: Date;
  description?: string;
  completedAt?: Date;
  userId: number;
}
