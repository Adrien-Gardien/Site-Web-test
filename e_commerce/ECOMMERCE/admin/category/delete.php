<?php
require_once '../../includes/header.php';
if(!$_SESSION['user_id']){
    header('location: ../index.php');
}

if(empty($_GET['id_categorie']))
{
    header('location: index.php');
}

$pdo->prepare('DELETE FROM categorie WHERE id_categorie = ?')->execute([$_GET['id_categorie']]);
header('location: index.php');