<?php

namespace App\Policies;

use App\Model\Admin;
use App\Model\BlockedUsers;
use App\Model\User;
use App\Traits\PoliciesCallMethod;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlockedUsersPolicy
{
    use HandlesAuthorization, PoliciesCallMethod;

    /**
     * Determine whether the user can view any blocked users.
     *
     * @param \App\Model\Admin $admin
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {

        return $this->checkRoles($admin);
    }


    /**
     * Determine whether the admin can block the users.
     *
     * @param \App\Model\Admin $admin
     * @param \App\Model\User $user
     * @return mixed
     */
    public function block(Admin $admin, User $user)
    {
        return $this->checkRoles($admin);

    }

    /**
     * Determine whether the admin can unblock the users.
     *
     * @param \App\Model\Admin $admin
     * @param \App\Model\User $user
     * @return mixed
     */
    public function unblock(Admin $admin, User $user)
    {
        return $this->checkRoles($admin);

    }
}
