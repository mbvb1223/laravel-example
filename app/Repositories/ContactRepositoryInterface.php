<?php

namespace App\Repositories;

interface ContactRepositoryInterface
{
    public function searchByPhone(string $phone);

    public function searchByName(string $name);
}
