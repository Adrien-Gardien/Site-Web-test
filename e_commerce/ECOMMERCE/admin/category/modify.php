<?php

require_once('../../includes/header.php');
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/e_commerce/ECOMMERCE/config/pdo.php';
if(!$_SESSION['user_id']){
    header('location: ../index.php');
}

if (!empty($_POST)) {
    $requete_modif = $pdo->prepare('UPDATE categorie SET nom = ? WHERE id_categorie = ?');
    $requete_modif->execute([$_POST['nom'], $_GET['id_categorie']]);
    header('location: index.php');
}

$requete = $pdo->prepare("SELECT * FROM categorie WHERE id_categorie = ?");
$requete->execute([$_GET['id_categorie']]);
$categorie = $requete->fetch(PDO:: FETCH_ASSOC);


?>

<div id="main">
    <form action="<?php echo $_SERVER['PHP_SELF']."?id_categorie=".$_GET['id_categorie']; ?>" method="post">
        <fieldset class="text-center mt-5">
            <legend class="my-2 fs-4 text"> Modifier la catégorie :</legend>
            <label for="nom" class="my-2">Nom</label>
            <input type="text" name="nom" id="nom" class="my-2" value="<?= $categorie['nom']; ?>">
            <br>
            <input type="submit" value="valider" class="mb-5 mt-2 btn btn-dark">
        </fieldset>
    </form>
</div>