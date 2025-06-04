import {
  Get,
  Param,
  Controller,
  Post,
  Body,
  Patch,
  Delete,
  UsePipes,
  ValidationPipe,
} from '@nestjs/common';
import { UsersService } from './user.service';
import { CreateUserDto } from './dto/create-user.dto';

@Controller('users')
export class UsersController {
  constructor(private readonly userService: UsersService) {}

  @Get()
  getAllUsers() {
    return this.userService.getAllUsers();
  }

  @Get('/users/:id')
  findOne(@Param('id') id: number) {
    return this.userService.getUserById(id);
  }

  @Get('/:username')
  getUser(@Param('username') username: string) {
    return this.userService.getUser(username);
  }

  @Post('/users')
  @UsePipes(new ValidationPipe({ whitelist: true }))
  createUser(@Body() createUserDto: CreateUserDto) {
    return this.userService.createUser(createUserDto);
  }

  @Patch('/users/:username')
  updateUser(
    @Param('username') username: string,
    @Body() body: { username: string; email: string; password: string },
  ) {
    return this.userService.updateUser(body, username);
  }

  @Delete('/users/:username')
  deleteUser(@Param('username') username: string) {
    return this.userService.deleteUser(username);
  }
}
