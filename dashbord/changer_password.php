<?php
session_start();
$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';
unset($_SESSION['error_message']);
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
      <title>Cultur Campus | changer mot de passe</title>
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
      <script>
      // JavaScript pour afficher l'alerte avec le message d'erreur
      window.onload = function() {
         var errorMessage = "<?php echo addslashes($error_message); ?>";
         if (errorMessage) {
            alert(errorMessage);
         }
      };
   </script>
    <style>
    .password-input {
        position: relative;
    }

    .password-input input {
        padding-right: 10px; /* Ajoute un espace pour l'icône */
    }

    .password-input .toggle-password {
        position: absolute;
        top: 50%;
        right: 8px;
        transform: translateY(-50%);
        cursor: pointer;
        color: #888;
    }

    .password-input .toggle-password:hover {
        color: #333;
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
                    <div class="container">
                       <div class="center verticle_center full_height">
                          <div class="login_section">
                             <div class="logo_login">
                                <div class="center">
                                   <img width="210" src="images/logo/logo.jpeg" style="height: 90px; width: 150px;" alt="#" />
                                </div>
                             </div>
                             <div class="login_form">
                                <form method="POST" action="update_password.php">
                                   <fieldset>
                                      <div class="field">

                                      <div class="password-input">
                                         <label class="label_field"><i class="fa-solid fa-lock" style="color: #74C0FC;"></i></label>
                                         <input type="password" name="pass" placeholder="saisir l'ancien mot de passe" />
                                         <span class="toggle-password">
                                             <i class="far fa-eye" id="togglePassword"></i>
                                        </span>
                                      </div>
</div>
                                      
                                      <div class="field">
                                      <div class="password-input">
                                        <label class="label_field"><i class="fa-solid fa-lock" style="color: #74C0FC;"></i></label>
                                        <input type="password" name="pass2" placeholder="Confirmer  l'ancien mot de passe" />
                                        <span class="toggle-password">
                                             <i class="far fa-eye" id="togglePassword"></i>
                                        </span>
                                     </div>
</div>
                                     <div class="field">
                                     <div class="password-input">
                                        <label class="label_field"><i class="fa-solid fa-check" style="color: #74C0FC;"></i></label>
                                        <input type="password" name="pass22" placeholder="Saisir le nouveau mot de passe">
                                        <span class="toggle-password">
                                             <i class="far fa-eye" id="togglePassword"></i>
                                        </span>
                                     </div>
                                     </div>
                                    


                                     <div class="field margin_0">
                                        <label class="label_field hidden">hidden label</label>
                                        <button type="submit" class="main_bt">changer le mode de passe </button>
                                </div>
                                     
                                   </fieldset>
                                </form>
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>
<script>
  // Fonction pour basculer l'affichage du mot de passe
document.querySelectorAll('.toggle-password').forEach(function(button) {
    button.addEventListener('click', function() {
        var passwordField = this.parentElement.querySelector('input');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            this.querySelector('i').classList.remove('fa-eye');
            this.querySelector('i').classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            this.querySelector('i').classList.remove('fa-eye-slash');
            this.querySelector('i').classList.add('fa-eye');
        }
    });
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

