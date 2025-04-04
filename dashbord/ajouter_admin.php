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
include "../conn_db.php";
if (isset($_POST['submit'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"]))  {
    $uploadFile =$_FILES['imageFile']['name'];
    $uploadDir = '../img/user_img/' .$uploadFile;
    // $uploadFile = $uploadDir . basename($_FILES['imageFile']['name']);    
    // Recuperer les informations du formulaire
    $email = $_POST["email"];
    $password = $_POST["password"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $tel = $_POST["tel"];
    $description = $_POST["description"];
    $insta=$_POST["insta"];
    $fb=$_POST["fb"];
    $twiter=$_POST["twit"];
    $linkdin=$_POST["link"];
    $repass=$_POST["pass22"];
    // tester validté mot de passe 
    $error_message =" ";
    if($password!==$repass){
        $error_message = "vérifier la confirmation du mot de passe ";
    }

    else if (strlen($repass) < 8) {
        $error_message = "Le mot de passe doit contenir au moins 8 caractères.";
    }

    else if (!preg_match('/[A-Z]/', $repass) || !preg_match('/[a-z]/', $repass) ) {
        $error_message = "Le mot de passe doit contenir au moins une lettre majuscule et une lettre minuscule.";
    }
    else if(!preg_match('/[0-9]/', $repass) ){
        $error_message = "le mot de passe doit contenir au moins un chiffre .";
    }

    else if(!preg_match('/[!@#$%^&*]/', $repass)){
        $error_message = "mot de passe doit contenir au moins un caractére spécial .";
    }

    else if($email===''){
        $error_message = "vieullez saisir l'email ";
    }
    // else if($tel===''){
    //     $error_message = "vieullez saisir le numéro de téléphone ";
    // }

    else if($nom===''){
        $error_message = "vieullez saisir le nom  ";
    }
    else if($prenom===''){
        $error_message = "vieullez saisir le prénom ";
    }

    else if($password===''){
        $error_message = "vieullez saisir le mot de passe  ";
    }

    else if($repass===''){
        $error_message = "vieullez confirmer ton mot de passe ";
    }

    else{
    // echapper les caractères spéciaux dans les valeurs pour proteger contre injection sql
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);
    $nom = mysqli_real_escape_string($conn, $nom);
    $prenom = mysqli_real_escape_string($conn, $prenom);
    $tel=mysqli_real_escape_string($conn, $tel);
    $description=mysqli_real_escape_string($conn, $description);
    $query = "INSERT INTO users (nom, prenom, telephone, email, description, image, password,lien_fb,lien_insta,lien_x,lien_linkdin) VALUES ('$nom', '$prenom', '$tel', '$email', '$description', '$uploadFile', '$password','$fb','$insta','$twiter','$linkdin')";
    $res = mysqli_query($conn, $query);

    if ($res) {
        $req="SELECT id FROM users where password='$password'";
        move_uploaded_file($_FILES['imageFile']['tmp_name'], $uploadDir);
        $resultat = mysqli_query($conn, $req);
        if($resultat){
        $row = mysqli_fetch_assoc($resultat);
        $_SESSION['id']= $row['id'];}
        if($resultat){
           header("Location:ajout_succes.php");}
       
    } else {
        // echo "Erreur lors de l'enregistrement : " . mysqli_error($conn);
        header("Location:404_error.html");
    }

}}}
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
   <body class="inner_page login">
    <br><br><br><br><br><br><br><br><br><br><br>

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
                 
                     <form  method="POST" action="" enctype="multipart/form-data">
                        <fieldset>
                        <div class="field">
                              <label class="label_field">Prenom</label>
                              <input type="text" name="prenom" placeholder="saisir le prenom " />
                           </div>
                           <div class="field">
                              <label class="label_field">Nom</label>
                              <input type="text" name="nom" placeholder="saisir le nom" />
                           </div>
                           <div class="field">
                              <label class="label_field">Le télephone</label>
                              <input type="text" name="tel" placeholder="saisir le numéro de telephone" />
                           </div>
                           <div class="field">
                               <label class="label_field">Image</label>
                               <input type="file" name="imageFile" id="imageFile" accept="image/*" required>
                            </div>

                           <div class="field">
                              <label class="label_field">Addresse Email</label>
                              <input type="email" name="email" placeholder="E-mail" />
                           </div>
                           <div class="field">
                              <label class="label_field">Description</label>
                              <textarea name="description" placeholder="donner une description d'admin"></textarea>
                           </div>

                           <div class="field">
                              <label class="label_field"><i class="fa-brands fa-instagram" style="color: #74C0FC; font-size: 40px;"></i></label>
                              <input type="type" name="insta" placeholder="donner le lien instagramme (optionel)" />
                           </div>

                           <div class="field">
                              <label class="label_field"><i class="fa-brands fa-facebook" style="color: #74C0FC; font-size: 40px;"></i></label>
                              <input type="text" name="fb" placeholder="donner le lien facebook (optionel)" />
                           </div>

                           <div class="field">
                              <label class="label_field"><i class="fa-brands fa-linkedin" style="color: #74C0FC;font-size: 40px;"></i> </i></label>
                              <input type="text" name="link" placeholder="donner le lien linkedin(optionel)" />
                           </div>

                           <div class="field">
                              <label class="label_field"><i class="fa-brands fa-twitter" style="color: #74C0FC; font-size: 40px;"></i></i></label>
                              <input type="text" name="twit" placeholder="donner le lien twiter" />
                           </div>


                           <div class="field">
    <label class="label_field"></label>
    <div class="password-input"><label class="label_field"><i class="fa-solid fa-lock" style="color: #74C0FC; font-size:40px"></i></label>
        <input type="password" name="password" id="password" placeholder="Mot de passe" />
        <span class="toggle-password">
            <i class="far fa-eye" id="togglePassword"></i>
        </span>
    </div>
</div>

<div class="field">
                                     <div class="password-input">
                                        <label class="label_field"><i class="fa-solid fa-check" style="color: #74C0FC; font-size:40px;"></i></label>
                                        <input type="password" name="pass22" placeholder="Confirmer le nouveau mot de passe">
                                        <span class="toggle-password">
                                             <i class="far fa-eye" id="togglePassword"></i>
                                        </span>
                                     </div>
                                     </div>
                           <div class="field margin_0">
                              <label class="label_field hidden">hidden label</label>
                              <button type="submit" name="submit" class="main_bt">enregistrer l'admin</button>
                           </div>
                        </fieldset>
                     </form>
                  </div>
               </div>
            </div>
</div>
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
