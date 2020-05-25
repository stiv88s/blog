<?php

namespace App\Policies;

use App\Model\Tag;
use App\Model\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view any tags.
     *
     * @param  \App\Model\User  $user
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can view the tag.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Tag  $tag
     * @return mixed
     */
    public function view(Admin $admin, Tag $tag)
    {
        //
    }

    /**
     * Determine whether the user can create tags.
     *
     * @param  \App\Model\User  $user
     * @return mixed
     */
    public function create(Admin $admin)
    {

        return false;
        dd('stop');
        dd($admin);

    }

    /**
     * Determine whether the user can update the tag.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Tag  $tag
     * @return mixed
     */
    public function update(User $user, Tag $tag)
    {
        //
    }

    /**
     * Determine whether the user can delete the tag.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Tag  $tag
     * @return mixed
     */
    public function delete(User $user, Tag $tag)
    {
        //
    }

    /**
     * Determine whether the user can restore the tag.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Tag  $tag
     * @return mixed
     */
    public function restore(User $user, Tag $tag)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the tag.
     *
     * @param  \App\Model\User  $user
     * @param  \App\Model\Tag  $tag
     * @return mixed
     */
    public function forceDelete(User $user, Tag $tag)
    {
        //
    }
}
