<?php

namespace App\Services;

use App\Contact as AppContact;
use App\Repository\ContactRepository;

/**
 * Contact specific functionality
 */
class Contact
{
    /**
     * @var ContactRepository
     */
    private $repository;

    /**
     * @param ContactRepository $repository
     */
    public function __construct(ContactRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     *
     * @param array $data
     *
     * @return AppContact
     */
    public function create(array $data): AppContact
    {
        return $this->repository->create($data);
    }
}
