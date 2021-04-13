<?php

namespace App\Modules\User\Controllers;

use App\Http\Controllers\Admin\AdminController;
use App\Modules\RBAC\Models\Role;
use App\Modules\User\Requests\UserRequest;
use User;

class UserController extends AdminController
{
    public function index()
    {
        if (!auth()->user()->can('VIEW_ADMIN_USERS')) {
            return back()->with(['error' => 'У вас нет прав для списка пользователей']);
        }

        $users = User::all();

        $this->view('user::index');

        return $this->render(compact('users'));
    }

    public function create()
    {
        if (!auth()->user()->can('ADD_USERS')) {
            return back()->with(['error' => 'У вас нет прав для добавление пользователя']);
        }

        $title = 'Добавление пользователя';
        $roles = Role::all();

        $this->view('user::create');

        return $this->render(compact('title', 'roles'));
    }

    public function store(UserRequest $request)
    {
        $result = User::create($request);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.users.index')->with($result);

    }

    public function edit($id)
    {
        if (!auth()->user()->can('EDIT_USERS')) {
            return back()->with(['error' => 'У вас нет прав для редактирование пользователя']);
        }

        $title = 'Редактирование пользователя';
        $user = User::find($id);

        $roles = Role::all();

        $this->view('user::edit');

        return $this->render(compact('title', 'user', 'roles'));
    }

    public function update(UserRequest $request, $id)
    {
        $result = User::update($request, $id);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.users.index')->with($result);
    }

    public function destroy($id)
    {
        if (env('APP_ENV') != 'testing') {
            if (!auth()->user()->can('DELETE_USERS')) {
                return back()->with(['error' => 'У вас нет прав для удаление пользователя']);
            }
        }

        $result = User::destroy($id);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.users.index')->with($result);
    }
}
