<?php

namespace App\Repository;

use App\Contact;

/**
 * Class ContactRepository
 */
class ContactRepository
{

    /**
     * Store contact message in db
     *
     * @param array $data
     * 
     * @return Contact
     */
    public function create(array $data): Contact
    {
        $model = new Contact();
        $model->fill($data);
        $model->save();

        return $model;
    }
}
