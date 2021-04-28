<?php

try {
    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/../classes/DatabaseTable.php';

    $articlesTable = new DatabaseTable($pdo, 'articles', 'id');
    $usersTable = new DatabaseTable($pdo, 'user', 'id');

    $result = $articlesTable -> findAll();

    $articles = [];
    foreach ($result as $article) {
        $user = $usersTable -> findById($article['userId']);
        $articles[] =[
            'id' => $article['id'],
            'articletext' => $article['articlecontents'],
            'articledate' => $article['articledate'],
            'name' => $user['name'],
            'email' => $user['email']
        ];
    }

    $title = 'article Board';

    $totalarticles = $articlesTable -> total();

    ob_start();

    include __DIR__ . '/../templates/articles.html.php';

    $output = ob_get_clean();
} catch (PDOException $e) {
    $output = 'Database Connection Fail!' .
    $e -> getMessage() . ', location: ' .
    $e -> getFile() . ':' . $e -> getLine();
}

include __DIR__ . '/../templates/layout.html.php';