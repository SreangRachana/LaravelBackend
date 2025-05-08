import { Module } from '@nestjs/common';
import { TasksController } from './task.controller';
import { TaskService } from './task.service';

@Module({
  imports: [],
  controllers: [TasksController],
  providers: [TaskService],
  exports: [],
  // Add any other necessary configurations or modules
})
export class TaskModule {}
