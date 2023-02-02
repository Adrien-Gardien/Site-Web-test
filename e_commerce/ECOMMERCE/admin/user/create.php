<?php

require_once('../../includes/header.php');
if(!$_SESSION['user_id']){
    header('location: ../index.php');
}

?>

<div id="main" class="text-center">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Utilisateur</legend>

            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom">

            <label for="prenom"> Prénom</label>
            <input type="text" name="prenom" id="prenom">

            <label for="password"> Password</label>
            <input type="password" name="password" id="password">

            <label for="email"> Mail </label>
            <input type="email" name="email" id="email">

            <input type="submit" value="créer">

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
    if (empty($_POST['prenom'])) {
        $errors[] = "Le champ prenom de la catégorie ne doit pas être vide";
    }
    if (empty($_POST['email'])) {
        $errors[] = "Le champ mail de la catégorie ne doit pas être vide";
    }
    if (!is_string($_POST['prenom'])) {
        $errors[] = "Le nom de la catégorie n'est pas en caractère alphanumérique";
    }
    if (strlen($_POST['nom']) < 1) {
        $errors[] = "la longueur du nom doit dépasser 1 caractère";
    }
    if (strlen($_POST['prenom']) < 1) {
        $errors[] = "la longueur du nom doit dépasser 1 caractère";
    }
    if (strlen($_POST['password']) < 5) {
        $errors[] = "la longueur du nom doit dépasser 5 caractère";
    }
    if (!is_string($_POST['password'])) {
        $errors[] = "le password doit être alphanumérique";
    }
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false) {

        $errors[] = "veuillez taper un email correct";
    }

    $requete = $pdo->prepare("SELECT COUNT(email) FROM user WHERE email = ?");
    $requete->execute([$_POST['email']]);
    $verification_email = $requete->fetch();

    if($verification_email < 0) {
        $errors[] = "email déjà existant";
    } 


    $password_hash = password_hash($_POST['password'], PASSWORD_BCRYPT);

    if (count($errors) < 1) {

        $requete = $pdo->prepare("INSERT INTO user (id_user, nom, prenom, password, email) VALUES (null, ?, ?, ?, ?)");
        $requete->execute([$_POST['nom'], $_POST['prenom'], $password_hash, $_POST['email']]);
        header('location: index.php');
    } else {
        foreach ($errors as $error) {
         echo '<p class="text-danger text-center fs-3 text">' . $error . '</p>';
     } 
}
} 
?>

<p class='text-center'><a href="index.php" class='my-2 btn btn-dark text-center'>Retour</a></p>


<?php

require_once('../../includes/footer.php')

?>