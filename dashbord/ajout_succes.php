<?php
session_start();
include '../conn_db.php';

if (isset($_SESSION['id'])) {
    $id_Admin = $_SESSION['id'];
} else {
    die("ID de session manquant.");
}
$sql = "SELECT image, nom, prenom FROM users WHERE id='$id_Admin'";
$query = mysqli_query($conn, $sql);


if ($query) {
    // Récupérer les données de la première ligne de résultat
    $row = mysqli_fetch_assoc($query);
    $image = $row['image'];
    $nom = $row['nom'];
    $prenom = $row['prenom'];

   
   
} else {
    echo "Erreur : " . mysqli_error($conn);
}

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Cultur campus | Admin ajouté</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- site icon -->
      <link rel="icon" href="images/fevicon.png" type="image/png" />
      <!-- bootstrap css -->
      <link rel="stylesheet" href="css/bootstrap.min.css" />
      <!-- site css -->
      <link rel="stylesheet" href="style1.css" />
      <!-- responsive css -->
      <link rel="stylesheet" href="css/responsive.css" />
      <!-- color css -->
      <link rel="stylesheet" href="css/colors.css" />
      <!-- select bootstrap -->
      <link rel="stylesheet" href="css/bootstrap-select.css" />
      <!-- scrollbar css -->
      <link rel="stylesheet" href="css/perfect-scrollbar.css" />
      <!-- custom css -->
      <link rel="stylesheet" href="css/custom.css" />
      <!-- calendar file css -->
      <link rel="stylesheet" href="js/semantic.min.css" />
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <style>
    .error_icon img {
        display: block;
        margin: 0 auto; 
        height: 100px; 
        width: 100px; 
        border-radius: 50%; 
        /* object-fit: cover;  */
                     }
</style>
   </head>
   <body class="inner_page error_404">
      <div class="full_container">
         <div class="container">
            <div class="center verticle_center full_height">
               <div class="error_page">
                  <div class="center">
                     <div class="error_icon">
                     <img class="img-responsive" src="<?php echo $image; ?>" style="height: 300px; width: 400px;" alt="Photo de profil">
                     </div>
                  </div>
                  <br>
                  <h3>L'Admin <?php echo $nom.' '.$prenom; ?> ajouté avec succès !</h3>
                  <P></P>
                  <div class="center"><a class="main_bt" href="index.php">allez à la page index </a></div>
               </div>
            </div>
         </div>
      </div>
      <!-- jQuery -->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- wow animation -->
      <script src="js/animate.js"></script>
      <!-- select country -->
      <script src="js/bootstrap-select.js"></script>
      <!-- nice scrollbar -->
      <script src="js/perfect-scrollbar.min.js"></script>
      <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script>
      <!-- custom js -->
      <script src="js/custom.js"></script>
   </body>
</html>