<?php

require_once('../../includes/header.php');
if(!$_SESSION['user_id']){
    header('location: ../index.php');
}

$requete = $pdo->query('SELECT * FROM slider');
$sliders = $requete->fetchAll(PDO::FETCH_ASSOC);



?>
<?php if (count($sliders) > 0) { ?>
<table class="table bg-dark text-white border border-0">
    <thead>
        <tr>
            <th scope="col" class="border border-0">ID</th>
            <th scope="col" class="border border-0">Nom</th>
            <th scope="col" class="border border-0">Titre</th>
            <th scope="col" class="border border-0">Description</th>
            <th scope="col" class="border border-0">Image</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($sliders as $slider) { ?>
            <tr>
                <th scope="row"><?php echo $slider['id_slider'] ?></th>
                <td>
                    <?php echo $slider['nom'] ?>
                </td>
                <td>
                    <?php echo $slider['titre'] ?>
                </td>
                <td><?php echo $slider['description'] ?></td>
                <td><img width="50" height="50" src="../../uploads/<?php echo $slider['image'];?>"></td>
                <td>Action</td>
                <td class="border border-0">
                    <a href="modify.php?id_slider=<?php echo $slider['id_slider']; ?>"
                        class="btn btn-warning ">Modifier</a>
                    <a href="delete.php?id_slider=<?php echo $slider['id_slider']; ?>"
                        class="btn btn-danger">Supprimer</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php } else {
    echo "<p class='text-center text-danger fs-2 text'> il n'y a pas de slider actuellement </p>";
}?>

<p class="text-center "><a href="create.php" class="btn btn-primary ">Create</a></p>
<?php



require_once('../../includes/footer.php');

?>


