 <?php
    require 'includes/header.php';

    $requete = $pdo->query('SELECT * FROM product');
    $products = $requete->fetchAll(PDO::FETCH_ASSOC);

    $requete_slider = $pdo->query('SELECT * FROM slider');
    $sliders = $requete_slider->fetchAll(PDO::FETCH_ASSOC);

    $requete_blog = $pdo->query('SELECT * FROM blog');
    $blogs = $requete_blog->fetchAll(PDO::FETCH_ASSOC);



    ?>


 <!-- début du bloc main -->
 <div id="main">

     <!-- début du carousel -->
     <div id="carouselExampleCaptions" class="carousel slide">
         <div class="carousel-indicators">
             <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
             <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
             <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
         </div>

         <div class="carousel-inner">
             <?php foreach ($sliders as $slider) { ?>
                 <div class="carousel-item active">

                     <img src="./uploads/<?php echo $slider['image']; ?>" class="d-block w-100" alt="...">
                     <div class="carousel-caption d-none d-md-block text-secondary">
                         <h5><?php echo $slider['nom']; ?></h5>
                         <p><?php echo $slider['titre']; ?></p>
                     </div>

                 </div>
             <?php  } ?>
         </div>
         <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button> 
     </div>

     <!-- fin du carousel -->

     <!-- bloc de présentation -->

     <div class='container-fluid'>
         <div class='row'>
             <div class='col-12 col-sm-6 col-md-4 col-lg-4'>
                 <img src="./assets/img/3blocks/bner1.jpg" alt="" class='img-fluid'>
             </div>
             <div class='col-12 col-sm-6 col-md-4 col-lg-4'>
                 <h2 class='text-center mt-2'>Hottest Collection</h2>
                 <br>
                 <p class='text-center mt-5'>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                     A distinctio natus amet, officia ratione inventore! Nobis magnam consequatur placeat esse magni!
                     In vitae magni recusandae!
                     Assumenda sint eligendi id numquam?</p>
             </div>
             <div class='col-12 col-sm-6 col-md-4 col-lg-4'>
                 <img src="./assets/img/3blocks/bner2.jpg" alt="" class='img-fluid'>
             </div>
         </div>
     </div>
     <!-- fin du bloc présentation -->

     <!-- début du bloc populaire -->
     <div id='populaire'>
         <div class='container'>
             <div class='row'>
               
                 <div class='col'>
                     <h2 class='text-center mt-5'>  </h2>
                     <p class='text-center mt-3'>  </p>
                 </div>
             </div>
          
         </div>
     </div>
     <!-- fin du bloc populaire -->


     <!-- début du bloc card -->
     <div class='container'>

         <div class='row'>
             <?php foreach ($products as $product) { ?>
                 <div class="card col-12 col-sm-6 col-md-4 col-lg-4 text-center m-3" style="width: 18rem;">
                     <img src="./uploads/<?php echo $product['image'] ?>" class="card-img-top" alt="...">
                     <div class="card-body">
                         <h5><?php echo $product['nom'] ?></h5>
                         <p class="card-text"><?php echo $product['description'] ?></p>
                     </div>
                 </div>
             <?php } ?>
             <!-- </div>
                <div class="card col-12 col-sm-6 col-md-4 col-lg-4 text-center m-3" style="width: 18rem;">
                    <img src="./assets/img/produits/lunette2.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5>aaa</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                    </div>
                </div>
                <div class="card col-12 col-sm-6 col-md-4 col-lg-4 text-center m-3" style="width: 18rem;">
                    <img src="./assets/img/produits/lunette3.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5>aaa</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                    </div>
                </div>
                <div class="card col-12 col-sm-6 col-md-4 col-lg-4 text-center m-3" style="width: 18rem;">
                    <img src="./assets/img/produits/lunette4.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5>aaa</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                    </div> -->
         </div>
         <!-- <div class="card col-12 col-sm-6 col-md-4 col-lg-4 text-center m-3" style="width: 18rem;">
                    <img src="./img/produits/lunette5.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5>aaa</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                    </div>
                </div> -->
         <!-- <div class="card col-12 col-sm-6 col-md-4 col-lg-4 text-center m-3" style="width: 18rem;">
                    <img src="./img/produits/lunette6.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5>aaa</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                    </div> -->
     </div>
 </div>
 </div>
 <!-- fin du bloc card -->

 <!-- fin du bloc populaire -->


 <!-- début du blog -->

 <div id='blog'>
     <div class='container mt-5'>
         <div class='row'>
             <div class='col'>
                 <h2 class='text-center mt-2'>Hottest Collection</h2>
                 <br>
                 <p class='text-center mt-5'>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                     A distinctio natus amet, officia ratione inventore! Nobis magnam consequatur placeat esse
                     magni!
                     In vitae magni recusandae!
                     Assumenda sint eligendi id numquam?</p>
             </div>
         </div>
     </div>
 </div>
 <!-- fin du blog -->


 <!-- Début du card group -->

 <div class='container'>
     <div class="card-group row">
     <?php foreach($blogs as $blog) {?>
         <div class="card col-12 col-sm-6 col-md-4 col-lg-4 text-center m-3">
             <img src="./uploads/<?php echo $blog['image']?>" class="card-img-top" alt="...">
             <div class="card-body">
                 <h5 class="card-title"><?php echo $blog['titre']?></h5>
                 <p class="card-text"><?php echo $blog['description']?></p>
                 <p class="card-text"><small class="text-muted"><?php echo $blog['date_de_publication']?></small></p>
             </div>
         </div>
         <!-- <div class="card col-12 col-sm-6 col-md-4 col-lg-4 text-center m-3">
             <img src="./assets/img/blog/lunettes3.jpg" class="card-img-top" alt="...">
             <div class="card-body">
                 <h5 class="card-title">Card title</h5>
                 <p class="card-text">This card has supporting text below as a natural lead-in to
                     additional content.</p>
                 <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
             </div>
         </div>
         <div class="card col-12 col-sm-6 col-md-4 col-lg-4 text-center m-3">
             <img src="./assets/img/blog/lunettes4.jpg" class="card-img-top" alt="...">
             <div class="card-body">
                 <h5 class="card-title">Card title</h5>
                 <p class="card-text">This is a wider card with supporting text below as a natural
                     lead-in to additional content. This card has even longer content than the first to
                     show that equal height action.</p>
                 <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
             </div>
         </div> -->
         <?php } ?>
     </div>
     
 </div>

 <!-- fin du card group -->

 </div>
 <!-- fin du bloc main -->

 <?php
    require 'includes/footer.php';

    ?>