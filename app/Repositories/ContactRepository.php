<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

/**
 * Class ContactRepository
 *
 * @package App\Repositories
 *
 * @todo We can use Json, Mysql, postgresql, postgresql here; This is the reason we should have the ContactRepositoryInterface
 */
class ContactRepository implements ContactRepositoryInterface
{
    public function searchByPhone(string $phone)
    {
        return json_encode(DB::table('contacts')
            ->where('phone', 'like', "%$phone%")->get());
    }

    public function searchByName(string $name)
    {
        return json_encode(DB::table('contacts')
            ->where('name', 'like', "%$name%")->get());
    }
}
