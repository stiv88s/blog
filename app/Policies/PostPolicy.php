<?php

namespace App\Policies;

use App\Model\Admin;
use App\Model\Post;
use App\Traits\PoliciesCallMethod;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization,PoliciesCallMethod;

    /**
     * Determine whether the user can view any posts.
     *
     * @param  \App\Model\Admin  $admin
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        return $this->checkRoles($admin);
    }

    /**
     * Determine whether the user can view the post.
     *
     * @param  \App\Model\Admin  $admin
     * @param  \App\Model\Post  $post
     * @return mixed
     */
    public function view(Admin $admin, Post $post)
    {
        return false;
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\Model\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return $this->checkRoles($admin);
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\Model\Admin  $admin
     * @param  \App\Model\Post  $post
     * @return mixed
     */
    public function update(Admin $admin, Post $post)
    {
        return $this->checkRoles($admin);
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\Model\Admin  $admin
     * @param  \App\Model\Post  $post
     * @return mixed
     */
    public function delete(Admin $admin, Post $post)
    {
        return $this->checkRoles($admin);
    }

    /**
     * Determine whether the user can restore the post.
     *
     * @param  \App\Model\Admin  $user
     * @param  \App\Model\Post  $post
     * @return mixed
     */
    public function restore(Admin $admin, Post $post)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the post.
     *
     * @param  \App\Model\Admin  $admin
     * @param  \App\Model\Post  $post
     * @return mixed
     */
    public function forceDelete(Admin $admin, Post $post)
    {
        return false;
    }
}
