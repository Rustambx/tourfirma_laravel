<?php

namespace App\Modules\User\Services;

use App\Lib\File\CImage;
use App\Modules\RBAC\Models\Role;
use App\Modules\User\Models\User;
use App\Modules\User\Requests\UserRequest;
use Illuminate\Http\Request;

class UserService
{

    public function all()
    {
        $users = User::all();

        return $users;
    }

    public function delete($id)
    {
        $user = User::find($id);
        if ($user->delete()) {
            return redirect()->route('user');
        }
    }

    public function find($id)
    {
        $user = User::find($id);

        return $user;
    }

    public function create($request)
    {
        $data = $request->all();

        $user = User::create([
            'name' => $data['name'],
            'login' => $data['login'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        if ($user) {
            $user->roles()->attach($data['role_id']);
        }

        return ['status' => 'Ползователь добавлен'];
    }

    public function update($request, $id)
    {
        $user = User::find($id);

        $data = $request->except('_token', '_method', 'role_id');
        if (!empty($data['password'])) {
            if ($data['password'] == $data['password_confirmation']) {
                $data['password'] = bcrypt($data['password']);
            } else {
                return ["error" => "Вы неправильно повторили пароль"];
            }
        } else {
            unset($data['password']);
        }
        $user->fill($data);
        if ($user->update()){
            $user->roles()->sync($request->get('role_id'));
        }


        return ['status' => 'Пользователь изменен'];
    }

    public function destroy($id)
    {
        $user = User::find($id);

        $user->roles()->detach();

        if ($user->delete()) {
            return ['status' => 'Пользователь удален'];
        }
    }

    /*public function save(UserRequest $request)
    {
        if ($request->has('edit')) {
            $user = User::find($request->id);
            $photo = $request->file('photo');
            $save_image = $this->uploadImage($photo);

            $realPath = storage_path().'/app/public/upload/images/'. $user->photo;
            $oldImageFile = $user->photo;
            if (!empty($oldImageFile) && file_exists(storage_path().'/app/public/upload/images/'.$oldImageFile)) {
                if (preg_match('/(.*?)(\w+)\.(\w+)$/', $oldImageFile, $matches)) {
                    $files = glob(storage_path().'/app/public/upload/images/' . $matches[1] . $matches[2] . '_resize_*');
                    if (is_array($files)) {
                        foreach ($files as $file) {
                            unlink($file);
                        }
                    }
                }
                unlink($realPath);

                if (preg_match('/^(\w+)\//', $user->photo, $matches)) {
                    $dir = storage_path().'/app/public/upload/images/' . $matches[1];
                    if (!empty($dir)) {
                        rmdir($dir);
                    }
                }
            }

            $user->update([
                'description' => $request->input('description'),
                'user_id' => $request->input('user_id'),
                'book_id' => $request->input('book_id'),
                'photo' => $save_image
            ]);

        } else {
            $image = $request->file('photo');
            $save_image = $this->uploadImage($image);
            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'photo' => $save_image,
            ]);


        }

        return redirect()->route('user');
    }*/

    /*                  Permissions                  */

    public function savePermissions(Request $request)
    {
        $data = $request->except('_token');
        $roles = Role::all();

        foreach ($roles as $role) {
            if (isset($data[$role->id])) {
                $role->savePermissions($data[$role->id]);
            } else {
                $role->savePermissions([]);
            }
        }
        return redirect()->route('admin.permissions.index');
    }
}
