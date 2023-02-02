<?php
require_once '../../includes/header.php';
if(!$_SESSION['user_id']){
    header('location: ../index.php');
}


$requete_product = $pdo->prepare("SELECT * FROM product WHERE id_product = ?");
$requete_product->execute([$_GET['id_product']]);
$item = $requete_product->fetch(PDO::FETCH_ASSOC);


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

        if (!is_string($_POST['nom'])) {
            $errors[] = 'Le nom doit être alphanumerique';
        }

        if (!is_string($_POST['description'])) {

            $errors[] = 'La description doit être alphanumerique';
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

            $requete = $pdo->prepare('UPDATE product SET nom = ? , description = ?, image = ?, categorie_id = ? WHERE id_product = ?');
            $requete->execute([$_POST['nom'], $_POST['description'], $nom_du_fichier, $_POST['categorie'], $_GET['id_product']]);
            header('Location: index.php');
        }
    } else {
        echo 'Vous ne pouvez uploader que des fichiers PDF';
    }
    foreach ($errors as $error) {
        echo '<p class="btn-danger">' . $error . '</p>';
    }

}

$requete = $pdo->query("SELECT * FROM categorie");
$categories = $requete->fetchAll(PDO::FETCH_ASSOC);




echo '<pre>';
print_r($item);
echo '</pre>';


?>

<div id="main">

    <form action="<?php echo $_SERVER['PHP_SELF'] . '?id_product=' . $_GET["id_product"]; ?>" method="post"
        enctype="multipart/form-data">
        <fieldset>
            <legend>Modifier votre produit</legend>

            <label for="nom">nom</label>
            <input type="text" name="nom" id="nom" value="<?php echo $item['nom']; ?>">

            <label for="description"> description</label>
            <input type="text" name="description" id="description" value="<?php echo $item['description']; ?>">

            <label> Image</label>
            <input type="file" name="fichier">
            <input name='id_product' type="hidden" value="<?php echo $item['id_product'] ?>">
            <?php if (isset($item['image'])) { ?>

                <img src="../../uploads/<?php echo $item['image']; ?>" width="50" height="50">

            <?php } ?>

            <label for="categorie">categories</label>
            <select name="categorie" id="categorie">
                <?php foreach ($categories as $categorie) { ?>
                    <option <?php if ($item['categorie_id'] == $categorie['id_categorie']) {
                        echo 'selected';
                    } ?>
                        value="<?php echo $categorie['id_categorie']; ?>">
                        <?php echo $categorie['nom']; ?>
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