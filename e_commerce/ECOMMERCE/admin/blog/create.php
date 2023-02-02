<?php

require_once('../../includes/header.php');
if(!$_SESSION['user_id']){
    header('location: ../index.php');
}


if (!empty($_POST) && (!empty($_FILES))) {
    // la variable $nom_du_fichier récupère le nom du fichier
    $nom_du_fichier = $_FILES['fichier']['name'];

    // la variable  $type_de_fichier récupère le type du fichier
    $type_de_fichier = $_FILES['fichier']['type'];

    // la variable  $dossier_temporaire récupère le nom du dossier temporaire
    $dossier_temporaire = $_FILES['fichier']['tmp_name'];

    // la variable $dossier_uploads récupère le nom du dossier d'uploads
    $dossier_uploads = '../../uploads/' . $nom_du_fichier;

    // strrchr Trouve la dernière occurence d'un caractère dans un chaine et affiche
    // tout ce qui suit .
    $extension_du_fichier = strrchr($nom_du_fichier, '.');

    // Ce tableau affiche les extensions autorisees
    $extensions_autorisees = array('.png', '.PNG', '.jpg', '.JPG', '.jpeg', '.JPEG');


    if (in_array($extension_du_fichier, $extensions_autorisees)) {

        $errors = [];

        if (empty($_POST['titre'])) {
            $errors[] = "le titre ne peut pas être vide";
        }
        if (empty($_POST['description'])) {
            $errors[] = "la description ne peut pas être vide";
        }
        if (empty($_POST['date_de_publication'])) {
            $errors[] = "la date de publication ne peut pas être vide";
        }
        if (!is_string($_POST['date_de_publication'])) {
            $errors[] = "le nom ne peut être qu'en caractère alphanumérique";
        }
        if (!is_string($_POST['titre'])) {
            $errors[] = "le titre ne peut être qu'en caractère alphanumérique";
        }
        if (!is_string($_POST['description'])) {
            $errors[] = "la description ne peut être qu'en caractère alphanumérique";
        }
        if (count($errors) < 1) {

            // traitement;
            if (move_uploaded_file($dossier_temporaire, $dossier_uploads)) {

                $requete = $pdo->prepare('INSERT INTO blog (id_blog, titre, description, image, date_de_publication) VALUES(null,?,?,?,?)');
                $requete->execute([$_POST['titre'],$_POST['description'] , $_FILES['fichier']['name'], $_POST['date_de_publication']]);
                header('location: index.php');
            }
        } else {
            echo 'Vous ne pouvez uploader que des fichiers PDF';
        }
    }

}

$requete = $pdo->query("SELECT * FROM blog");
$sliders = $requete->fetchAll(PDO::FETCH_ASSOC);

?>

<div id="main" class="text-center">

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Ajouter un Blog</legend>

            <label for="titre"> Titre</label>
            <input type="text" name="titre" id="titre">

            <label for="description"> Description</label>
            <input type="text" name="description" id="description">

            <label> Image</label>
            <input type="file" name="fichier">

            <label for="date_de_publication"> Date de publication</label>
            <input type="text" name="date_de_publication" id="date_de_publication">

            <input type="submit" value="créer">

        </fieldset>

    </form>

</div>
<?php
require_once '../../includes/footer.php';
?>