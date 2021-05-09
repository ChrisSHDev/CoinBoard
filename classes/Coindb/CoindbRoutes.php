<?php

namespace Coindb;

class CoindbRoutes implements \FrameWork\Routes
{
    private $usersTable;
    private $articlesTable;
    private $authentication;
    private $tagsTable;

    public function __construct()
    {
        include __DIR__ . '/../../includes/DatabaseConnection.php';

        $this -> articlesTable = new \FrameWork\DatabaseTable($pdo, 'articles', 'id');
        $this -> usersTable = new \FrameWork\DatabaseTable($pdo, 'user', 'id');
        $this -> authentication = new \FrameWork\Authentication($this -> usersTable, 'email', 'password');
        $this -> tagsTable = new \FrameWork\DatabaseTable($pdo, 'tag', 'id');
    }

    public function getRoutes(): array
    {
        $userController = new \Coindb\Controllers\Register($this -> usersTable);
        $articleController = new \Coindb\Controllers\Coin($this -> articlesTable, $this -> usersTable, $this -> authentication);
        $loginController = new \Coindb\Controllers\Login($this->authentication);
        $tagController = new \Coindb\Controllers\Tag($this -> tagsTable);
        
        $routes = [
            'user/register' => [
                'GET' => [
                    'controller' => $userController,
                    'action' => 'registrationForm'
                ],
                'POST' => [
                    'controller' => $userController,
                    'action' => 'registerUser'
                ]
                ],
            'login/error' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'error'
                ]
                ],
            'login/success' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'success'
                ]
            ],
            'login' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'loginForm'
                ],
                'POST' => [
                    'controller' => $loginController,
                    'action' => 'processLogin'
                ]
                ],
            'logout'=> [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'logout'
                ]
                ],
            'user/success' => [
                'GET' => [
                    'controller' => $userController,
                    'action' => 'success'
                ]
            ],
            'article/edit' => [
                'POST' => [
                    'controller' => $articleController,
                    'action' => 'saveEdit'
                ],
                'GET' => [
                    'controller' => $articleController,
                    'action' => 'edit'
                ],
                'login' => true
                ],
                'article/delete' => [
                    'POST' => [
                        'controller' => $articleController,
                        'action' => 'delete'
                    ],
                    'login' => true
                ],
                'article/list' => [
                    'GET' =>[
                        'controller' => $articleController,
                        'action' => 'list'
                    ]
                    ],
                  'article/page' => [
                    'GET' => [
                      'controller' => $articleController,
                      'action' => 'show'
                    ]
                    ],
                ''=>[
                    'GET' => [
                        'controller' => $articleController,
                        'action' => 'home'
                    ]
                    ],
                    'tag/edit' => [
                      'POST' => [
                        'controller' => $tagController,
                        'action' => 'saveEdit'
                      ],
                      'GET' => [
                        'controller' => $tagController,
                        'action' => 'edit'
                      ],
                      'login' => true
                    ]

            ];


        return $routes;
    }

    public function getAuthentication(): \FrameWork\Authentication
    {
        return $this -> authentication;
    }
}