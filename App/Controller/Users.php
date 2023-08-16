<?php

namespace App\Controller;

use Core\Contracts\Controller;
use Core\Contracts\ViewInterface;
use Core\Contracts\ResponseInterface;
use App\Model\UserRepository;

class Users implements Controller
{

    private ViewInterface $view;
    private UserRepository $users;

    public function __construct(ViewInterface $view, UserRepository $users)
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
