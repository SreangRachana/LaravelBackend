import { Injectable } from '@nestjs/common';

@Injectable()
export class UserService {
  createUser(body: any) {
    console.log(body);
    return {
      username: 'Dara',
      email: 'dara@gmail.com',
      password: '123',
    };
  }
  getUser(username: string) {
    console.log(username);
    return {
      username: 'Dara',
      email: 'dara@gmail.com',
      password: '123',
    };
  }
  updateUser(body: any) {
    console.log(body);
    return {
      username: 'Dara',
      email: 'dara@gmail.com',
      password: '123',
    };
  }
  deleteUser(username: string) {
    console.log(username);
    return { message: 'success' };
  }
}
