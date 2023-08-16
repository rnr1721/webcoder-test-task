<?php

namespace App\Controller;

use Core\Contracts\ViewInterface;
use Core\Contracts\Controller;
use Core\Contracts\ResponseInterface;
use App\Model\UserRepository;
use App\Model\DeptRepository;

class UserCreate implements Controller
{

    private ViewInterface $view;
    private UserRepository $users;
    private DeptRepository $depts;

    public function __construct(ViewInterface $view, UserRepository $users, DeptRepository $depts)
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
