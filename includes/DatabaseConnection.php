<?php 

$pdo = new PDO( 'mysql:host=localhost;dbname=coindb;charset=utf8',
'coindbuser', 'ilovecanada');

$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);