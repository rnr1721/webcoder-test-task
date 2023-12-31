<?php

namespace App\Controller;

use Core\Contracts\ViewInterface;
use Core\Contracts\Controller;
use Core\Contracts\ResponseInterface;
use App\Contracts\UserRepositoryInterface;
use App\Contracts\DeptRepositoryInterface;

class User implements Controller
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

        if (!is_numeric($parameters['userId'])) {
            $this->view->getResponse()->redirect('/404');
        }

        $user = $this->users->getOne($parameters['userId']);

        if (!$user) {
            $this->view->getResponse()->redirect('/users');
        }

        $depts = $this->depts->getAll();

        return $this->view->render(
                        'user_edit.phtml',
                        [
                            'title' => 'Пользователь',
                            'user' => $user,
                            'depts' => $depts
                        ]
        );
    }
}
