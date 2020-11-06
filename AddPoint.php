<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SEO Meta Tags -->
    <meta name="description" content="BenneZaï, est un projet qui a vu le jour en novembre 2020, autour d'un projet étudiant regroupant des étudiants web marketings et d'autres en ingénieries informatiques, nous avons eu envie de mettre en place ce projet pour sensibiliser les personnes vers le recyclage et le tri, ce qui important dans notre société actuelle.">
    <meta name="author" content="WIS3 / EPSI B3">
    
    <!-- Webpage Title -->
    <title>Vérification de la connexion à BenneZaï</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <link href="ressources/css/bootstrap.css" rel="stylesheet">
    <link href="ressources/css/swiper-bundle.min.css" rel="stylesheet">
    <link href="ressources/css/magnific-popup.css" rel="stylesheet">
    <link href="ressources/css/styles.css" rel="stylesheet">
	<link href="ressources/css/form.css" rel="stylesheet">
    <link href="ressources/css/slider.css" rel="stylesheet">
	<script src="https://kit.fontawesome.com/cc38370118.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@700&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="ressources/css/keske.css">

    <!-- Favicon  -->
    <link rel="icon" href="ressources/icons/favicon.png">
</head>
<body data-spy="scroll" data-target=".fixed-top">



<!-- Header -->
<header id="commentCaMarche" class="cd-header">
    <div id="cd-logo"><a id="btn1" href="index.html#skill">Atouts</a></div>
</header>

<section id="cd-intro">
    <div id="cd-intro-tagline">
        <a href="index.html#maps" class="cd-btn">Maps</a>
        <img src="ressources/icons/Logo_blanc.png" class="logoBenneZai" alt="">
    </div>
</section>

<div class="cd-secondary-nav" style="position: absolute;left: -200px;">
    <nav>
        <ul>
            <li>
                <a href="#commentCaMarche" id="scrollTop" style="opacity: 0">
                    <img src="ressources/icons/Logo_Z_blanc.png" class="logoBenneZ" alt="">
                </a>
            </li>
        </ul>
    </nav>
</div>
<!-- end of Header -->

<!-- inscription / connexion -->
<div class="container first-container container-form">
    <?php


        include_once("ressources/php/dumper.php");
        require_once("ressources/php/bdd.php");

        spl_autoload_register(
            function ($class) {
                include 'ressources/php/' . $class . '.php';
            }
        );

        $user = $_SESSION['username'];

        if (!isset($user)){
            echo 'user not authenticated ! ';
            echo '<META HTTP-EQUIV="refresh" content="0;URL=./create-user.html">';
        }


        if (!isset($_POST['long']) or !isset($_POST['long'])){
            $categoryManager = new CategoryManager($db);
            $categoryList = $categoryManager->getAllCategory();

            ?>
            <form class="form1" action="/AddPoint.php" method="post">
                <p class="thadd">Entrez les coordonées</p>
                <input type="text" class="butsub" placeholder="Entrer la longitude" name="long" required>
                <input type="text" class="butsub" placeholder="Entrer la latitude" name="lat" required>

                <label class="thadd" for="category">Choisisez une catégorie</label>

                <select class="butcat" name="Category" id="Category">
                    <?php
                    # add category

                    foreach($categoryList as $key => $category)
                    {

                        Dumper($category->getName());
                        echo '<option value="' . $category->getName(). '">'. $category->getName() . '</option>';
                    }

                    ?>
                </select>
                <input type="submit" class="butsub butverif" value="soumettre ces coordonées" name="button">
            </form>

          <?php
        }
        else
        {
            $longitude = htmlspecialchars($_POST['long']);
            $latitude = htmlspecialchars($_POST['lat']);
            $category = htmlspecialchars($_POST['Category']);  # TODO : check category exist before using it.

            if (!is_numeric($longitude) or !is_numeric($latitude))
            {
                # Error, redirect to the same page with an GET variable.
                echo '<META HTTP-EQUIV="refresh" content="0;URL=./AddPoint.php?Error=NotANumber">';
            }
            elseif(!('-180' <= $longitude) or !($longitude <= '180') or !('-90' <= $latitude) or !($latitude <= '90') ){
                echo '<META HTTP-EQUIV="refresh" content="0;URL=./AddPoint.php?Error=OutOfRange">';
            }
            else{
                $geopointManager = new GeopointManager($db);
                $geopoint = new Geopoint(array('longitude' => $longitude, 'latitude' => $latitude, 'category' => $category, 'username' => $_SESSION['username']));

                $geopointManager->add($geopoint);
                echo "Merci d'avoir aidé la communauté à maintenir les données à jour";



            }
        }

     ?>
</div>
<!-- end of inscription / connexion -->

<!-- Footer -->
<div class="footer bg-dark-blue">
    <div class="container">
        <div class="row">
            <div class="col-lg-6" >
                <h6>À propos de BenneZaï</h6>
                <p class="p-small f-text">Benne Zaï, est un projet qui a vu le jour en novembre 2020, autour d'un projet étudiant regroupant des étudiants web marketings et d'autres en ingénieries informatiques, nous avons eu envie de mettre en place ce projet pour sensibiliser les personnes vers le recyclage et le tri, ce qui est important dans notre société actuelle.</p>
            </div> <!-- end of footer-col -->
            <div class="col-lg-6 benne-footer">
                <p class="p-small p-mail">Mail : <a href="mailto:contact@bennezai.fr"><strong>contact@bennezai.fr</strong></a></p>
                <p class="p-small">Créé avec ❤️️ à Grenoble, France 🗻 <br>Copyright © <a href="ressources/images/bac_jaune_gpso (1).jpg">Benne Zaï</a></p>
                <div>
                    <span class="fa-stack">
                        <a href="https://www.instagram.com/bennezai_grenoble/" target="_blank">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fab fa-instagram fa-stack-1x"></i>
                        </a>
                    </span>
                    <span class="fa-stack">
                        <a href="https://www.facebook.com/BenneZa%C3%AF-114952277079634" target="_blank">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fab fa-facebook-f fa-stack-1x"></i>
                        </a>
                    </span>
                </div>
            </div> <!-- end of footer-col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of footer -->
<!-- end of footer -->

<script src="ressources/js/form.js"></script>
<script src="ressources/js/jquery.min.js"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
<!-- Scripts -->
<script src="ressources/js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
<script src="ressources/js/jquery.easing.min.js"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
<script src="ressources/js/swiper-bundle.min.js"></script> <!-- Swiper for image and text sliders -->
<script src="ressources/js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
<script src="ressources/js/morphext.min.js"></script> <!-- Morphtext rotating text in the header -->
<script src="ressources/js/validator.min.js"></script> <!-- Validator.js - Bootstrap plugin that validates forms -->
<script src="ressources/js/scripts.js"></script> <!-- Custom scripts -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="ressources/js/jquery.min.js"></script>
<script src="ressources/js/main.js"></script>
<script src="ressources/js/modernizr.js"></script>
</body>
</html>
