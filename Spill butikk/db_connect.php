<?php

$hostname = "localhost:3307";
$user = "Spill";
$password = "123";
$db = "spill_butikk";

$lenke = mysqli_connect($hostname, $user, $password, $db) or die('Could not connect to databasehost');

?>