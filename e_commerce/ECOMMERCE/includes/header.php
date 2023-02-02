<?php
session_start();

// require_once('\xampp\htdocs\php\e_commerce\ECOMMERCE\config\pdo.php');
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/e_commerce/ECOMMERCE/config/pdo.php';


// echo $_SERVER['DOCUMENT_ROOT'];

$requete = $pdo->query('SELECT * FROM categorie');
$categories = $requete->fetchAll(PDO::FETCH_ASSOC);

// echo '<pre>';
// print_r($categories);
// echo '</pre>';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>

    <!-- début de la nav -->
    <div id='nav' class='bg-secondary'  method="get">
        <nav class="navbar navbar-expand-lg bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="http://localhost/php/e_commerce/ECOMMERCE/">LP</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page"
                                href="http://localhost/php/e_commerce/ECOMMERCE/">Home</a>
                        </li>
                        <?php foreach ($categories as $categorie) { ?> >
                            <li class="nav-item">
                                <a class="nav-link text-white"
                                    href="categories.php?id_categorie=<?php echo $categorie['id_categorie']; ?>">
                                    <?php echo $categorie['nom'] ?>
                                </a>
                            </li>
                        <?php } ?>
                        <li class="nav-item mx-5 ">
                            <a class="nav-link text-danger"
                                href="/php/e_commerce/ECOMMERCE/admin/index.php">Admin</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search"  method="get" action="http://localhost/php/e_commerce/ECOMMERCE/search.php">
                        <input class="form-control me-2 bg-dark text-white mx-2" type="search" placeholder="Search" name="search"
                            aria-label="Search">
                        <button class="btn btn btn-dark mx-3" type="submit">Search</button>
                    </form>
                    <?php if (isset($_SESSION['user_id'])) { ?> <a href="http://localhost/php/e_commerce/ECOMMERCE/admin/user/logout.php" class="text-white btn btn-danger me-3">   Déconnexion</a><p class="mt-2 my-1 text-white"><?php echo '   '.$_SESSION['nom'],' ', $_SESSION['prenom']?></p>
                        <?php } else { ?> <a href="http://localhost/php/e_commerce/ECOMMERCE/admin/index.php" class="text-white btn btn-success">Connexion</a>
                            <?php } ?>
                </div>
            </div>
        </nav>
    </div>
    <!-- fin de la nav -->