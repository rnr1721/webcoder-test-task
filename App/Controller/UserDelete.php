<?php

namespace App\Controller;

use Core\Contracts\Controller;
use Core\Contracts\ResponseInterface;
use App\Model\UserRepository;

class UserDelete implements Controller
{

    private ResponseInterface $response;
    private UserRepository $users;

    public function __construct(ResponseInterface $response, UserRepository $users)
    {
        $this->response = $response;
        $this->users = $users;
    }

    public function run(array $parameters = []): ResponseInterface
    {
        $this->users->delete($parameters['userId']);
        $this->response->redirect('/users');
    }
}
