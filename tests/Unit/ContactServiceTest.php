<?php

namespace Tests\Unit;

use App\Services\Contact\SearchContactByNameStrategy;
use App\Services\Contact\SearchContactByPhoneStrategy;
use App\Services\Contact\SearchContactFactory;
use App\Services\ContactService;
use Mockery;
use Tests\TestCase;

class ContactServiceTest extends TestCase
{
    /** @var Mockery\MockInterface */
    private $contactService;
    /** @var Mockery\MockInterface */
    private $searchContactFactory;
    /** @var Mockery\MockInterface */
    private $searchContactByNameStrategy;
    /** @var Mockery\MockInterface */
    private $searchContactByPhoneStrategy;

    /**
     * @inheritdoc
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->searchContactFactory = Mockery::mock(SearchContactFactory::class);
        $this->searchContactByNameStrategy = Mockery::mock(SearchContactByNameStrategy::class);
        $this->searchContactByPhoneStrategy = Mockery::mock(SearchContactByPhoneStrategy::class);
        $this->contactService = new ContactService($this->searchContactFactory);
    }

    /**
     * @inheritdoc
     */
    public function tearDown(): void
    {
        Mockery::close();
    }

    /**
     * Test for SearchContactByNameStrategy
     */
    public function testSearchContactWithSearchContactByNameStrategy()
    {
        $resultExpectation = json_encode([1,2]);

        $this->searchContactFactory
            ->shouldReceive('create')
            ->once()
            ->andReturn($this->searchContactByNameStrategy);

        $this->searchContactByNameStrategy
            ->shouldReceive('search')
            ->once()
            ->andReturn($resultExpectation);

        $result = $this->contactService->search(['type' => 1, 'searchTerm' => 'ATB']);

        $this->assertEquals($resultExpectation, $result);
    }

    /**
     * Test for SearchContactByNameStrategy
     */
    public function testSearchContactWithSearchContactByPhoneStrategy()
    {
        $resultExpectation = json_encode([1,3,4,5,6]);

        $this->searchContactFactory
            ->shouldReceive('create')
            ->once()
            ->andReturn($this->searchContactByPhoneStrategy);

        $this->searchContactByPhoneStrategy
            ->shouldReceive('search')
            ->once()
            ->andReturn($resultExpectation);

        $result = $this->contactService->search(['type' => 2, 'searchTerm' => '0979903200']);

        $this->assertEquals($resultExpectation, $result);
    }
}
