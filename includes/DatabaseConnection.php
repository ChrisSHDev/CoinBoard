<?php 

$pdo = new PDO( 'mysql:host=localhost;dbname=coindb;charset=utf8',
'Coindbuser', 'mypassword');

$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);