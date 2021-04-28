<?php

namespace Coindb\Controllers;

use \FrameWork\DatabaseTable;
use \FrameWork\Authentication;

class Coin
{
    private $usersTable;
    private $articlesTable;

    public function __construct(DatabaseTable $articlesTable, DatabaseTable $usersTable, Authentication $authentication)
    {
        $this -> articlesTable = $articlesTable;
        $this -> usersTable = $usersTable;
        $this -> authentication = $authentication;
    }

    public function list()
    {
        if (isset($_GET['categoryId'])) {
            $result = $this -> articlesTable -> find('categoryId', $_GET['categoryId']);
            $totalArticles = count($result);
            $categoryId = $_GET['categoryId'];
        } else {
            $result = $this -> articlesTable -> findAll();
            $totalArticles = $this -> articlesTable -> total();
            $categoryId = '';
        }
        
        $articles = [];

        foreach ($result as $article) {
            $user = $this -> usersTable -> findById($article['userId']);

            $articles[] = [
                'id' => $article['id'],
                'articlecontents' => $article['articlecontents'],
                'articlesubject' => $article['articlesubject'],
                'articledate' => $article['articledate'],
                'categoryId' => $article['categoryId'],
                'name' => $user['name'],
                'email' => $user['email'],
                'userId' => $user['id']
            ];
        }


        $title = 'Free Board';

        $author = $this -> authentication -> getUser();

        return ['template' => 'articles.html.php',
                     'title' => $title,
                     'variables' => [
                        'totalArticles' => $totalArticles,
                        'articles' => $articles,
                        'categoryId' => $categoryId,
                        'userId' => $author['id'] ?? null
                     ]
                    ];
    }
    
    public function home()
    {
        $result = $this -> articlesTable -> findAll();

        $jokes = [];

        foreach ($result as $article) {
            $user = $this -> usersTable -> findById($article['userId']);

            $articles[] = [
                'id' => $article['id'],
                'articlesubject' => $article['articlesubject'],
                'articlecontents' => $article['articlecontents'],
                'articledate' => $article['articledate'],
                'categoryId' => $article['categoryId'],
                'name' => $user['name'],
                'email' => $user['email'],
                'userId' => $user['id']
            ];
        }

        $title = 'Welcome to Coin Board';

        return [ 'template' => 'home.html.php',
                  'title' => $title,
                  'variables' => [
                    'articles' => $articles,
                    'userId' => $user['id'] ?? null
                 ]
             ];
    }

    public function delete()
    {
        $user = $this -> authentication -> getUser();

        $article = $this -> articlesTable -> findById($_POST['id']);
        if ($article['userId'] != $user['id']) {
            return;
        }

        $this -> articlesTable -> delete($_POST{'id'});

        header('location: /article/list');
    }

    public function saveEdit()
    {
        $user = $this -> authentication -> getUser();

        if (isset($_GET['id'])) {
            $article = $this -> articlesTable -> findById($_GET['id']);
            if ($article['userId'] != $user['id']) {
                return;
            }
        }

        $article = $_POST['article'];
        $article['articledate'] = new \DateTime();
        $article['userId'] = $user['id'];

        $this -> articlesTable -> save($article);

        header('location: /article/list');
    }

    public function edit()
    {
        $user = $this -> authentication -> getUser();
        
        if (isset($_GET['id'])) {
            $article = $this -> articlesTable -> findById($_GET['id']);
        }

        $title = 'Edit Joke Article';

        return ['template' => 'editarticle.html.php',
                    'title' => $title,
                    'variables' => [
                        'article' => $article ?? null,
                        'userId' => $user['id'] ?? null
                    ]
                    
                ];
    }

    public function show()
    {
        if (isset($_GET['id'])) {
            $article = $this -> articlesTable -> findById($_GET['id']);
        }

        $title = 'Article Page';

        return ['template' => 'single-article.html.php',
              'title' => $title,
              'variables' => [
                'article' => $article ?? null
              ]];
    }
}