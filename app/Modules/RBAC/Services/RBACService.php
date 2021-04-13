<?php

namespace App\Modules\RBAC\Services;

use App\Modules\RBAC\Models\{
    Permission,
    Role
};

class RBACService
{
    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * RBACService constructor.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    public function __construct(\Illuminate\Foundation\Application $app)
    {
        $this->app = $app;
    }

    /**
     * Wrap for the Blade directive "@ability".
     *
     * @param      $roles
     * @param      $permissions
     * @param bool $requireAll
     * @return mixed
     */
    public function ability($roles, $permissions, $requireAll = false)
    {
        return auth()->user()->ability($roles, $permissions, $requireAll);
    }

    /**
     * Attaches permissions to the role.
     *
     * @param       $role
     * @param array $permissions
     */
    public function attachPermissions($role, array $permissions): void
    {
        $role = $this->findRole($role);

        if ($role) {
            $permissions = Permission::whereIn('name', $permissions)->get();

            $role->attachPermissions($permissions);
        }
    }

    /**
     * Wrap for the Blade directive "@permission".
     *
     * @param      $permission
     * @param bool $requireAll
     * @return mixed
     */
    public function can($permission, $requireAll = false)
    {
        return auth()->user()->can($permission, $requireAll);
    }

    /**
     * Detaches given permissions from the role.
     *
     * @param       $role
     * @param array $permissions
     */
    public function detachPermissions($role, array $permissions): void
    {
        $role = $this->findRole($role);

        if ($role) {
            $permissions = Permission::whereIn('name', $permissions)->get();

            $role->detachPermissions($permissions);
        }
    }

    /**
     * Finds a permission by the given id.
     * id can be a name string or an integer id, or an array of string|integer.
     *
     * @param $id
     * @return Permission|null
     */
    public function findPermission($id)
    {
        if (is_numeric($id)) {
            return Permission::find($id);
        }

        if (is_array($id)) {
            return Permission::where(function ($q) use ($id) {
                $q->whereIn('id', $id);
            })->orWhere(function ($q) use ($id) {
                $q->whereIn('name', $id);
            })->get();
        }

        return Permission::where('name', $id)->first();
    }

    /**
     * Finds a role by the given id.
     * id can be a name string or an integer id, or an array of string|integer.
     *
     * @param string|int|array $id
     * @return Role|null
     */
    public function findRole($id)
    {
        if (is_numeric($id)) {
            return Role::find($id);
        }

        if (is_array($id)) {
            return Role::where(function ($q) use ($id) {
                $q->whereIn('id', $id);
            })->orWhere(function ($q) use ($id) {
                $q->whereIn('name', $id);
            })->get();
        }

        return Role::where('name', $id)->first();
    }

    /**
     * Wrap for the Blade directive "@role".
     *
     * @param      $name
     * @param bool $requireAll
     * @return mixed
     */
    public function hasRole($name, $requireAll = false)
    {
        return auth()->user()->hasRole($name, $requireAll);
    }

    /**
     * Creates a new permission.
     *
     * @param string $slug
     * @return Permission
     */
    public function makePermission(string $slug): Permission
    {
        $permission = $this->findPermission($slug);

        if ($permission) {
            return $permission;
        }

        $permission = new Permission();
        $permission->name = $slug;

        $permission->save();

        return $permission;
    }

    /**
     * Creates a new role.
     *
     * @param string $slug
     * @return Role
     */
    public function makeRole(string $slug): Role
    {
        $role = $this->findRole($slug);

        if ($role) {
            return $role;
        }

        $role = new Role();
        $role->name = $slug;

        $role->save();

        return $role;
    }

    /**
     * Returns all permissions.
     *
     * @return Permission[]|\Illuminate\Database\Eloquent\Collection
     */
    public function permissions(): \Illuminate\Database\Eloquent\Collection
    {
        return Permission::all();
    }

    /**
     * Deletes the given role.
     *
     * @param $id string|integer|array
     */
    public function removeRole($id): void
    {
        $role = $this->findRole($id);

        if ($role) {
            $role->delete();
        }
    }

    /**
     * Returns all roles.
     *
     * @return Role[]|\Illuminate\Database\Eloquent\Collection
     */
    public function roles(): \Illuminate\Database\Eloquent\Collection
    {
        return Role::all();
    }
}