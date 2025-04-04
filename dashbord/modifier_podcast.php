<?php

@include '../conn_db.php';

$id_podcast = $_GET['edit'];

ini_set('upload_max_filesize', '100M');

if(isset($_POST['update_podcast'])){

   $nom_podcast = $_POST['nom_podcast'];
   $enregistrer_par = $_POST['enregistrer_par'];
   $description = $_POST['description'];

   // Vérifier si un fichier audio a été téléchargé
   if(isset($_FILES['audio']['name']) && !empty($_FILES['audio']['name'])) {
       $audio = $_FILES['audio']['name'];
       $audio_tmp_name = $_FILES['audio']['tmp_name'];
       $podcast_audio_folder = '../audios/podcast_audio/'.$audio;
   }


   
   // Vérifier si un fichier image a été téléchargé
   if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
       $image = $_FILES['image']['name'];
       $image_tmp_name = $_FILES['image']['tmp_name'];
       $podcast_image_folder = '../img/podcast_img/'.$image;
   }

   if(empty($nom_podcast) || empty($enregistrer_par) || empty($description)){
      $message[] = 'Please fill out all fields';
   }
   else{
      // Mettre à jour la base de données avec les nouveaux fichiers s'ils ont été téléchargés
      if(isset($audio) && isset($image)) {
          $update_data = "UPDATE podcast SET nom_podcast='$nom_podcast', enregistrer_par='$enregistrer_par',audio= '$audio', description='$description', image='$image' WHERE id_podcast = '$id_podcast'";
      } elseif(isset($audio)) {
          $update_data = "UPDATE podcast SET nom_podcast='$nom_podcast', enregistrer_par='$enregistrer_par',audio= '$audio', description='$description' WHERE id_podcast = '$id_podcast'";
      } elseif(isset($image)) {
          $update_data = "UPDATE podcast SET nom_podcast='$nom_podcast', enregistrer_par='$enregistrer_par', description='$description', image='$image' WHERE id_podcast = '$id_podcast'";
      } else {
          $update_data = "UPDATE podcast SET nom_podcast='$nom_podcast', enregistrer_par='$enregistrer_par', description='$description' WHERE id_podcast = '$id_podcast'";
      }

      $upload = mysqli_query($conn, $update_data);

      if($upload){
         // Télécharger les fichiers audio et image si nécessaire
         if(isset($audio)) {
             move_uploaded_file($audio_tmp_name, $podcast_audio_folder);
         }
         if(isset($image)) {
             move_uploaded_file($image_tmp_name, $podcast_image_folder);
         }
         echo '<script>alert(" podcast modifer avec succès "); window.location.href = "podcast_ad.php";</script>';
      } else {
         echo '<script>alert(" An error occurred! "); window.location.href = "podcast_ad.php";</script>';

      }

   }
};
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
      <title>Cultur Campus | Modifier Podcast</title>
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
                              <h2>Modifier Podcast</h2>
                             
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

                             <?php
      $select = mysqli_query($conn, "SELECT * FROM podcast WHERE id_podcast = '$id_podcast'");
      while($row = mysqli_fetch_assoc($select)){
 ?>
                                <form action="" method="post" enctype="multipart/form-data">
                                   <fieldset>
                                      <div class="field">
                                         <label class="label_field">Nom</label>
                                         <input type="text" name="nom_podcast" value="<?php echo $row['nom_podcast']; ?>" placeholder="nom du podcast" />
                                      </div>
                                      <div class="field">
                                         <label class="label_field">Enregistrer par</label>
                                         <input type="text" name="enregistrer_par" value="<?php echo $row['enregistrer_par']; ?>" placeholder="enregistrer par" />
                                      </div>
                                    

                                      <div class="field">
                                        <label class="label_field">Audio</label>
                                        <input type="file" name="audio" value="<?php echo $row['audio']; ?>" accept="audio/*" />
                                    </div>

                    
                                    
                                     <div class="field">
                                        <label class="label_field">Image</label>
                                        <input type="file" id="image" value="" name="image" accept="image/*">
                                     </div>
                                     <div class="field">
                                        <label class="label_field">Description</label>
                                        <textarea name="description" value="" placeholder="Description du podcast"><?php echo $row['description']; ?></textarea>
                                     </div>
                                     <div class="field margin_0">
                                        <label class="label_field hidden">hidden label</label>
                                        <button class="main_bt" name="update_podcast">Modifier le podcast </button>
                                     </div>
                                    
                                   </fieldset>
                                </form>
                                <?php }; ?>

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