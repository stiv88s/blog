<?php

namespace App\ModelRepository;

use App\Model\Admin;

abstract class Repository
{
    abstract public function getEntity();

    public function findOneBy($filter)
    {
        $data = $this->getEntity()::where($filter);

        return $data->first();

    }

    public function orderBy($column, $order)
    {
        return call_user_func_array("{$this->getEntity()}::orderBy", [$column, $order]);


    }

    public function create($attributes)
    {
        $entity = call_user_func_array("{$this->getEntity()}::create", [$attributes]);

        return $entity;
    }

    public function find($id, $columns = array('*'))
    {
        return call_user_func_array("{$this->getEntity()}::find", array($id, $columns));
    }

    public function findOrFail($id)
    {
        $entity = $this->getEntity()::findOrFail($id);
        return $entity;
    }

    public function update($id, $attributes)
    {
        $entity = $this->findOrFail($id);
        $entity->fill($attributes);
        $entity->save();

        return $entity;

    }

    public function destroy($id)
    {
        $entity= $this->findOrFail($id);

        $entity->delete();

    }
}
