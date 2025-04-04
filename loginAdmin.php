<?php
session_start(); 
include "conn_db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recuperer les informations du formulaire
    $email = $_POST["email"];
    $password = $_POST["password"];

    // echapper les caractères spéciaux dans les valeurs pour proteger contre injection sql
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);
    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $res = mysqli_query($conn, $query);
    if ($res) {
        $nombreDeLignes = mysqli_num_rows($res);
        if ($nombreDeLignes == 1)  {
            $row = mysqli_fetch_assoc($res);
            if ($row['email'] === $email && $row['password'] ===$password) {
            	$_SESSION['id'] = $row['id'];  
            header("location: dashbord/index.php");
            exit();
        } 
        else {
           
            // modal avec un message d'erreur
            echo <<<HTML
            <div id="myModal" class="modal">
               <div class="modal-content">
                 <span class="close">&times;</span>
                     <p id="modalMessage">Identifiants incorrects. Veuillez vérifier votre email et votre mot de passe.</p>
                </div>
            </div>
HTML;
        }
    } else {
        //s'il ya un erreur
        echo "Erreur : " . mysqli_error($conn);
    }

    // Fermer la connexion a la db
    mysqli_close($conn);}

    // remember me :utiliser Cookie valable pendant 30 jours
    if (isset($_POST['remember_me']) && $_POST['remember_me'] == 'on') {
        setcookie("email", $email, time() + (86400 * 30), "/"); 
        setcookie("password", $password, time() + (86400 * 30), "/"); 
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
      <title>Cultur campus | Admin Login</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- site icon -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="icon" href="dashbord/images/fevicon.png" type="image/png" />
      <!-- bootstrap css -->
      <link rel="stylesheet" href="dashbord/css/bootstrap.min.css" />
      <!-- site css -->
      <link rel="stylesheet" href="dashbord/style1.css" />
      <!-- responsive css -->
      <link rel="stylesheet" href="dashbord/css/responsive.css" />
      <!-- color css -->
      <link rel="stylesheet" href="dashbord/css/colors.css" />
      <!-- select bootstrap -->
      <link rel="stylesheet" href="dashbord/css/bootstrap-select.css" />
      <!-- scrollbar css -->
      <link rel="stylesheet" href="dashbord/css/perfect-scrollbar.css" />
      <!-- custom css -->
      <link rel="stylesheet" href="dashbord/css/custom.css" />
      <!-- calendar file css -->
      <link rel="stylesheet" href="dashbord/js/semantic.min.css" />
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <style>
        /*  style pour notre modal*/
        .modal {
            display: none; 
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5); 
        }
    
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            text-align: center;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
      

    .password-input {
        position: relative;
    }

    .password-input input {
        padding-right: 10px; /* Ajoute un espace pour l'icône */
    }

    .password-input .toggle-password {
        position: absolute;
        top: 90%;
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
   <body class="inner_page login">
      <div class="full_container">
         <div class="container">
            <div class="center verticle_center full_height">
               <div class="login_section">
                  <div class="logo_login">
                     <div class="center">
                        <img width="210" src="dashbord/images/logo/logo.jpeg" style="height: 90px; width: 150px;" alt="#" />
                     </div>
                  </div>
                  <div class="login_form">
                     <form  method="POST" action="">
                        <fieldset>
                           <div class="field">
                              <label class="label_field">Addresse Email</label>
                              <input type="email" name="email" placeholder="E-mail" />
                           </div>
                           <div class="field">
    <label class="label_field"></label>
    <div class="password-input"><i class="fa-solid fa-lock" style="color: #74C0FC;"></i>
        <input type="password" name="password" id="password" placeholder="Mot de passe" />
        <span class="toggle-password">
            <i class="far fa-eye" id="togglePassword"></i>
        </span>
    </div>
</div>


                           <div class="field">
                              <label class="label_field hidden">hidden label</label>
                              <label class="form-check-label"><input type="checkbox"  name="remember_me" class="form-check-input">Se souvenir de moi</label>
                           
                           </div>
                           <div class="field margin_0">
                              <label class="label_field hidden">hidden label</label>
                              <button type="submit" class="main_bt">Se connecter</button>
                           </div>
                        </fieldset>
                     </form>
                  </div>
               </div>
            </div>
</div>

<script>
// Fonction pour afficher le modal
function afficherModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "block";

    var closeButton = document.getElementsByClassName("close")[0];
    closeButton.onclick = function() {
        modal.style.display = "none";
    };

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };
}

// Appeler la fonction pour afficher le modal 
window.onload = function() {
    afficherModal();
};
</script>
<script>
    // Fonction pour basculer l'affichage du mot de passe
    document.getElementById("togglePassword").addEventListener("click", function() {
        var passwordField = document.getElementById("password");
        if (passwordField.type === "password") {
            passwordField.type = "text";
            this.classList.remove("fa-eye");
            this.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            this.classList.remove("fa-eye-slash");
            this.classList.add("fa-eye");
        }
    });
</script>


<script src="dashbord/js/jquery.min.js"></script>
      <script src="dashbord/js/popper.min.js"></script>
      <script src="dashbord/js/bootstrap.min.js"></script>
      <!-- wow animation -->
      <script src="dashbord/js/animate.js"></script>
      <!-- select country -->
      <script src="dashbord/js/bootstrap-select.js"></script>
      <!-- nice scrollbar -->
      <script src="dashbord/js/perfect-scrollbar.min.js"></script>
      <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script>
      <!-- custom js -->
      <script src="dashbord/js/custom.js"></script>
</body>
</html>
