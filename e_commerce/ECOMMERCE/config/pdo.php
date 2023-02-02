<?php

require_once(__DIR__ . '/global.php');
//  connexion à la BDD avec pdo (DIR pour directory)

$dbName = DB_NAME;
$dbHost = DB_HOST;
$dbUser = DB_USER;
$dbPassword = DB_PASSWORD;

$dsn = "mysql:host=$dbHost;dbname=$dbName";

// pdo représente ma connexion à la BDD
$pdo = new Pdo($dsn, $dbUser, $dbPassword);

// var_dump($pdo);


?>