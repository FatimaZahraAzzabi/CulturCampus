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



$select = mysqli_query($conn, "SELECT * FROM news");
                                while($row = mysqli_fetch_assoc($select)){ 

                                $image = $row['image'];
                                $date = $row['date_debut'];
                                $title = $row['titre'];
                                $description = $row['description'];
                                $nomUser=$row['user'];
								
								echo $title;
								}
								

//echo $conn;


      // Requête SQL avec des paramètres préparés pour éviter les injections SQL
      $sql = "INSERT INTO `news` (`titre`, `description`, `date_debut`, `date_fin`, `image`, `user`, `visibility`) 
	          VALUES ('fff', 'fff', '2024-05-31', '2024-05-31', 'khhhg', 'ffff', '1')";
      $query = mysqli_query($conn, $sql);

 if ($query) {
         echo '<script>alert("News ajoutée avec succès.");</script>';
         echo '<script>window.location.href = "afficher_news.php";</script>'; // Redirection après l'ajout
         exit();
      } else {
         echo '<script>alert("Erreur lors de l\'ajout de la news. Veuillez réessayer.");</script>';
		  
	  }
?>