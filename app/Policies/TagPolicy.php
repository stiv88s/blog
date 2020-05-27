<?php

namespace App\Policies;

use App\Model\Tag;
use App\Model\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use App\Traits\PoliciesCallMethod;

class TagPolicy
{
    use HandlesAuthorization,PoliciesCallMethod;


    /**
     * Determine whether the user can view any tags.
     *
     * @param \App\Model\Admin $admin
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        return $this->checkRoles($admin);
    }

    /**
     * Determine whether the user can view the tag.
     *
     * @param \App\Model\Admin $admin
     * @param \App\Model\Tag $tag
     * @return mixed
     */
    public function view(Admin $admin, Tag $tag)
    {
        return false;
    }

    /**
     * Determine whether the user can create tags.
     *
     * @param \App\Model\Admin $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
       return $this->checkRoles($admin);
    }

    /**
     * Determine whether the user can update the tag.
     *
     * @param \App\Model\Admin $admin
     * @param \App\Model\Tag $tag
     * @return mixed
     */
    public function update(Admin $admin, Tag $tag)
    {;
        return $this->checkRoles($admin);
    }

    /**
     * Determine whether the user can delete the tag.
     *
     * @param \App\Model\Admin $admin
     * @param \App\Model\Tag $tag
     * @return mixed
     */
    public function delete(Admin $admin, Tag $tag)
    {
        return $this->checkRoles($admin);
    }

    /**
     * Determine whether the user can restore the tag.
     *
     * @param \App\Model\Admin $user
     * @param \App\Model\Tag $tag
     * @return mixed
     */
    public function restore(Admin $admin, Tag $tag)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the tag.
     *
     * @param \App\Model\Admin $admin
     * @param \App\Model\Tag $tag
     * @return mixed
     */
    public function forceDelete(Admin $admin, Tag $tag)
    {
        return false;
    }

}
