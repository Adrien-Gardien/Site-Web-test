<?php
require_once('../../includes/header.php');
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/e_commerce/ECOMMERCE/config/pdo.php';
if(!$_SESSION['user_id']){
    header('location: ../index.php');
}

?>

<div id="main">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <fieldset class="text-center mt-5">
            <legend class="my-2 fs-4 text"> Veuillez ajouter une catégorie</legend>
            <label for="nom" class="my-2">Nom</label>
            <input type="text" name="nom" id="nom" class="my-2">
            <br>
            <input type="submit" value="valider" class="mb-5 mt-2 btn btn-dark">
        </fieldset>
    </form>
</div>

<?php 
if (!empty($_POST)) {

    $errors = [];
    // On verifie que le champ nom n'est pas vide
    // On vérifie que le champ nom est de type string

    if (empty($_POST['nom'])) {
        $errors[] = "Le champ nom de la catégorie ne doit pas être vide";
    }
    if (!is_string($_POST['nom'])) {
        $errors[] = "Le nom de la catégorie n'est pas en caractère alphanumérique";
    }
    if (strlen($_POST['nom']) < 1) {
        $errors[] = "la longueur du nom doit dépasser 1 caractère";
    }
    if(count($errors) < 1) {
        // insertion dans la BDD
        $pdo->prepare('INSERT INTO categorie (id_categorie, nom) VALUES (null, ?)')->execute([$_POST['nom']]);
        echo "<p class='text-success text-center fs-3 text'>La catégorie ".$_POST['nom']." a bien été ajoutée";
    } else {
        // On affiche les erreurs
        foreach($errors as $error) {
            echo '<p class="text-danger text-center fs-3 text">' . $error . '</p>';
        }
    }
}
?>

<p class='text-center'><a href="index.php" class='my-2 btn btn-dark text-center'>Retour</a></p>

<?php
require_once('../../includes/footer.php');
?>