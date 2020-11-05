<?php
include_once("ressources/php/dumper.php");
require_once ("ressources/php/bdd.php");

spl_autoload_register(
    function ($class)
    {
        include 'ressources/php/' . $class . '.php';
    }
);

$userManager = new UserManager($db);

echo "This form enable you to create an user, so you can submit new geopoint. <br/>";

if (isset($_POST["username"]) and isset($_POST["password"])){
    echo "creating account.";

    if ( $userManager->exist($_POST["username"]) ){
        # perso exist, error.
    }
    else{
        #perso do not exist, creating it.
        $username = htmlspecialchars($_POST["username"]) ;
        $password = htmlspecialchars($_POST["password"]) ;

        $user = new User(array('username' => $username, 'password' => $password, 'admin' => 0 ));
        Dumper($user);
        Dumper($user->isAdmin() );
        $userManager->add($user);




    }



}
else{

    echo '<META HTTP-EQUIV="refresh" content="0;URL=./create-user.html">';
}

?>

