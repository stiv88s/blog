<?php

namespace App\Policies;

use App\Model\Admin;
use App\Model\Settings;
use App\Traits\PoliciesCallMethod;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettingsPolicy
{
    use HandlesAuthorization,PoliciesCallMethod;

    /**
     * Determine whether the user can view any settings.
     *
     * @param  \App\Model\Admin  $admin
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        return $this->checkRoles($admin);
    }

    /**
     * Determine whether the user can view the settings.
     *
     * @param  \App\Model\Admin  $admin
     * @param  \App\Settings  $settings
     * @return mixed
     */
    public function view(Admin $admin, Settings $settings)
    {
        return false;
    }

    /**
     * Determine whether the user can create settings.
     *
     * @param  \App\Model\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
      return $this->checkRoles($admin);
    }

    /**
     * Determine whether the user can update the settings.
     *
     * @param  \App\Model\Admin  $admin
     * @param  \App\Settings  $settings
     * @return mixed
     */
    public function update(Admin $admin, Settings $settings)
    {
       return $this->checkRoles($admin);
    }

    /**
     * Determine whether the user can delete the settings.
     *
     * @param  \App\Model\Admin  $admin
     * @param  \App\Settings  $settings
     * @return mixed
     */
    public function delete(Admin $admin, Settings $settings)
    {
       return $this->checkRoles($admin);

    }

    /**
     * Determine whether the user can restore the setting.
     *
     * @param  \App\Model\Admin  $user
     * @param  \App\Model\Settings  $settings
     * @return mixed
     */
    public function restore(Admin $admin, Settings $setting)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the setting.
     *
     * @param  \App\Model\Admin  $admin
     * @param  \App\Model\Settings  $settings
     * @return mixed
     */
    public function forceDelete(Admin $admin,Settings $settings)
    {
        return false;
    }



}
