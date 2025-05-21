import { Injectable, NotFoundException } from '@nestjs/common';
import { InjectRepository } from '@nestjs/typeorm';
import { Task } from 'src/tasks/task.entity';
import { Repository } from 'typeorm';
import { CreateTask } from './dto/create-task.interface';
import { User } from 'src/users/user.entity';

@Injectable()
export class TaskService {
  constructor(
    @InjectRepository(Task)
    private tasksRepo: Repository<Task>,
    @InjectRepository(User)
    private usersRepo: Repository<User>,
  ) {}

  getAllTasks() {
    return this.tasksRepo.find({
      relations: ['user'],
    });
  }

  getTask(id: number) {
    return this.tasksRepo.findOne({ where: { id }, relations: ['user'] });
  }

  async createTask(body: CreateTask) {
    const user = await this.usersRepo.findOneBy({ id: body.userId });
    if (!user) {
      throw new NotFoundException('User not found');
    }
    const task = this.tasksRepo.create({
      name: body.name,
      description: body.description,
      createdAt: body.createdAt,
      completedAt: body.completedAt,
      user: user,
    });
    return this.tasksRepo.save(task);
  }
  async updateTask(id: number, body: CreateTask) {
    const user = await this.usersRepo.findOneBy({ id: body.userId });
    if (!user) {
      throw new NotFoundException('User not found');
    }
    const task = await this.tasksRepo.findOneBy({ id });
    if (!task) {
      throw new NotFoundException('Task not found');
    }
    task.name = body.name;
    if (body.description !== undefined) task.description = body.description;
    if (body.createdAt !== undefined) task.createdAt = body.createdAt;
    if (body.completedAt !== undefined) task.completedAt = body.completedAt;
    task.user = user;
    return this.tasksRepo.save(task);
  }
  deleteTask(id: number) {
    return this.tasksRepo.delete({ id });
  }

  deleteAllTasks() {
    return this.tasksRepo.clear();
  }
}
