<?php

namespace App\Controller;

use Core\Contracts\Controller;
use Core\Contracts\ViewInterface;
use Core\Contracts\ResponseInterface;
use Core\Contracts\DatabaseInterface;

class Depts implements Controller
{

    private ViewInterface $view;
    private DatabaseInterface $db;

    public function __construct(ViewInterface $view, DatabaseInterface $db)
    {
        $this->view = $view;
        $this->db = $db;
    }

    public function run(array $parameters = []): ResponseInterface
    {
        return $this->view->render('depts.phtml');
    }
}
