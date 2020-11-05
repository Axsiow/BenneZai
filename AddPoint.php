<?php
session_start();

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
    <form action="/AddPoint.php" method="post">
        <input type="text" placeholder="Entrer la longitude" name="long" required>
        <input type="text" placeholder="Entrer la latitude" name="lat" required>

        <label for="category">Choisisez une catégorie</label>

        <select name="Category" id="Category">
            <?php
            # add category

            foreach($categoryList as $key => $category)
            {

                Dumper($category->getName());
                echo '<option value="' . $category->getName(). '">'. $category->getName() . '</option>';
            }

            ?>
        </select>
        <input type="submit" value="soumettre ces coordonées" name="button">
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





