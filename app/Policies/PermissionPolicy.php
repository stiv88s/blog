<?php

namespace App\Policies;

use App\Model\Admin;
use App\Model\Permission;
use App\Model\User;
use App\Traits\PoliciesCallMethod;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization,PoliciesCallMethod;

    /**
     * Determine whether the user can view any permissions.
     *
     * @param  \App\Model\Admin  $admin
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        return $this->checkRoles($admin);

    }

    /**
     * Determine whether the user can view the permission.
     *
     * @param  \App\Model\Admin  $admin
     * @param  \App\Model\Permission  $permission
     * @return mixed
     */
    public function view(Admin $admin, Permission $permission)
    {
        return false;
    }

    /**
     * Determine whether the user can create permissions.
     *
     * @param  \App\Model\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return $this->checkRoles($admin);

    }

    /**
     * Determine whether the user can update the permission.
     *
     * @param  \App\Model\Admin  $admin
     * @param  \App\Model\Permission  $permission
     * @return mixed
     */
    public function update(Admin $admin, Permission $permission)
    {
        return $this->checkRoles($admin);

    }

    /**
     * Determine whether the user can delete the permission.
     *
     * @param  \App\Model\Admin  $admin
     * @param  \App\Model\Permission  $permission
     * @return mixed
     */
    public function delete(Admin $admin, Permission $permission)
    {
        return $this->checkRoles($admin);
    }

    /**
     * Determine whether the user can restore the permission.
     *
     * @param  \App\Model\Admin  $admin
     * @param  \App\Model\Permission  $permission
     * @return mixed
     */
    public function restore(Admin $admin, Permission $permission)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the permission.
     *
     * @param  \App\Model\Admin $admin
     * @param  \App\Model\Permission  $permission
     * @return mixed
     */
    public function forceDelete(Admin $admin, Permission $permission)
    {
        return false;
    }


}
