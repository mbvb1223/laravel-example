<?php

namespace App\Http\Controllers;

use App\Services\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * @var ContactService
     */
    private $contactService;

    /**
     * ContactController constructor.
     *
     * @param ContactService $contactService
     */
    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    /**
     * @param Request $request
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function search(Request $request) {
        return $this->contactService->search($request->all());
    }
}
