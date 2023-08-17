<?php

use PHPUnit\Framework\TestCase;

class FrameworkTest extends TestCase
{

    public function testResponse()
    {
        $response = new Core\Response();
        $response->setHeader('Content-Language', 'ru');
        $response->setResponseCode(200);
        $response->setBody('response body');
        ob_start();
        $response->emit();
        $result = ob_end_clean();
        $this->assertEquals(['Content-Language' => 'ru'], $response->getHeaders());
        $this->assertEquals(200, $response->getResponseCode());
        $this->assertEquals('response body', $result);
    }

    public function testRequest()
    {

        $fakePost = [
            'userId' => '5'
        ];

        $fakeServer = [
            'REQUEST_URI' => '/users',
            'REQUEST_METHOD' => 'GET'
        ];
        $request = new Core\Request($fakeServer, $fakePost);
        $this->assertEquals($fakePost, $request->getPostData());
        $this->assertEquals('/users', $request->getRequestUri());
        $this->assertEquals('GET', $request->getRequestMethod());
        $this->assertEquals($fakeServer, $request->getVars());
    }

    public function testRouter()
    {
        $fakeServer = [
            'REQUEST_URI' => '/users/4',
            'REQUEST_METHOD' => 'GET'
        ];
        $routes = [
            'GET' => [
                '/users' => function () {
                    return 'users';
                },
                '/users/{userId}' => function () {
                    return 'user4';
                },
                'notfound' => function () {
                    return 'notfound';
                }
            ],
            'POST' => [
                '/product' => function () {
                    return 'product';
                },
            ]
        ];
        $request = new Core\Request($fakeServer);
        $router = new Core\Router($routes, $request);
        $withUserId = $router->route('GET', '/users/4');
        $this->assertEquals('user4', $withUserId['controller']());
        $users = $router->route('GET', '/users');
        $this->assertEquals('users', $users['controller']());
        $notfound = $router->route('GET', '/other');
        $this->assertEquals('notfound', $notfound['controller']());
        $productPost = $router->route('POST', '/product');
        $this->assertEquals('product', $productPost['controller']());
    }

    public function testview()
    {
        $response = new Core\Response();
        $view = new \Core\View('./tests/view', $response);
        $result = $view->render('template.phtml', ['myVar' => '777']);
        ob_start();
        $result->emit();
        $output = ob_end_clean();
        $this->assertEquals('test template - 777 - end of template', $output);
    }
}
