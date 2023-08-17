<?php

namespace App\Controller;

use Core\Contracts\Controller;
use Core\Contracts\ViewInterface;
use Core\Contracts\ResponseInterface;
use App\Contracts\UserRepositoryInterface;

class Users implements Controller
{

    private ViewInterface $view;
    private UserRepositoryInterface $users;

    public function __construct(ViewInterface $view, UserRepositoryInterface $users)
    {
        $this->view = $view;
        $this->users = $users;
    }

    public function run(array $parameters = []): ResponseInterface
    {

        $users = $this->users->getAll();

        return $this->view->render(
                        'users.phtml',
                        [
                            'title' => 'Пользователи',
                            'users' => $users
                        ]
        );
    }
}
