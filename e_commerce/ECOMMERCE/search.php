<?php

require_once('./includes/header.php');


if (isset($_GET['search']) and !empty($_GET['search'])) {
$recherche = htmlspecialchars($_GET['search']);
$allproduct = $pdo->query('SELECT * FROM product WHERE nom LIKE "%' . $recherche . '%" ORDER BY id_product DESC');

}


?>

<table class="table bg-dark text-white border border-0">
    <thead>
        <tr>
            <th scope="col" class="border border-0"><h2> Résultat de la recherche :</th>
        </tr>
    </thead>
    <tbody>
            <td><?php if($allproduct->rowCount() > 0) {
                while($product = $allproduct->fetch()) {
                    ?> <p class="text-center"> <h5><?php echo '- '.$product['nom']?> </h5> <?php echo $product['description'],' ' ?></p><img width="150" height="150" src="./uploads/<?php echo $product['image'];?>">
                     <button class="btn btn-secondary">Voir produit</button> 
                     <button class="btn btn-primary">Ajouter au panier</button>
                     <?php 
                }
            } else { ?>
                <p class='text-center text-danger' > Aucun produits trouvé</p>
          <?php  } ?>
          
          </td>
    </tbody>
</table>



<?php

require_once('./includes/footer.php');

?>

