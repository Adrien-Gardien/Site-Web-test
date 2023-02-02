<?php

require_once('../../includes/header.php');
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/e_commerce/ECOMMERCE/config/pdo.php';
// on récupère les catégories existantes de la BBD
if(!$_SESSION['user_id']){
    header('location: ../index.php');
}

$requete = $pdo->query("SELECT * FROM categorie");
$categories = $requete->fetchAll(PDO::FETCH_ASSOC);



?>

<?php if (count($categories) > 0) { ?>
    <div id='main' class="border border-dark-subtle bg-dark">

        <table class="table bg-dark text-white border border-0"">
                <thead>
                    <tr>
                        <th scope=" col" class="border border-0">#</th>
            <th scope="col" class="border border-0">Nom</th>
            <th scope="col" class="border border-0">Actions</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $categorie) { ?>
                    <tr>
                        <th scope="row" class="border border-0"><?php echo $categorie['id_categorie']; ?></th>
                        <td class="border border-0""><?php echo $categorie['nom']; ?></td>
                            <td class=" border border-0">
                            <a href="modify.php?id_categorie=<?php echo $categorie['id_categorie']; ?>"
                                class="btn btn-warning ">Modifier</a>
                            <a href="delete.php?id_categorie=<?php echo $categorie['id_categorie']; ?>"
                                class="btn btn-danger">Supprimer</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        

    <?php } else {
    echo "il n'y a pas de catégories actuellement";
}
?>

<p class="text-center bg-dark "><a href="create.php" class="btn btn-primary ">Create</a></p>

</div>

<?php

require_once('../../includes/footer.php');

?>