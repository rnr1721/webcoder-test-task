<?php

namespace App\Controller;

use Core\Contracts\Controller;
use Core\Contracts\RequestInterface;
use Core\Contracts\ResponseInterface;
use App\Contracts\DeptRepositoryInterface;

class DeptUpdate implements Controller
{

    private RequestInterface $request;
    private ResponseInterface $response;
    private DeptRepositoryInterface $depts;

    public function __construct(RequestInterface $request, ResponseInterface $response, DeptRepositoryInterface $depts)
    {
        $this->request = $request;
        $this->response = $response;
        $this->depts = $depts;
    }

    public function run(array $parameters = []): ResponseInterface
    {
        $data = $this->request->getPostData();

        $result = $this->depts->update($data);

        if ($result) {
            $this->response->redirect('/depts');
        }
        echo 'Error store record';
    }
}
