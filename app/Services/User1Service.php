<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class User1Service
{
    use ConsumesExternalService;

    public $baseUri;
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.users1.base_uri');
        $this->secret = config('services.users1.secret');
    }

    public function obtainUsers1()
    {
        return json_decode(
            $this->performRequest('GET', '/users'),
            true
        );
    }

    public function createUser1($data)
    {
        return json_decode(
            $this->performRequest('POST', '/users', $data),
            true
        );
    }

    public function obtainUser1($id)
    {
        return $this->performRequest('GET', "/users/{$id}");
    }

    public function editUser1($data, $id)
    {
        return json_decode(
            $this->performRequest('PUT', "/users/{$id}", $data),
            true
        );
    }

    public function deleteUser1($id)
    {
        return json_decode(
            $this->performRequest('DELETE', "/users/{$id}"),
            true
        );
    }
}