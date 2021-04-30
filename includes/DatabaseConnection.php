<?php

$pdo = new PDO(
    'mysql:host=us-cdbr-east-03.cleardb.com;dbname=heroku_85647ba5e83802f;charset=utf8',
    'b362fedcb8db41',
    '9edd129b'
);

$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);