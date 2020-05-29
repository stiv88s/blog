<?php

namespace App\Service\Permissions;

use App\Model\Contracts\GenerableInterface;

class Permission
{
    public function generate()
    {
        $permissionsArray = $this->getExistingPermissions();
        $modelUpdatedPermission = $this->getModelsPermissionMethods($this->getModels());
        $newPermissions = [];
        if ($modelUpdatedPermission != null) {

            foreach ($modelUpdatedPermission as $searchPermission) {
                if (!in_array($searchPermission, $permissionsArray)) {
                    $permissionCreated = \App\Model\Permission::create([
                        'name' => $searchPermission
                    ]);
                    $newPermissions [] = $permissionCreated;

                }
            }

        }

        return collect($newPermissions);
    }

    protected function getModels()
    {
        $path = app_path() . "/Model";
        $models = [];
        $results = scandir($path);
        foreach ($results as $result) {
            if ($result === '.' or $result === '..') continue;
            $modelArray = explode('.', $result);
            $model = "\\App\\Model\\" . $modelArray[0];

            if (!class_exists($model)) {
                continue;
            }

            $class = new \ReflectionClass(new $model());
            $interface = GenerableInterface::class;
            if ($class->implementsInterface($interface)) {
                $models[$modelArray[0]] = $model::isGenerable();
            }

        }

        return $models;
    }

    protected function getModelsPermissionMethods(array $models)
    {
        $methods = [];

        if (empty($models)) {
            return;
        }

        foreach ($models as $key => $value) {

            if ($value === true) {
                if (strtolower($key) == 'blockedusers') {
                    $methods[] = strtolower($key).'_unblock';
                    $methods[] = strtolower($key).'_block';
                    $methods[] = strtolower($key).'_viewAny';
                } else {
                    $methods[] = strtolower($key) . '_create';
                    $methods[] = strtolower($key) . '_update';
                    $methods[] = strtolower($key) . '_delete';
                    $methods[] = strtolower($key) . '_viewAny';
                }
            }
        }

        return $methods;

    }

    protected function getExistingPermissions()
    {
        $permissions = \App\Model\Permission::all()->pluck('name')->toArray();

        return $permissions;
    }

}
