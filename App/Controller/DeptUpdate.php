<?php

namespace App\Controller;

use Core\Contracts\Controller;
use Core\Contracts\RequestInterface;
use Core\Contracts\ResponseInterface;
use Core\Contracts\DatabaseInterface;

class DeptUpdate implements Controller
{

    private RequestInterface $request;
    private ResponseInterface $response;
    private DatabaseInterface $db;

    public function __construct(RequestInterface $request, ResponseInterface $response, DatabaseInterface $db)
    {
        $this->request = $request;
        $this->response = $response;
        $this->db = $db;
    }

    public function run(array $parameters = []): ResponseInterface
    {
        $data = $this->request->getPostData();


            $result = $this->db->insertRow(
                    'depts',
                    $data,
                    ['name']
            );


        if ($result) {
            $this->response->redirect('/depts');
        }
        echo 'Error store record';
    }
}
