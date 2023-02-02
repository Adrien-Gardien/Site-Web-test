<?php
require_once('../../includes/header.php');
if(!$_SESSION['user_id']){
    header('location: ../index.php');
}

// on bloque l' acces à la page
if(empty($_GET) || !isset($_GET)) {
    header("location: index.php");
}


// on retourne le nom de l'image
$requete_image = $pdo->prepare("SELECT image FROM blog WHERE id_blog = ?");
$requete_image->execute([$_GET['id_blog']]);
$item = $requete_image->fetch();



// on supprime l'image lié au produit ?
$item_name = $item['image'];
unlink("../../uploads/$item_name");

$requete = $pdo->prepare('DELETE FROM blog WHERE id_blog = ?');
$requete->execute([$_GET['id_blog']]);
header('location: index.php');
?>