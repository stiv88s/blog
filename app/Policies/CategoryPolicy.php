<?php

namespace App\Policies;

use App\Model\Admin;
use App\Model\Category;
use App\Model\User;
use App\Traits\PoliciesCallMethod;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization,PoliciesCallMethod;

    /**
     * Determine whether the user can view any categories.
     *
     * @param  \App\Model\Admin  $Admin
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        return $this->checkRoles($admin);
    }

    /**
     * Determine whether the user can view the category.
     *
     * @param  \App\Model\Admin  $admin
     * @param  \App\Model\Category  $category
     * @return mixed
     */
    public function view(Admin $admin, Category $category)
    {
        return false;
    }

    /**
     * Determine whether the user can create categories.
     *
     * @param  \App\Model\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return $this->checkRoles($admin);

    }

    /**
     * Determine whether the user can update the category.
     *
     * @param  \App\Model\Admin  $admin
     * @param  \App\Model\Category  $category
     * @return mixed
     */
    public function update(Admin $admin, Category $category)
    {
        return $this->checkRoles($admin);

    }

    /**
     * Determine whether the user can delete the category.
     *
     * @param  \App\Model\Admin  $admin
     * @param  \App\Model\Category  $category
     * @return mixed
     */
    public function delete(Admin $admin, Category $category)
    {
        return $this->checkRoles($admin);

    }

    /**
     * Determine whether the user can restore the category.
     *
     * @param  \App\Model\Admin  $admin
     * @param  \App\Model\Category  $category
     * @return mixed
     */
    public function restore(Admin $admin, Category $category)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the category.
     *
     * @param  \App\Model\Admin  $admin
     * @param  \App\Model\Category  $category
     * @return mixed
     */
    public function forceDelete(Admin $admin, Category $category)
    {
        return $this->checkRoles($admin);

    }
}
