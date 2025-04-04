<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    // Redirigez vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: ../loginAdmin.php');
    exit();
}?>
<?php
// session_start();

include '../conn_db.php';

// Récupération de l'ID du programme si disponible dans l'URL
if(isset($_GET['id_pr'])) {
    $id_prog = $_GET['id_pr'];
} 

if($_SERVER["REQUEST_METHOD"] == "POST") {
   // Récupérer les autres données du formulaire
   $numero = $_POST['Num'];
   $nom_episode = $_POST['nom_episode'];
  // $duree = $_POST['dur'];
   $description = $_POST['description'];

   // Récupérer les fichiers
   $audioFile = $_FILES['audioFile'];
  // $imageFile = $_FILES['imageFile'];

   if(!is_numeric($numero) || (int)$numero <= 0) {
      echo '<script>alert("le numéro de l\'épisode doit être positif"); window.location.href = "ajouter_episode.php?id_pr='.$id_prog.'";</script>';
      exit();
  }

  $q = "SELECT MAX(num_episode) as last_episode FROM episodes WHERE id_programme = '$id_prog'";
  $res = mysqli_query($conn, $q);
  if($res) {
      $row4 = mysqli_fetch_assoc($res);
      if($numero <= $row4['last_episode']) {
         echo '<script>alert("le numéro de cette épisode doit être supérieure au numéro de l\'épisode précédente  "); window.location.href = "ajouter_episode.php?id_pr='.$id_prog.'";</script>';
         exit();
      }
  }


$sqlNbrEpisodes = "SELECT nbr_episodes FROM programme WHERE id_programme = '$id_prog'";
$resultNbrEpisodes = mysqli_query($conn, $sqlNbrEpisodes);

if ($resultNbrEpisodes) {
    $rowNbrEpisodes = mysqli_fetch_assoc($resultNbrEpisodes);
    $nbrEpisodes = $rowNbrEpisodes['nbr_episodes'];

    if ($numero > $nbrEpisodes) {
        echo '<script>alert("Le numéro de l\'épisode dépasse le nombre total d\'épisodes spécifié pour ce programme."); window.location.href = "ajouter_episode.php?id_pr='.$id_prog.'";</script>';
        exit();
    }
} 


   if($audioFile['error'] === UPLOAD_ERR_OK ) {
       // Déplacer le fichier audio
       $audioFile = $_FILES['audioFile']['name'];
       $audio_tmp_name = $_FILES['audioFile']['tmp_name'];
       $uploadAudioDir = '../audios/audios_episodes/' . $audioFile;

      //  $audioFileName =$uploadAudioDir . basename($_FILES['audioFile']['name']);
       move_uploaded_file($audio_tmp_name, $uploadAudioDir);

       // Déplacer le fichier image
      //  $uploadImageDir = '../img/episodes/';
      //  $imageFileName = basename($imageFile['name']);
      //  $uploadImageFilePath = $uploadImageDir . $imageFileName;
      //  move_uploaded_file($imageFile['tmp_name'], $uploadImageFilePath);

       // Insérer les données dans la base de données
       $sql = "INSERT INTO episodes (id_programme, num_episode,nom_episode,  description_episode,  audio, visibility,likes,listeners) VALUES ('$id_prog', '$numero','$nom_episode', '$description',  '$audioFile' ,'1','0','0')";
       if(mysqli_query($conn, $sql)) {
           echo '<script>alert("Épisode ajouté avec succès"); window.location.href = "episodes.php?id_pr='.$id_prog.'";</script>';
           exit();
       } else {
           echo "Erreur: " . mysqli_error($conn);
       }
   } else {
       echo "Erreur lors du téléchargement des fichiers.";
   }
}

