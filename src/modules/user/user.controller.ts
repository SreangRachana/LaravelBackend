import {
  Get,
  Param,
  Controller,
  Post,
  Body,
  Patch,
  Delete,
} from '@nestjs/common';
import { UserService } from './user.service';

@Controller('users')
export class UsersController {
  constructor(private readonly userService: UserService) {}

  @Get('/:username')
  getUser(@Param('username') username: string) {
    return this.userService.getUser(username);
  }

  @Post('/users')
  createUser(
    @Body() body: { username: string; email: string; password: string },
  ) {
    return this.userService.createUser(body);
  }

  @Patch('/users/:username')
  updateUser(
    @Body() body: { username: string; email: string; password: string },
  ) {
    return this.userService.updateUser(body);
  }

  @Delete('/users/:username')
  deleteUser(@Param('username') username: string) {
    return this.userService.deleteUser(username);
  }
}
