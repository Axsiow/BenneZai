<?php
session_start();

include_once("ressources/php/dumper.php");
require_once("ressources/php/bdd.php");

spl_autoload_register(
    function ($class) {
        include 'ressources/php/' . $class . '.php';
    }
);

$userManager = new UserManager($db);

if (!isset($_POST["username"]) and !isset($_POST["password"])){
    echo '<META HTTP-EQUIV="refresh" content="0;URL=./create-user.html">';

}
else{
    $username = htmlspecialchars($_POST["username"]) ;
    $password = htmlspecialchars($_POST["password"]) ;
    $user = $userManager->getAuthenticatedUser($username, $password);

    if (false == $user ){
        echo '<META HTTP-EQUIV="refresh" content="0;URL=./create-user.html?">';
    }

    echo "you are now logged in, you can submit a new point. <br/>";
    Dumper($user);
    $_SESSION['username'] = $user->getUsername();
    $_SESSION['admin'] = $user->isAdmin();
    echo '<META HTTP-EQUIV="refresh" content="0;URL=./AddPoint.php?">';


}
