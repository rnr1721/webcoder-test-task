<?php

namespace App\Controller;

use Core\Contracts\ViewInterface;
use Core\Contracts\Controller;
use Core\Contracts\ResponseInterface;
use App\Contracts\UserRepositoryInterface;
use App\Contracts\DeptRepositoryInterface;

class UserCreate implements Controller
{

    private ViewInterface $view;
    private UserRepositoryInterface $users;
    private DeptRepositoryInterface $depts;

    public function __construct(ViewInterface $view, UserRepositoryInterface $users, DeptRepositoryInterface $depts)
    {
        $this->view = $view;
        $this->users = $users;
        $this->depts = $depts;
    }

    public function run(array $parameters = []): ResponseInterface
    {

        $depts = $this->depts->getAll();

        return $this->view->render(
                        'user_create.phtml',
                        [
                            'title' => 'Пользователь',
                            'user' => [],
                            'depts' => $depts
                        ]
        );
    }
}
