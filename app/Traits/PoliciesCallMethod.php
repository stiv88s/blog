<?php

namespace App\Traits;

use App\Model\Admin;
use Illuminate\Support\Facades\Auth;

trait PoliciesCallMethod
{
    protected function checkRoles(Admin $admin)
    {
        if (Auth::user()->isSuperAdmin()) {
            return true;
        } else {
            foreach ($admin->roles as $roles) {
                foreach ($roles->permissions as $permission) {
                    if ($permission->name == $this->getCalling()) {
                        return true;
                    }
                }
            }

            return false;
        }

    }

    private function getCalling()
    {
        $ex = new \Exception();
        $trace = $ex->getTrace();
        $callingMethod = $trace[2]['function'];
        $classNameArray = explode('\\', self::class);
        $class = end($classNameArray);
        $classNamePieces = preg_split('/(?=[A-Z])/', $class);
        $className = strtolower($classNamePieces[1]);
        $callingFunction = $className . '_' . $callingMethod;

        return $callingFunction;
    }

}
