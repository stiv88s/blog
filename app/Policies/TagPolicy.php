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
        return false;
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
//        $arr = explode('::',__METHOD__);
//        $callingMethod = $arr[1];
//        $classNameArray= explode('\\',self::class);
//        $class = end( $classNameArray);
//        $classNamePieces =  preg_split('/(?=[A-Z])/', $class );
//        $className = strtolower($classNamePieces[1]);
//
//        $callingFunction  = $className.'_'.  $callingMethod;
//        dd( $callingFunction);



//        if (Auth::user()->isSuperAdmin()) {
//            return true;
//        } else {
//            return $this->checkRoles($admin, $this->getCalling());
//
//        }
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
        return false;
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
        return true;
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

//    public function checkRoles(Admin $admin, $info)
//    {
//        foreach ($admin->roles as $roles) {
//            foreach ($roles->permissions as $permission) {
//                if ($permission->name == $info) {
//                    return true;
//                }
//            }
//        }
//
//        return false;
//
//    }


}
