<?php

namespace App\Services;

use App\Interfaces\SearchableInterface;
use App\Repositories\ContactRepositoryInterface;
use App\Services\Contact\SearchContactFactory;

class ContactService
{
    /**
     * @var ContactRepositoryInterface
     */
    private $contactRepository;

    /**
     * @var SearchContactFactory
     */
    private $searchContactFactory;

    /**
     * ContactService constructor.
     *
     * @param ContactRepositoryInterface $contactRepository
     * @param SearchContactFactory $searchContactFactory
     */
    public function __construct(
        ContactRepositoryInterface $contactRepository,
        SearchContactFactory $searchContactFactory
    ) {
        $this->contactRepository = $contactRepository;
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