$sql1 = "SELECT titre_programme FROM programme WHERE id_programme='$id_prog'";
$res = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_assoc($res); 
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
      <title>Cultur Campus | ajouter Episode</title>
      <!-- Favicon -->
	<link href="images/logo/logo_icon.jpeg" rel="shortcut icon"/>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
        .resizable-textarea {
            width: 100%;
            height: 100px;
            padding: 8px;
            box-sizing: border-box;
            resize: none; 
            overflow-y: auto; 
        }
    </style>
    
   </head>
   <body class="inner_page map">
      <div class="full_container">
         <div class="inner_container">
               <!-- Sidebar  -->
               <?php include 'sidebar.php'; ?>
             <!-- end sidebar -->
               <!-- right content -->
               <div id="content">
                  <!-- topbar -->
                  <?php include 'topbar.php'; ?>

                 <!-- end topbar -->

                  <div class="full_container">
                     <div class="row column_title">
                        <div class="col-md-12">
                           <div class="page_title">
                              <br><br>
                              <h2 style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
    Ajouter Episode dans le programme 
    <?php 
 
    ?>
    <span style="color:#0a92c0;"><?php echo $row1['titre_programme']; ?></span>
</h2>
                           </div>
                        </div>
                     </div>
                    <div class="container">
                       <div class="center verticle_center full_height">
                          <div class="login_section">
                             <div class="logo_login">
                                <div class="center">
                                   <img width="210" src="images/logo/logo.jpeg" style="height: 90px; width: 150px;" alt="#" />
                                </div>
                             </div>
                             <div class="login_form">
                             <form method="POST" action="" enctype="multipart/form-data">
                                   <fieldset>
                                      <div class="field">
                                         <label class="label_field">Numéro</label>
                                         <input type="number" name="Num" placeholder="saisir le numéro d'épisodes" required/>
                                      </div>
                                      <div class="field">
                                         <label class="label_field">Nom</label>
                                         <input type="text" name="nom_episode" placeholder="saisir le nom d'épisodes" required/>
                                      </div>
                                     
                                      
                                      <div class="field">
                                        <label class="label_field">Audio</label>
                                        <input type="file" name="audioFile" accept="audio/*" required />
                                    </div>

                    
                                    
                                   
                                     <div class="field">
                                        <label class="label_field">Description</label>
                                        <textarea name="description" placeholder="Description du podcast" required></textarea>
                                     </div>
                                     <div class="field margin_0">
                                        <label class="label_field hidden">hidden label</label>
                                        <button class="main_bt">Ajouter episode </button>
                                     </div>
                                     
                                   </fieldset>
                                </form>
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>
                 <script>
                    // Fonction pour ajuster la hauteur de la zone de texte en fonction du contenu
                    function ajusterHauteurTextarea(element) {
                        element.style.height = 'auto'; // Réinitialiser la hauteur à auto
                        element.style.height = (element.scrollHeight) + 'px'; // Ajuster la hauteur en fonction du contenu
                    }
                
                    // Ajouter un gestionnaire d'événement pour l'événement input
                    document.addEventListener('input', function(event) {
                        if (event.target && event.target.classList.contains('resizable-textarea')) {
                            ajusterHauteurTextarea(event.target);
                        }
                    });
                </script>

                
                
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
                 <script src="js/jquery.min.js"></script>
                 <script src="js/popper.min.js"></script>
                 <script src="js/bootstrap.min.js"></script>
                 <!-- wow animation -->
                 <script src="js/animate.js"></script>
                 <!-- select country -->
                 <script src="js/bootstrap-select.js"></script>
                 <!-- owl carousel -->
                 <script src="js/owl.carousel.js"></script> 
                 <!-- nice scrollbar -->
                 <script src="js/perfect-scrollbar.min.js"></script>
                 <!-- custom js -->
                 <script src="js/custom.js"></script>
                 <script src="js/custom.js"></script>
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- wow animation -->
      <script src="js/animate.js"></script>
      <!-- select country -->
      <script src="js/bootstrap-select.js"></script>
      <!-- owl carousel -->
      <script src="js/owl.carousel.js"></script> 
      <!-- nice scrollbar -->
      <script src="js/perfect-scrollbar.min.js"></script>
      <!-- custom js -->
      <script src="js/custom.js"></script>
      <!-- google map js -->
      <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8eaHt9Dh5H57Zh0xVTqxVdBFCvFMqFjQ&callback=initMap"></script> -->
      <!-- end google map js -->
   </body>
</html>