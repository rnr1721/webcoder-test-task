<?php

namespace App\Controller;

use Core\Contracts\Controller;

class Dept implements Controller
{
    public function run(array $parameters = [])
    {
        var_dump($parameters);
    }
}
