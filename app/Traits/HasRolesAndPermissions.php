<?php

namespace App\Traits;

use App\Role;
use App\Permission;

trait HasRolesAndPermissions
{

    /**
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class,'users_roles');
    }
    /**
     * @return mixed
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'users_permissions');
    }

    public function hasRole($role)
    {
        if ($this->roles->contains('slug', $role)) {
            return true;
        }

        return false;
    }

    public function refreshRoles(... $roles )
    {
        $this->roles()->detach();
        return $this->givePermissionsTo($roles);
    }

    /**
     * @param $permission
     * @return bool
     */
    protected function hasPermission($permission)
    {
        if ($this->permissions->contains('slug', $permission->slug)) {
            return true;
        }
        return false;
    }

    /**
     * @param $permission
     * @return bool
     */
    public function hasPermissionTo($permission)
    {
        $permission = Permission::where('slug', $permission)->first();

        return $this->hasPermission($permission);

    }

    /**
     * @param $permission
     * @return bool
     */
    protected function hasPermissionThroughRole($permission)
    {
        foreach ($permission->roles as $role){
            if($this->roles->contains($role)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param mixed ...$permissions
     * @return $this
     */
    public function deletePermissions(... $permissions )
    {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }
    /**
     * @param mixed ...$permissions
     * @return HasRolesAndPermissions
     */
    public function refreshPermissions(... $permissions )
    {
        $this->permissions()->detach();
        return $this->givePermissionsTo($permissions);
    }

    public function block($id)
    {
        $user = User::find($id);
        if ($user->active == 1) {
            $user->active = 0;
            $status = 'Profile blocked!';
        }else{
            $user->active = 1;
            $status = 'Profile active!';
        }

        $user->save();

        return redirect()->route('users.edit', [$id])->with('status', $status);
    }
}