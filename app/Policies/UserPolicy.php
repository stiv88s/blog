<?php

namespace App\Policies;

use App\Model\Admin;
use App\Model\User;
use App\Traits\PoliciesCallMethod;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization, PoliciesCallMethod;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Model\Admin $admin
     * @return mixed
     */

    public function viewAny(Admin $admin)
    {
        return $this->checkRoles($admin);

    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Model\Admin $admin
     * @param \App\Model\User $model
     * @return mixed
     */
    public function view(Admin $admin, User $model)
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Model\Admin $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return $this->checkRoles($admin);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Model\Admin $admin
     * @param \App\Model\User $model
     * @return mixed
     */
    public function update(Admin $admin, User $model)
    {
        return $this->checkRoles($admin);

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Model\Admin $admin
     * @param \App\Model\User $model
     * @return mixed
     */
    public function delete(Admin $admin, User $model)
    {
        return $this->checkRoles($admin);

    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Model\Admin $admin
     * @param \App\Model\User $model
     * @return mixed
     */
    public function restore(Admin $admin, User $model)
    {
       return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Model\Admin $admin
     * @param \App\Model\User $model
     * @return mixed
     */
    public function forceDelete(Admin $admin, User $model)
    {
        return false;
    }
}
