<?php

namespace Tests\Unit\Services;

use App\Modules\RBAC\Models\Role;
use App\Modules\User\Models\User;
use App\Modules\User\Requests\UserRequest;
use App\Modules\User\Services\UserService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use DatabaseMigrations;

    public function testCreate()
    {
        $service = new UserService();
        $role = factory(Role::class)->create();
        $status = ['status' => 'Ползователь добавлен'];
        $request = UserRequest::create('admin/users/store', 'POST', [
            'name' => Str::random('10'),
            'login' => Str::random('10'),
            'email' => 'testtt@mail.ru',
            'password' => bcrypt(Str::random('10')),
            'role_id' => $role->id,
        ]);

        $this->assertEquals($status, $service->create($request));
    }

    public function testUpdate()
    {
        $service = new UserService();
        $password = bcrypt(Str::random('10'));
        $user = factory(User::class)->create();
        $role = factory(Role::class)->create();
        $status = ['status' => 'Пользователь изменен'];
        $request = UserRequest::create("admin/users/update/$user->id", 'POST', [
            'name' => Str::random('10'),
            'login' => Str::random('10'),
            'email' => 'testtt@mail.ru',
            'password' => $password,
            'password_confirmation' => $password,
            'role_id' => $role->id,
        ]);

        $this->assertEquals($status, $service->update($request, $user->id));
    }

    /*public function testDestroy()
    {
        $service = new UserService();
        $user = factory(User::class)->create();
        $status = ['status' => 'Пользователь удален'];

        $this->assertEquals($status, $service->destroy($user->id));
    }*/
}

?>
