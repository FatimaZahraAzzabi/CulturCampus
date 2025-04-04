<?php
// la connexion avec la base de donnees 'cultur campus
$db_name="cultur_campus";
$server_name="localhost";
$user_name="phpmyadmin";
$password="Bums@Radio2025";

$conn=mysqli_connect($server_name,$user_name,$password,$db_name);
mysqli_set_charset($conn, "utf8");
if($conn){
    
}
else{
    echo "not connected";
}


?>