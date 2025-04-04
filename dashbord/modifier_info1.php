<?php
session_start();
include '../conn_db.php';

// Vérifier si l'ID de l'actualité à modifier est passé via l'URL


    // Récupérer les détails de l'actualité à modifier depuis la base de données
    $sql = "SELECT * FROM info WHERE id_programme = '2'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
      $lien_linkedin = $row['lien_linkedin'];
      $lien_pintrest = $row['lien_pintrest'];
      $lien_youtube = $row['lien_youtube'];
      $text1 = $row['text1'];
      $text2 = $row['text2'];
      $about = $row['about'];
      $fax = $row['fax'];
      $email = $row['email'];
      $adresse = $row['adresse'];
      $maps = $row['maps'];
      $logo = $row['logo'];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $lien_linkedin = mysqli_real_escape_string($conn,$_POST['lien_linkedin']);
            $lien_pintrest = mysqli_real_escape_string($conn,$_POST['lien_pintrest']);
            $lien_youtube = mysqli_real_escape_string($conn,$_POST['lien_youtube']);
            $text1 =mysqli_real_escape_string($conn, $_POST['text1']);
            $text2 = mysqli_real_escape_string($conn,$_POST['text2']);
            $about = mysqli_real_escape_string($conn,$_POST['about']);
            $fax = mysqli_real_escape_string($conn,$_POST['fax']);
            $email = mysqli_real_escape_string($conn,$_POST['email']);
            $adresse = mysqli_real_escape_string($conn,$_POST['adresse']);
            $maps = mysqli_real_escape_string($conn,$_POST['maps']);

            if(empty($_FILES['logo']['name'])){
                $uploadFile=$logo;
            }
            
            else{
            
            $uploadDir = '../img/';
            $uploadFile = $uploadDir . basename($_FILES['logo']['name']);
            move_uploaded_file($_FILES['logo']['tmp_name'], $uploadFile);
            $uploadFile = mysqli_real_escape_string($conn, $uploadFile);}
            $updateSql =  "UPDATE info SET lien_fb ='$lien_fb ', 
            lien_linkedin='$lien_linkedin', lien_pintrest='$lien_pintrest',lien_youtube='$lien_youtube',
            text1='$text1',text2='$text2',fax='$fax',email='$email',about='$about'
            , adresse='$adresse',maps='$maps',logo='$uploadFile'  WHERE id_info = '2'";
            $updateResult = mysqli_query($conn, $updateSql);
        
                if ($updateResult) {
                    echo '<script>alert("programme modifiée avec succès.");</script>';
                    echo '<script>window.location.href = "programmes.php";</script>'; // Redirection après l'ajout
                    exit();
                } else {
                    echo '<script>alert("Erreur lors de la modification du programme. Veuillez réessayer.");</script>';
                }
            
        }}
    
        // Afficher le formulaire de modification avec les données existantes pré-remplies
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
      <title>Cultur Campus | Modifier news</title>
      <!-- Favicon -->
	<link href="images/logo/logo_icon.jpeg" rel="shortcut icon"/>
        <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- site icon -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        /* Style pour ajuster la taille de la zone de texte */
        .field textarea {
            width: 70%; 
            height: 150px; 
            padding: 8px; 
            box-sizing: border-box; 
            resize: vertical; 
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
                              <h2>Modifer news</h2>
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
                             @include '../conn_db.php';

      $select = mysqli_query($conn, "SELECT * FROM info WHERE id_info = '$id_info'");
      while($row = mysqli_fetch_assoc($select)){
 ?>
                                <form>
                                <div class="field">
                                         <label class="label_field">Text 1</label>
                                         <textarea name="text1" value="<?php echo $row['text1']; ?>" placeholder="text1"></textarea>
                                      </div>
                                      <div class="field">
                                         <label class="label_field">Text 2</label>
                                         <textarea name="text2" value="<?php echo $row['text2']; ?>" placeholder="text2"></textarea>
                                      </div>
                                      <div class="field">
                                         <label class="label_field">About</label>
                                         <textarea name="about" value="<?php echo $row['about']; ?>" placeholder="about"></textarea>
                                      </div>
                                </form>
                                <?php }; ?>

                             </div>
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