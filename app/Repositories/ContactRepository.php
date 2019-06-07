<?php

namespace App\Repositories;

/**
 * Class ContactRepository
 *
 * @package App\Repositories
 *
 * @todo We can use Json, Mysql, Postgresql, Mariadb, NoSql here; This is the reason we should have the ContactRepositoryInterface
 */
class ContactRepository implements ContactRepositoryInterface
{
    public function searchByPhone(string $phone)
    {
        return json_encode(\App\Models\Contact::where('phone', 'like', "%$phone%")->get());
    }

    public function searchByName(string $name)
    {
        return json_encode(\App\Models\Contact::where('name', 'like', "%$name%")->get());
    }
}
