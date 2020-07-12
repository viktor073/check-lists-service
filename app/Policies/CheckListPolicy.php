<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CheckListPolicy
{
    use HandlesAuthorization;

     public function before($user)
    {
        if ($user->hasRole('super-admin')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
         return $user->hasPermissionTo('checkList-viewAny');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Role  $role
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->hasPermissionTo('checkList-view');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('checkList-create')
            and $user->max_count_check_lists > $user->checkLists->count();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Role  $role
     * @return mixed
     */
    public function update(User $user, $checkList)
    {
        return $user->hasPermissionTo('checkList-update')
            && $user->id === $checkList->user_id
            || $user->hasRole('admin-check-list');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\checkList  $role
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->hasPermissionTo('checkList-delete')
            && $user->id === $checkList->user_id
            || $user->hasRole('admin-check-list');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Role  $role
     * @return mixed
     */
    public function restore(User $user)
    {
        return $user->hasPermissionTo('checkList-restore')
            && $user->id === $checkList->user_id
            || $user->hasRole('admin-check-list');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Role  $role
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return $user->hasPermissionTo('checkList-delete')
            && $user->id === $checkList->user_id
            || $user->hasRole('admin-check-list');
    }
}
