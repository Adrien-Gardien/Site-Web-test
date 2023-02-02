<?php
require_once '../../includes/header.php';
$requete = $pdo->query("SELECT * FROM user");
$users = $requete->fetchAll(PDO::FETCH_ASSOC);
if(!$_SESSION['user_id']){
    header('location: ../index.php');
}

?>

<?php if (empty($_users['id_user'])) { ?>
    <div id='main'>
        <table class="table bg-dark text-white border border-0">
                                <thead>
                                    <tr>
                        <th scope=" col" class="border border-0">#</th>
            <th scope="col" class="border border-0">Nom</th>
            <th scope="col" class="border border-0">Prénom</th>
            <th scope="col" class="border border-0">Mail</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) { ?>
                    <tr>
                        <th scope="col"><?php echo $user["id_user"]; ?></th>
                        <th scope="col"><?php echo $user['nom']; ?></th>
                        <th scope="col"><?php echo $user["prenom"]; ?></th>
                        <th scope="col"><?php echo $user["email"]; ?></th>
                    </tr>
                <?php } ?>
            </tbody>
        </table>



    <?php } else {
    echo "il n'y a pas de catégories actuellement";
}
    ?>



    </div>

    <p class="text-center "><a href="create.php" class="btn btn-primary ">Create User</a></p>

    <?php
    require_once '../../includes/footer.php';
    ?>