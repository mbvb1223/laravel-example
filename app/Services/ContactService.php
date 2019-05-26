<?php

namespace App\Services;

use App\Interfaces\SearchableInterface;
use App\Services\Contact\SearchContactFactory;

class ContactService
{
    /**
     * @var SearchContactFactory
     */
    private $searchContactFactory;

    /**
     * ContactService constructor.
     *
     * @param SearchContactFactory $searchContactFactory
     */
    public function __construct(
        SearchContactFactory $searchContactFactory
    ) {
        $this->searchContactFactory = $searchContactFactory;
    }

    /**
     * @param array $request
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function search(array $request)
    {
        /** @var SearchableInterface $searchHandler */
        $searchHandler = $this->searchContactFactory->create($request);

        return $searchHandler->search($request);
    }
}
