<?php

namespace App\Controller;

use Core\Contracts\Controller;
use Core\Contracts\ViewInterface;
use Core\Contracts\ResponseInterface;
use App\Model\DeptRepository;

class Depts implements Controller
{

    private ViewInterface $view;
    private DeptRepository $depts;

    public function __construct(ViewInterface $view, DeptRepository $depts)
    {
        $this->view = $view;
        $this->depts = $depts;
    }

    public function run(array $parameters = []): ResponseInterface
    {
        
        $depts = $this->depts->getAll();
        
        return $this->view->render('depts.phtml',['title'=>'Отделы','depts' => $depts]);
    }
}
