<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class User2Service
{
    use ConsumesExternalService;

    public $baseUri;
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.users2.base_uri');
        $this->secret = config('services.users2.secret');
    }

    public function obtainUsers2()
    {
        return json_decode(
            $this->performRequest('GET', '/users'),
            true
        );
    }

    public function createUser2($data)
    {
        return json_decode(
            $this->performRequest('POST', '/users', $data),
            true
        );
    }

    public function obtainUser2($id)
    {
        return $this->performRequest('GET', "/users/{$id}");
    }

    public function editUser2($data, $id)
    {
        return json_decode(
            $this->performRequest('PUT', "/users/{$id}", $data),
            true
        );
    }

    public function deleteUser2($id)
    {
        return json_decode(
            $this->performRequest('DELETE', "/users/{$id}"),
            true
        );
    }
}