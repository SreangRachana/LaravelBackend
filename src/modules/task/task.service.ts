import { Injectable, NotFoundException } from '@nestjs/common';
import { InjectRepository } from '@nestjs/typeorm';
import { Task } from 'src/tasks/task.entity';
import { Repository } from 'typeorm';
import { User } from 'src/users/user.entity';
import { CreateTaskDto } from './dto/create-task.dto';
import { UpdateTaskDto } from './dto/update-task.dto';

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

  async getTask(id: number) {
    const task = await this.tasksRepo.findOne({
      where: { id },
      relations: ['user'],
    });

    if (!task) {
      throw new NotFoundException(`Task with id ${id} not found`);
    }
    return task;
  }

  async createTask(createTaskDto: CreateTaskDto) {
    const user = await this.usersRepo.findOneBy({ id: createTaskDto.userId });
    if (!user) {
      throw new NotFoundException('User not found');
    }
    const task = this.tasksRepo.create({
      name: createTaskDto.name,
      description: createTaskDto.description,
      createdAt: createTaskDto.createdAt,
      completedAt: createTaskDto.completedAt,
      user: user,
    });
    return this.tasksRepo.save(task);
  }
  async updateTask(id: number, updatetaskDto: UpdateTaskDto) {
    const user = await this.usersRepo.findOneBy({ id: updatetaskDto.userId });
    if (!user) {
      throw new NotFoundException('User not found');
    }
    const task = await this.tasksRepo.findOneBy({ id });
    if (!task) {
      throw new NotFoundException('Task not found');
    }
    task.name = updatetaskDto.name!;
    if (updatetaskDto.description !== undefined)
      task.description = updatetaskDto.description;
    if (updatetaskDto.createdAt !== undefined)
      task.createdAt = updatetaskDto.createdAt;
    if (updatetaskDto.completedAt !== undefined)
      task.completedAt = updatetaskDto.completedAt;
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
