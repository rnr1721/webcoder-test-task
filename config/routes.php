<?php

use Core\Factories\ResponseFactory;
use Core\Factories\DatabaseFactory;
use App\Controller\Mainpage;
use App\Controller\Users;
use App\Controller\UserDelete;
use App\Controller\UserCreate;
use App\Controller\UserUpdate;
use App\Controller\Depts;
use App\Controller\Dept;
use App\Controller\User;
use App\Controller\NotfoundController;
use App\Model\UserRepository;
use App\Model\DeptRepository;

$responseFactory = new ResponseFactory('../App/View');
$dbFactory = new DatabaseFactory();

return [
    'GET' => [
        '/' => function () use ($responseFactory) {
            return new Mainpage($responseFactory->getView());
        },
        '/user/new' => function () use ($responseFactory, $dbFactory) {
            return new UserCreate(
            $responseFactory->getView(),
            new UserRepository($dbFactory->getDatabase()),
            new DeptRepository($dbFactory->getDatabase())
            );
        },
        '/user/delete/{userId}' => function () use ($responseFactory, $dbFactory) {
            return new UserDelete(
            $responseFactory->getResponse(),
            new UserRepository($dbFactory->getDatabase())
            );
        },
        '/users/{userId}' => function () use ($responseFactory, $dbFactory) {
            return new User(
            $responseFactory->getView(),
            new UserRepository($dbFactory->getDatabase()),
            new DeptRepository($dbFactory->getDatabase())
            );
        },
        '/users' => function () use ($responseFactory, $dbFactory) {
            return new Users(
            $responseFactory->getView(),
            new UserRepository($dbFactory->getDatabase())
            );
        },
        '/depts/{deptId}' => function () use ($responseFactory) {
            return new Dept($responseFactory->getView());
        },
        '/depts' => function () use ($responseFactory) {
            return new Depts($responseFactory->getView());
        },
        'notfound' => function () use ($responseFactory) {
            return new NotfoundController($responseFactory->getView());
        },
    ],
    'POST' => [
        '/users/update' => function () use ($responseFactory, $dbFactory) {
            global $request;
            return new UserUpdate(
            $request,
            $responseFactory->getResponse(),
            $dbFactory->getDatabase()
            );
        },
        '/users/create' => function () use ($responseFactory, $dbFactory) {
            global $request;
            return new UserUpdate(
            $request,
            $responseFactory->getResponse(),
            $dbFactory->getDatabase()
            );
        },
    ]
];
