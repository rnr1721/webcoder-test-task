<?php

namespace App\Controller;

use Core\Contracts\Controller;
use Core\Contracts\ResponseInterface;
use Core\Contracts\ViewInterface;

class NotfoundController implements Controller
{

    private ViewInterface $view;

    public function __construct(ViewInterface $view)
    {
        $this->view = $view;
    }

    public function run(array $params = []): ResponseInterface
    {
        return $this->view->render('notfound.phtml', ['title' => 'Страница не найдена'], 404);
    }
}
