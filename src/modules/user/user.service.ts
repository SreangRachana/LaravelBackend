import { Injectable } from '@nestjs/common';
import { InjectRepository } from '@nestjs/typeorm';
import { User } from 'src/users/user.entity';
import { Repository } from 'typeorm';

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

  createUser(body: Partial<User>) {
    const user = this.usersRepo.create(body);
    return this.usersRepo.save(user);
  }

  updateUser(body: Partial<User>, username: string) {
    return this.usersRepo.update({ username }, body);
  }

  deleteUser(username: string) {
    return this.usersRepo.delete({ username });
  }
}
