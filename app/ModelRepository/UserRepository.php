<?php


namespace App\ModelRepository;


use App\Model\User;

/**
 * Class UserRepository
 *
 * @author Volodymyr Dyakun <dyakunvova@gmail.com>
 */
class UserRepository extends Repository
{
    public function getEntity()
    {
        return User::class;
    }

}
