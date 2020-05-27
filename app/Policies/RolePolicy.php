<?php

namespace App\Policies;

use App\Model\Admin;
use App\Model\Role;
use App\Model\User;
use App\Traits\PoliciesCallMethod;
use Illuminate\Auth\Access\HandlesAuthorization;


class RolePolicy
{
    use HandlesAuthorization,PoliciesCallMethod;

    /**
     * Determine whether the user can view any roles.
     *
     * @param  \App\Model\Admin $admin
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        return $this->checkRoles($admin);
    }

    /**
     * Determine whether the user can view the role.
     *
     * @param  \App\Model\Admin  $admin
     * @param  \App\Model\Role  $role
     * @return mixed
     */
    public function view(Admin $admin, Role $role)
    {
        return false;
    }

    /**
     * Determine whether the user can create roles.
     *
     * @param  \App\Model\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return $this->checkRoles($admin);

    }

    /**
     * Determine whether the user can update the role.
     *
     * @param  \App\Model\Admin  $admin
     * @param  \App\Model\Role  $role
     * @return mixed
     */
    public function update(Admin $admin, Role $role)
    {
        return $this->checkRoles($admin);

    }

    /**
     * Determine whether the user can delete the role.
     *
     * @param  \App\Model\Admin  $admin
     * @param  \App\Model\Role  $role
     * @return mixed
     */
    public function delete(Admin $admin, Role $role)
    {
        return $this->checkRoles($admin);
    }

    /**
     * Determine whether the user can restore the role.
     *
     * @param  \App\Model\Admin  $admin
     * @param  \App\Model\Role  $role
     * @return mixed
     */
    public function restore(Admin $admin, Role $role)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the role.
     *
     * @param  \App\Model\Admin  $admin
     * @param  \App\Model\Role  $role
     * @return mixed
     */
    public function forceDelete(Admin $admin, Role $role)
    {
        return false;
    }
}
