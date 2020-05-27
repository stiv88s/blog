<?php

namespace App\Policies;

use App\Model\Admin;
use App\Model\User;
use App\Traits\PoliciesCallMethod;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization,PoliciesCallMethod;

    /**
     * Determine whether the user can view any admins.
     *
     * @param  \App\Model\Admin  $admin
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        return $this->checkRoles($admin);

    }

    /**
     * Determine whether the user can view the admin.
     *
     * @param  \App\Model\Admin  $adm
     * @param  \App\Model\Admin  $admin
     * @return mixed
     */
    public function view(Admin $adm, Admin $admin)
    {
        return false;
    }

    /**
     * Determine whether the user can create admins.
     *
     * @param  \App\Model\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return $this->checkRoles($admin);

    }

    /**
     * Determine whether the user can update the admin.
     *
     * @param  \App\Model\Admin $adm
     * @param  \App\Model\Admin  $admin
     * @return mixed
     */
    public function update(Admin $adm, Admin $admin)
    {
        return $this->checkRoles($adm);

    }

    /**
     * Determine whether the user can delete the admin.
     *
     * @param  \App\Model\Admin  $adm
     * @param  \App\Model\Admin  $admin
     * @return mixed
     */
    public function delete(Admin $adm, Admin $admin)
    {
        return $this->checkRoles($adm);

    }

    /**
     * Determine whether the user can restore the admin.
     *
     * @param  \App\Model\Admin  $adm
     * @param  \App\Model\Admin  $admin
     * @return mixed
     */
    public function restore(Admin $adm, Admin $admin)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the admin.
     *
     * @param  \App\Model\Admin  $adm
     * @param  \App\Model\Admin  $admin
     * @return mixed
     */
    public function forceDelete(Admin $adm, Admin $admin)
    {
        return false;
    }
}
