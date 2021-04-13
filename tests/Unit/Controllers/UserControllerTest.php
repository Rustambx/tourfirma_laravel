<?php

namespace Tests\Unit\Controllers;

use App\Modules\RBAC\Models\Role;
use App\Modules\User\Controllers\UserController;
use App\Modules\User\Models\User;
use App\Modules\User\Requests\UserRequest;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function testStore()
    {
        $controller = new UserController();
        $role = factory(Role::class)->create();
        $request = UserRequest::create('admin/users/store', 'POST', [
            'name' => Str::random('10'),
            'login' => Str::random('10'),
            'email' => 'testtt@mail.ru',
            'password' => bcrypt(Str::random('10')),
            'role_id' => $role->id,
        ]);

        $this->assertEquals(302, $controller->store($request)->status());
    }

    public function testUpdate()
    {
        $password = bcrypt(Str::random('10'));
        $controller = new UserController();
        $user = factory(User::class)->create();
        $role = factory(Role::class)->create();
        $request = UserRequest::create("admin/users/update/$user->id", 'POST', [
            'name' => Str::random('10'),
            'login' => Str::random('10'),
            'email' => 'testt@mail.ru',
            'password' => $password,
            'password_confirmation' => $password,
            'role_id' => $role->id,
        ]);

        $this->assertEquals(302, $controller->update($request, $user->id)->status());
    }

    public function testDestroy()
    {
        $controller = new UserController();
        $user = factory(User::class)->create();

        $this->assertEquals(302, $controller->destroy($user->id)->status());
    }
}

?>
