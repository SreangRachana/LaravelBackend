import {
  Body,
  Controller,
  Delete,
  Get,
  Param,
  Patch,
  Post,
  UsePipes,
  ValidationPipe,
} from '@nestjs/common';
import { TaskService } from './task.service';
import { CreateTaskDto } from './dto/create-task.dto';
import { UpdateTaskDto } from './dto/update-task.dto';

@Controller('tasks')
export class TasksController {
  constructor(private readonly taskService: TaskService) {}

  @Get('/')
  getAllTasks() {
    return this.taskService.getAllTasks();
  }

  @Get('/:id')
  getTask(@Param('id') id: number) {
    return this.taskService.getTask(id);
  }

  @Post('/')
  @UsePipes(new ValidationPipe({ whitelist: true }))
  createTask(@Body() createTaskDto: CreateTaskDto) {
    return this.taskService.createTask(createTaskDto);
  }

  @Patch('/:id/done')
  @UsePipes(new ValidationPipe({ whitelist: true }))
  markTaskAsDone(
    @Body() updateTaskDto: UpdateTaskDto,
    @Param('id') id: number,
  ) {
    return this.taskService.updateTask(id, updateTaskDto);
  }

  @Patch('/:id/pending')
  @UsePipes(new ValidationPipe({ whitelist: true }))
  markTaskAsPending(
    @Body() updateTaskDto: UpdateTaskDto,
    @Param('id') id: number,
  ) {
    return this.taskService.updateTask(id, updateTaskDto);
  }

  @Delete('/deleteAll')
  deleteAllTasks() {
    return this.taskService.deleteAllTasks();
  }

  @Delete('/:id')
  deleteTask(@Param('id') id: number) {
    return this.taskService.deleteTask(id);
  }
}
