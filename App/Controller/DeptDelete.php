<?php

namespace App\Controller;

use Core\Contracts\Controller;
use Core\Contracts\ResponseInterface;
use App\Model\DeptRepository;

class DeptDelete implements Controller
{

    private ResponseInterface $response;
    private DeptRepository $depts;

    public function __construct(ResponseInterface $response, DeptRepository $depts)
    {
        $this->response = $response;
        $this->depts = $depts;
    }

    public function run(array $parameters = []): ResponseInterface
    {   
        $this->depts->delete($parameters['deptId']);
        $this->response->redirect('/depts');
    }
}
