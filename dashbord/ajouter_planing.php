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
      <title>Cultur Campus | ajouter Planing</title>
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
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.6/flatpickr.min.css">

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
               
               <!-- code php pour ajoute -->
               <?php

@include '../conn_db.php';

if(isset($_POST['add_planing'])){

   $nom = $_POST['nom'];
   $type = $_POST['type'];
   $date = $_POST['date'];
   $image = $_FILES['image']['name'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $planing_image_folder = '../img/planing_img/'.$image;

   if(empty($nom) || empty($type) || empty($date)|| empty($image)){
      $message[] = 'please fill out all';
   }else{
      $insert = "INSERT INTO grille_programme(nom, type,date, image, visibility) VALUES('$nom', '$type', '$date', '$image','1')";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($image_tmp_name, $planing_image_folder);

         $message[] = 'New planing added successfully';
         echo '<script>alert("Nouveau planing ajouté avec succès "); window.location.href = "planing.php";</script>';

      }else{
         $message[] = 'could not add the planing';
         echo '<script>alert("impossible d\'ajouter le planing"); window.location.href = "planing.php";</script>';

      }
   }

};



?>

                  <div class="full_container">
                     <div class="row column_title">
                        <div class="col-md-12">
                           <div class="page_title">
                              <br><br>
                              <h2>Ajouter Planing</h2>
    <?php                          
if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}  ?>
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
                                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                                   <fieldset>
                                      <div class="field">
                                         <label class="label_field">Nom </label>
                                         <input type="text" name="nom" placeholder="nom du planing" />
                                      </div>
                                     
                                      <div class="field">
                                      <label class="label_field" for="type"> type :</label>
                                       <select class="label_field" id="type" name="type" class="form-control">
                                          <option value="podcast">Podcast</option>
                                          <option value="programme">Programme</option>
                                          <option value="episode">Episode</option>
                                       </select>  </div>
                                    
                    
                                    
                                     <div class="field">
                                        <label class="label_field">Image</label>
                                        <input type="file" id="imageUpload" name="image" accept="image/*">
                                     </div>
                                     <div class="field">
                                       <label class="label_field" for="dateHeure">Date et heure:</label>
                                       <input type="text" id="dateHeure" name="date" required readonly>
                                      </div>
                                      <!-- Script pour utiliser Flatpickr pour sélectionner la date et l'heure -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.6/flatpickr.min.js"></script>
<script>
    flatpickr("#dateHeure", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    });
    document.getElementById("selectDateHeure").onclick = function() {
        document.getElementById("dateHeure").click();
    };
</script>
                                     <div class="field margin_0">
                                        <label class="label_field hidden">hidden label</label>
                                        <button class="main_bt" name="add_planing">Ajouter le planing </button>
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