<?php
require_once '../../includes/header.php';
if (!$_SESSION['user_id']) {
    header('location: ../index.php');
}

echo '<pre>';
print_r($requete);
echo '</pre>';


$requete_slider = $pdo->prepare("SELECT * FROM slider WHERE id_slider = ?");
$requete_slider->execute([$_GET['id_slider']]);
$item = $requete_slider->fetch(PDO::FETCH_ASSOC);


if (!empty($_POST) && !(empty($_FILES))) {
    // la variable $nom_du_fichier récupère le nom du fichier
    $nom_du_fichier = (empty($_FILES['fichier']['name'])) ? $item['image'] : $_FILES['fichier']['name'];

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

        if (empty($_POST['nom'])) {
            $errors[] = 'Le nom ne peut pas être vide';
        }

        if (empty($_POST['description'])) {

            $errors[] = 'la description ne peut pas être vide';
        }
        if (empty($_POST['titre'])) {

            $errors[] = 'le titre ne peut pas être vide';
        }

        if (!is_string($_POST['nom'])) {
            $errors[] = 'Le nom doit être alphanumerique';
        }

        if (!is_string($_POST['description'])) {

            $errors[] = 'La description doit être alphanumerique';
        }
        if (!is_string($_POST['titre'])) {

            $errors[] = 'Le titre doit être alphanumerique';
        }

        if (count($errors) < 1) {
            // traitement;

            if (isset($_FILES['fichier']['name']) && !empty($_FILES['fichier']['name'])) {

                // supprimer l'ancienne page
                $item = $item['image'];
                unlink("../../uploads/$item");
                if (move_uploaded_file($dossier_temporaire, $dossier_uploads)) {

                    // insertion dans la Bdd
                }
            }

            $requete_2 = $pdo->prepare('UPDATE slider SET nom = ?, titre = ?, description = ?, image = ? WHERE id_slider = ?');
            $requete_2->execute([$_POST['nom'], $_POST['titre'], $_POST['description'], $nom_du_fichier, $_POST['id_slider']]);
            header('Location: index.php');
        }
    } else {
        echo 'Vous ne pouvez uploader que des fichiers PDF';
    }
    foreach ($errors as $error) {
        echo '<p class="btn-danger">' . $error . '</p>';
    }
}

// $requete = $pdo->query("SELECT * FROM slider");
// $requete_blabla = $requete->fetchAll(PDO::FETCH_ASSOC);







?>

<div id="main">

    <form action="<?php echo $_SERVER['PHP_SELF'] . '?id_slider=' . $_GET["id_slider"]; ?>" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Modifier votre slider</legend>

            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" value="<?php echo $item['nom']; ?>">

            <label for="titre">Titre</label>
            <input type="text" name="titre" id="titre" value="<?php echo $item['titre']; ?>">

            <label for="description"> description</label>
            <input type="text" name="description" id="description" value="<?php echo $item['description']; ?>">

            <label> Image</label>
            <input type="file" name="fichier">
            <?php if (isset($item['image'])) { ?>

                <img src="../../uploads/<?php echo $item['image']; ?>" width="50" height="50">

            <?php } ?>


            <input type="submit" value="créer">

        </fieldset>

    </form>

</div>
<?php
require_once '../../includes/footer.php';
?>