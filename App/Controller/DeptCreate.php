<?php

namespace App\Controller;

use Core\Contracts\ViewInterface;
use Core\Contracts\Controller;
use Core\Contracts\ResponseInterface;
use App\Contracts\DeptRepositoryInterface;

class DeptCreate implements Controller
{

    private ViewInterface $view;
    private DeptRepositoryInterface $depts;

    public function __construct(ViewInterface $view, DeptRepositoryInterface $depts)
    {
        $this->view = $view;
        $this->depts = $depts;
    }

    public function run(array $parameters = []): ResponseInterface
    {

        $depts = $this->depts->getAll();

        return $this->view->render(
                        'dept_create.phtml',
                        [
                            'title' => 'Отдел',
                            'user' => [],
                            'depts' => $depts
                        ]
        );
    }
}
