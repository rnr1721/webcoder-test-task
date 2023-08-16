<?php

namespace App\Controller;

use Core\Contracts\Controller;
use Core\Contracts\RequestInterface;
use Core\Contracts\ResponseInterface;
use Core\Contracts\DatabaseInterface;

class UserUpdate implements Controller
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

        if (isset($data['id'])) {
            $result = $this->db->updateRow(
                    'users',
                    $data,
                    ['dept_id', 'email', 'username', 'address', 'phone', 'comment'],
                    $data['id']
            );
        } else {
            $result = $this->db->insertRow(
                    'users',
                    $data,
                    ['dept_id', 'email', 'username', 'address', 'phone', 'comment']
            );
        }

        if ($result) {
            $this->response->redirect('/users');
        }
        echo 'Error store record';
    }
}
