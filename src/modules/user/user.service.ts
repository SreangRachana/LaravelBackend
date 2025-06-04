import { Injectable, NotFoundException } from '@nestjs/common';
import { InjectRepository } from '@nestjs/typeorm';
import { User } from 'src/users/user.entity';
import { Repository } from 'typeorm';
import { CreateUserDto } from './dto/create-user.dto';

@Injectable()
export class UsersService {
  constructor(
    @InjectRepository(User)
    private usersRepo: Repository<User>,
  ) {}

  getAllUsers() {
    return this.usersRepo.find();
  }
  getUser(username: string) {
    return this.usersRepo.findOne({ where: { username } });
  }

  async getUserById(id: number) {
    const user = await this.usersRepo.findOne({ where: { id } });

    if (!user) {
      throw new NotFoundException(`User with id ${id} not found`);
    }

    return user;
  }

  createUser(createUserDto: CreateUserDto) {
    const user = this.usersRepo.create(createUserDto);
    return this.usersRepo.save(user);
  }

  updateUser(body: Partial<User>, username: string) {
    return this.usersRepo.update({ username }, body);
  }

  deleteUser(username: string) {
    return this.usersRepo.delete({ username });
  }
}
