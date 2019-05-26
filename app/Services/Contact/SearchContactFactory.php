<?php

namespace App\Services\Contact;

class SearchContactFactory
{
    const SEARCH_BY_NAME = 1;
    const SEARCH_BY_PHONE = 2;

    /**
     * @var SearchContactByPhoneStrategy
     */
    private $searchContactByPhoneStrategy;

    /**
     * @var SearchContactByNameStrategy
     */
    private $searchContactByNameStrategy;

    /**
     * SearchContactFactory constructor.
     * @param SearchContactByPhoneStrategy $searchContactByPhoneStrategy
     * @param SearchContactByNameStrategy $searchContactByNameStrategy
     */
    public function __construct(
        SearchContactByPhoneStrategy $searchContactByPhoneStrategy,
        SearchContactByNameStrategy $searchContactByNameStrategy
    )
    {
        $this->searchContactByPhoneStrategy = $searchContactByPhoneStrategy;
        $this->searchContactByNameStrategy = $searchContactByNameStrategy;
    }

    /**
     * @param array $data
     *
     * @return SearchContactByNameStrategy|SearchContactByPhoneStrategy
     *
     * @throws \Exception
     *
     * @todo We should have a Factory to create Object Search in the future
     */
    public function create(array $data)
    {
        switch ($data['type']) {
            case self::SEARCH_BY_NAME:
                return $this->searchContactByNameStrategy; break;

            case self::SEARCH_BY_PHONE:
                return $this->searchContactByPhoneStrategy; break;

            default:
                throw new \Exception('Could not resolve the Handler');
        }
    }
}
