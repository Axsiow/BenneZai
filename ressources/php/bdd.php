<?php
$db = new PDO('mysql:host=db;dbname=bennezai', 'root', 'root-pass');

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // On émet une alerte à chaque fois qu'une requête a échoué.

