<?php

namespace App\Controller;

use Core\Contracts\Controller;
use Core\Contracts\RequestInterface;
use Core\Contracts\ResponseInterface;
use App\Contracts\UserRepositoryInterface;

class UserUpdate implements Controller
{

    private RequestInterface $request;
    private ResponseInterface $response;
    private UserRepositoryInterface $users;

    public function __construct(RequestInterface $request, ResponseInterface $response, UserRepositoryInterface $users)
    {
        $this->request = $request;
        $this->response = $response;
        $this->users = $users;
    }

    public function run(array $parameters = []): ResponseInterface
    {
        $data = $this->request->getPostData();

        $result = $this->users->update($data);

        if ($result) {
            $this->response->redirect('/users');
        }
        echo 'Error store record';
    }
}
