<?php
require_once '../../includes/header.php';
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

        if (empty($_POST['nom'])) {
            $errors[] = "le nom ne peut pas être vide";
        }

        if (empty($_POST['description'])) {
            $errors[] = "la description ne peut pas être vide";
        }
        if (!is_string($_POST['nom'])) {
            $errors[] = "le nom ne peut être qu'en caractère alphanumérique";
        }
        if (!is_string($_POST['description'])) {
            $errors[] = "la description ne peut être qu'en caractère alphanumérique";
        }
        if (count($errors) < 1) {

            // traitement;
            if (move_uploaded_file($dossier_temporaire, $dossier_uploads)) {

                $requete = $pdo->prepare('INSERT INTO product (id_product, nom, description, image, categorie_id) VALUES(null,?,?,?,?)');
                $requete->execute([$_POST['nom'], $_POST['description'], $_FILES['fichier']['name'], $_POST['categorie']]);
                header('location: index.php');
            }
        } else {
            echo 'Vous ne pouvez uploader que des fichiers PDF';
        }
    }

}

$requete = $pdo->query("SELECT * FROM categorie");
$categories = $requete->fetchAll(PDO::FETCH_ASSOC);

?>

<div id="main">

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Créer votre produit</legend>

            <label for="nom">nom</label>
            <input type="text" name="nom" id="nom">

            <label for="description"> description</label>
            <input type="text" name="description" id="description">

            <label> Image</label>
            <input type="file" name="fichier">

            <label for="category">categories</label>
            <select name="categorie" id="categorie">
                <?php foreach ($categories as $category) { ?>
                    <option value="<?php echo $category['id_categorie']; ?>">
                        <?php echo $category['nom']; ?>
                    </option>
                <?php } ?>
            </select>

            <input type="submit" value="créer">

        </fieldset>

    </form>

</div>
<?php
require_once '../../includes/footer.php';
?>