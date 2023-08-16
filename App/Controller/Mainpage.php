<?php

namespace App\Controller;

use Core\Contracts\ResponseInterface;
use Core\Contracts\Controller;
use Core\Contracts\ViewInterface;

class Mainpage implements Controller
{

    private ViewInterface $view;

    public function __construct(ViewInterface $view)
    {
        $this->view = $view;
    }

    public function run(array $params = []): ResponseInterface
    {
        return $this->view->render(
                        'home.phtml',
                        ['title' => 'Главная страница']
        );
    }
}
