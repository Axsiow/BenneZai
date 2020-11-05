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

        <label for="pet-select">Choisisez une catégorie</label>

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
else{
    echo "ngfeifbeiubfue";
}





