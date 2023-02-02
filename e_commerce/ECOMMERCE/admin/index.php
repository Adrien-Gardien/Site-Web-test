<?php
require_once('../includes/header.php');

if(isset($_SESSION['user_id'])) {
    header('location: product/index.php');
}


if (!empty($_POST)) {
    $errors = [];
    // on vérifie que les champs ne sont pas vide.

    if (empty($_POST['email'])) {
        $errors[] = "Le champ mail doit être remplie";
    }
    if (empty($_POST['password'])) {
        $errors[] = "Le champ password doit être remplie";
    }

    // On valide le type attendu 

    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false) {
        $errors[] = "Le champ email rentré n'est pas conforme";
    }

    if (!is_string($_POST['password'])) {
        $errors[] = "Le champ password rentré n'est pas au bons caractères";
    }
    if (strlen($_POST['password']) < 5) {
        $errors[] = "Le password doit contenir plus de 5 caractère";
    }


    // on verifie si l'emùail correspond à celui d'un utilisateur
    $requete = $pdo->prepare("SELECT * FROM user WHERE email = ?");
    $requete->execute([$_POST['email']]);
    $user = $requete->fetch(pdo::FETCH_ASSOC);

    if ($user == false) {
        $errors[] = "Cette email correspond à aucun utilisateur";
    }
    // On vérifie que le mot de passe correspond à celui de l'utilisateur
    if (password_verify($_POST['password'], $user['password']) == false) {
        $errors[] = "Le mot de passe ne correspond pas à celui de l'utilisateur";
    }

    if (count($errors) < 1) {
        // verification
        $_SESSION['user_id'] = $user['id_user'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['prenom'] = $user['prenom'];

        header('location: product/index.php');
    } else {
        foreach ($errors as $error) {
            echo "<p class='alert-danger'>" . $error . "</p>";
        }
    }
}
?>

<div main=id class="text-center">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <fieldset>
            <legend> Connexion </legend>

            <label for="email">Email</label>
            <input type="email" name="email" id="email">

            <label for="password">Password</label>
            <input type="password" name="password" id="password">

            <input type="submit" value="valider">
        </fieldset>
    </form>

</div>


<?php
require_once('../includes/footer.php');

?>