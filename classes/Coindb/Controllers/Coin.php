<?php

namespace Coindb\Controllers;

use \FrameWork\DatabaseTable;
use \FrameWork\Authentication;

class Coin
{
    private $usersTable;
    private $articlesTable;
    private $authentication;
    private $tagsTable;
    private $articletagsTable;

    public function __construct(DatabaseTable $articlesTable, DatabaseTable $usersTable, DatabaseTable $tagsTable, DatabaseTable $articletagsTable, Authentication $authentication)
    {
        $this -> articlesTable = $articlesTable;
        $this -> usersTable = $usersTable;
        $this -> tagsTable = $tagsTable;
        $this -> authentication = $authentication;
        $this -> articletagsTable = $articletagsTable;
    }

    public function list()
    {
        if (isset($_GET['categoryId'])) {
            $result = $this -> articlesTable -> find('categoryId', $_GET['categoryId']);
            $totalArticles = count($result);
            $categoryId = $_GET['categoryId'];
        } elseif (isset($_GET['tag'])) {
            $articleInTag = $this -> articletagsTable -> find('tagId', $_GET['tag']);
  
            $tags = [];
        
            foreach ($articleInTag as $article) {
                $result [] = $this -> articlesTable -> findById($article['articleId']);
            }
            $categoryId = '';
            $totalArticles = count($result);
        } else {
            $result = $this -> articlesTable -> findAll();
            $totalArticles = $this -> articlesTable -> total();
            $categoryId = '';
        }

        $coins =[];
        $coins = $this -> showExchangeRate();

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
        
        $isLoggedIn = $this -> authentication -> isLoggedIn();

        return ['template' => 'articles.html.php',
                  'dataOut' => 'coindata.html.php',
                     'title' => $title,
                     'variables' => [
                        'totalArticles' => $totalArticles,
                        'articles' => $articles,
                        'categoryId' => $categoryId,
                        'userId' => $author['id'] ?? null,
                        'loggedIn' => $isLoggedIn,
                        'coins' => $coins
                     ]
                    ];
    }

    private function getApi($url)
    {
        $ch = curl_init();
        // IMPORTANT: the below line is a security risk, read https://paragonie.com/blog/2017/10/certainty-automated-cacert-pem-management-for-php-software
        // in most cases, you should set it to true
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');
        $result = curl_exec($ch);
        
        curl_close($ch);

        return json_decode($result, true);
    }

    public function showExchangeRate()
    {
        $coinStats = $this -> getApi('https://api.pro.coinbase.com/products/stats');
      

        $coinNames = [
        1 => 'BTC',
        2 => 'ADA',
        3 => 'ETH',
        4 => 'LTC',
        5 => 'BCH'
      ];

        $coinInfo =[] ;

        foreach ($coinNames as $eachCoin) {
            $getValueUrl = 'https://api.coinbase.com/v2/exchange-rates?currency=' . $eachCoin;

            $coinCurrency = $this -> getApi($getValueUrl);

            $coinSelector = $eachCoin . '-USD';
            $title = 'Welcome to Coin Board';
            $coinInfos[] = [
                      'name' => $coinCurrency['data']['currency'],
                       'CAD' => $coinCurrency['data']['rates']['CAD'],
                       'USD' => $coinCurrency['data']['rates']['USD'],
                       'volume' => $coinStats[$coinSelector]['stats_24hour']['volume'],
                       'changes' => ($coinStats[$coinSelector]['stats_24hour']['last'] - $coinStats[$coinSelector]['stats_24hour']['open']),
                       'ratio' => (($coinStats[$coinSelector]['stats_24hour']['last'] / $coinStats[$coinSelector]['stats_24hour']['open'] - 1) * 100)
            ];
        }

        return $coinInfos;
    }
    
    public function home()
    {
        $result = $this -> articlesTable -> findAll();

        $jokes = [];

        $coins = [];

        $coins = $this -> showExchangeRate();

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
                  'dataOut' => 'coindata.html.php',
                  'title' => $title,
                  'variables' => [
                    'articles' => $articles,
                    'userId' => $user['id'] ?? null,
                    'coins' => $coins
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

        $this -> articlesTable -> delete($_POST['id']);

        header('location: /article/list');
    }

    public function clearTags($id)
    {
        $this -> articletagsTable -> deleteWhere('articleId', $id);
    }

    public function saveEdit()
    {
        $user = $this -> authentication -> getUser();
        $clearTag = $this -> clearTags($_GET['id']);
        
        if (isset($_POST['tag'])) {
            foreach ($_POST['tag'] as $tagId) {
                $tag['id'][] = $tagId;
            }
        } else {
            $tag['id'] = [];
        }
        
        if (isset($_GET['id'])) {
            $article = $this -> articlesTable -> findById($_GET['id']);
            if ($article['userId'] != $user['id']) {
                return;
            }

            $currentArticleId = $this -> articlesTable -> findById($_GET['id']);

            $articleTags = [
              'articleId' => intval($currentArticleId['id']),
              'tagId' => $tag['id']
      ];
        } else {
            $currentArticleId = $this -> articlesTable -> findLast();


            $articleTags = [
                'articleId' => intval($currentArticleId[0]['id'])+1,
                'tagId' => $tag['id']
        ];
        }

        $article = $_POST['article'];
        $article['articledate'] = new \DateTime();
        $article['userId'] = $user['id'];

        $this -> articlesTable -> save($article);
        
        $this -> articletagsTable -> saveTag($articleTags);

        header('location:/article/list');
    }

    public function edit()
    {
        $user = $this -> authentication -> getUser();
        $tags = $this -> tagsTable -> findAll();
        
        
        if (isset($_GET['id'])) {
            $article = $this -> articlesTable -> findById($_GET['id']);
            $articletags = $this -> articletagsTable -> find('articleId', $_GET['id']);
        } else {
            $articletags = '';
        }

        $title = 'Edit Joke Article';

        return ['template' => 'editarticle.html.php',
                    'title' => $title,
                    'variables' => [
                        'article' => $article ?? null,
                        'userId' => $user['id'] ?? null,
                        'tags' => $tags,
                        'articletags' => $articletags
                    ]
                    
                ];
    }

    public function show()
    {
        if (isset($_GET['id'])) {
            $article = $this -> articlesTable -> findById($_GET['id']);
            $user = $this -> usersTable -> findById($article['userId']);
            $articleTag = $this -> articletagsTable -> find('articleId', $_GET['id']);

            $tags = [];
            
            foreach ($articleTag as $tag) {
                $tags [] = $this -> tagsTable -> findById($tag['tagId']);
            }
        }

        $title = 'Article Page';

        return ['template' => 'single-article.html.php',
              'title' => $title,
              'variables' => [
                'article' => $article ?? null,
                'user' => $user['name'],
                'tags' => $tags
              ]];
    }

    // public function hasTag($tagId)
    // {
    //     $articleTags = $this -> articletagsTable -> find('tagId', );

    //     foreach ($articletags as $articletag) {
    //         if ($articletag -> tagId == $tagId) {
    //             return true;
    //         }
    //     }
    // }
}