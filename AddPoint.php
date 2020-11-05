<?php
session_start();

$user = $_SESSION['username'];
if (!isset($user)){
    echo 'user not authenticated ! ';
    echo '<META HTTP-EQUIV="refresh" content="0;URL=./create-user.html">';
}

    echo $user . "<br/>";
if (!isset($_POST)){
    ?>
    <form action="/AddPoint.php" method="post">
        <input type="text" placeholder="Entrer la longitude" name="long" required>
        <input type="text" placeholder="Entrer la latitude" name="lat" required>

        <?php
        # add category


        ?>
        <input type="submit" value="soumettre ces coordonées" name="button">
    </form>

    <?php
}




