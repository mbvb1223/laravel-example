<?php
namespace App\Services\Contact;

use App\Interfaces\SearchableInterface;
use App\Repositories\ContactRepository;

class SearchContactByPhoneStrategy implements SearchableInterface
{
    /**
     * @var ContactRepository
     */
    private $contactRepository;

    /**
     * SearchContactByPhoneStrategy constructor.
     *
     * @param ContactRepository $contactRepository
     */
    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * @param array $data
     *
     * @return false|string
     */
    public function search(array $data)
    {
        /**
         * @todo We should have a Factory to create Object Search in the future
         */
        return $this->contactRepository->searchByPhone($data['searchTerm']);
    }
}
