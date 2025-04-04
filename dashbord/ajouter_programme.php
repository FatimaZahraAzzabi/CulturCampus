<?php
session_start();
include '../conn_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
   // $uploadDir = 'img/programme_images/';
   // $uploadFile = $uploadDir . basename($_FILES['imageUpload']['name']);

   $imageUpload = $_FILES['imageUpload']['name'];
   $image_tmp_name = $_FILES['imageUpload']['tmp_name'];
   $uploadDir = '../img/programme_images/' .$imageUpload;

   
   $titre = mysqli_real_escape_string($conn, $_POST["titre"]);
   $desc = mysqli_real_escape_string($conn, $_POST["description"]);
   // $nbr_episodes = mysqli_real_escape_string($conn, $_POST["nbr"]);
   $categorie= mysqli_real_escape_string($conn, $_POST["cat"]);
   $enregistre_par= mysqli_real_escape_string($conn, $_POST["user"]);
   $id_admin=$_SESSION['id'];
   // $sql2="INSERT INTO programme ()";
   // $query2 = mysqli_query($conn, $sql2);
   // $rows=mysqli_fetch_assoc($query2);
   // $nomUser=@$rows['nom'].' ' .@$rows['prenom'];

   

   // Déplacer le fichier téléchargé vers le répertoire de destination
   if (move_uploaded_file( $image_tmp_name, $uploadDir)) {
      // Requête SQL avec des paramètres préparés pour éviter les injections SQL
      $sql = "INSERT INTO programme (titre_programme, description_programme,enregistre_par, image_prog/*,nbr_episodes*/,category,visibility) VALUES ('$titre', '$desc','$enregistre_par', '$imageUpload'/*, '$nbr_episodes'*/,'$categorie','1')";
      $query = mysqli_query($conn, $sql);

      if ($query) {
         echo '<script>alert("programme ajoutée avec succès.");</script>';
         echo '<script>window.location.href = "programmes.php";</script>'; // Redirection après l'ajout
         exit();
      } else {
         echo '<script>alert("Erreur lors de l\'ajout de programme. Veuillez réessayer.");</script>';
      }
   } else {
      echo '<script>alert("Une erreur s\'est produite lors du téléchargement du fichier.");</script>';
   }
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
      <title>Cultur Campus | ajouter programme</title>
      <!-- Favicon -->
	<link href="images/logo/logo_icon.jpeg" rel="shortcut icon"/>
  
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- site icon -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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

                  <!-- end top bar -->
                  
                 <div class="full_container">
                     <div class="row column_title">
                        <div class="col-md-12">
                           <div class="page_title">
                              <br><br>
                              <h2>Ajouter Programme</h2>
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
                                         <label class="label_field">Nom</label>
                                         <input type="text" name="titre" placeholder="nom du programme" />
                                      </div>

                                      <div class="field">
                                        <label class="label_field"><i class="fas fa-user purple_color2" ></i> </label>
                                        <input type="text" name="user" placeholder="Enregistré par ......" />
                                     </div>
                                      
                                      <!-- <div class="field">
                                        <label class="label_field">Nombre</label>
                                        <input type="number" name="nbr" placeholder="le nombre des épisodes" />
                                     </div> -->
                                     
                                    
                                     <div class="field">
                                        <label class="label_field">Image</label>
                                        <input type="file" id="imageUpload" name="imageUpload" accept="image/*">
                                     </div>

                                     <div class="field">
                                        <label class="label_field">Catégorie</label>
                                        <input type="text" name="cat" placeholder="la Catégorie du programme" />
                                     </div>

                                     <div class="field">
                                        <label class="label_field">Description</label>
                                        <textarea name="description" placeholder="Description du news"></textarea>
                                     </div>
                                     <div class="field margin_0">
                                        <label class="label_field hidden">hidden label</label>
                                        <button type ="submit" name="submit" class="main_bt">Ajouter le progoramme </button>
                                     </div>
                                      <!-- <div class="field">
                                         <label class="label_field hidden">hidden label</label>
                                         <label class="form-check-label"><input type="checkbox" class="form-check-input"> Remember Me</label>
                                         <a class="forgot" href="">Mot de passe oublié?</a>
                                      </div>
                                      <div class="field margin_0">
                                         <label class="label_field hidden">hidden label</label>
                                         <button class="main_bt">Se connecter</button>
                                      </div> -->
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