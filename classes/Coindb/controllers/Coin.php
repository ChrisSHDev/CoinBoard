<?php 

namespace Coindb\Controllers;
use \FrameWork\DatabaseTable;
use \FrameWork\Authentication;


class Coin{
    private $usersTable;
    private $articlesTable;

    public function __construct( DatabaseTable $articlesTable, DatabaseTable $usersTable, Authentication $authentication )
    {
        $this -> articlesTable = $articlesTable;
        $this -> usersTable = $usersTable;
        $this -> authentication = $authentication;
    }

    public function list() {
        $result = $this -> articlesTable -> findAll();

        $jokes = [];

        foreach ( $result as $article ) {
            $user = $this -> usersTable -> findById( $article['userId']);

            $articles[] = [
                'id' => $article['id'],
                'articlecontents' => $article['articlecontents'],
                'articledate' => $article['articledate'],
                'name' => $user['name'],
                'email' => $user['email'],
                'userId' => $user['id']
            ];

        }


        $title = 'Free Board';

        $totalArticles = $this -> articlesTable -> total();

        $author = $this -> authentication -> getUser();

            return ['template' => 'jokes.html.php', 
                     'title' => $title,
                     'variables' => [
                        'totalArticles' => $totalArticles,
                        'articles' => $articles,
                        'userId' => $user['id'] ?? null
                     ]
                    ];
    }

    public function home() {

        $result = $this -> articlesTable -> findAll();

        $jokes = [];

        foreach ( $result as $article ) {
            $user = $this -> usersTable -> findById( $article['userId']);

            $articles[] = [
                'id' => $article['id'],
                'articlesubject' => $article['articlesubject'],
                'articlecontents' => $article['articlecontents'],
                'articledate' => $article['articledate'],
                'name' => $user['name'],
                'email' => $user['email'],
                'userId' => $user['id']
            ];

        }

        $title = 'Online Joke World';

        return [ 'template' => 'home.html.php', 
                  'title' => $title,
                  'variables' => [
                    'articles' => $articles,
                    'userId' => $user['id'] ?? null
                 ]        
             ];

    }

    public function delete() {
        $user = $this -> authentication -> getUser();

        $article = $this -> articleTable -> findById($_GET['id']);
        if( $article['authorId'] != $user['id']){
            return;
        }

        $this -> articlesTable -> delete( $_POST{'id'});

        header('location: /joke/list');
    }

    public function saveEdit() {
        $author = $this -> authentication -> getUser();

        if(isset($_GET['id'])){
            $article = $this -> articlesTable -> findById($_GET['id']);
            if( $article['userId'] != $user['id']){
                return;
            }
        }

        $article = $_POST['article'];
        $article['articledate'] = new \DateTime();
        $article['userId'] = $author['id'];

        $this -> articlesTable -> save($article);

        header('location: /joke/list');
    }

    public function edit() {
        $author = $this -> authentication -> getUser();
        var_dump($author);
        if(isset($_GET['id'])){
            $joke = $this -> jokesTable -> findById($_GET['id']);
        }

            $title = 'Edit Joke Article';

            return ['template' => 'editjoke.html.php', 
                    'title' => $title,
                    'variables' => [
                        'joke' => $joke ?? null,
                        'userId' => $author['id'] ?? null
                    ]
                    
                ];
    
    }
}