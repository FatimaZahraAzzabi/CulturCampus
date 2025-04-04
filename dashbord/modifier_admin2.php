<?php
session_start();
include '../conn_db.php';

// Vérifier si l'ID de l'actualité à modifier est passé via l'URL
if (isset($_GET['id'])) {
    $id= $_GET['id'];

    // Récupérer les détails de l'actualité à modifier depuis la base de données
    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $image = $row['image'];
        $nom = $row['nom'];
        $preUser=$row['prenom'];
        $em=$row['email'];
        $tel=$row['telephone'];
        $desc=$row['description'];
        $fb=$row['lien_fb'];
        $insta=$row['lien_insta'];
        $x=$row['lien_x'];
        $link=$row['lien_linkdin'];
       
        // Traitement de la soumission du formulaire de modification
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nom = mysqli_real_escape_string($conn, $_POST['nom']);
            $pre = mysqli_real_escape_string($conn, $_POST['pre']);
            $em = mysqli_real_escape_string($conn, $_POST['em']);
            $tel = mysqli_real_escape_string($conn, $_POST['tel']);
            $fb = mysqli_real_escape_string($conn, $_POST['fb']);
            $insta = mysqli_real_escape_string($conn, $_POST['insta']);
            $x = mysqli_real_escape_string($conn, $_POST['x']);
            $link = mysqli_real_escape_string($conn, $_POST['link']);
            $newDescription = mysqli_real_escape_string($conn, $_POST['description']);
            // $uploadDir = '../img/user_img/';
            $uploadFile =$_FILES['imageFile']['name'];
            $uploadDir = '../img/user_img/' .$uploadFile;
            // $uploadFile = $uploadDir . basename($_FILES['imageFile']['name']);
            if(empty($_FILES['imageFile']['name'])){
                $uploadFile=$image;
            }
        
             else  {
                move_uploaded_file($_FILES['imageFile']['tmp_name'], $uploadDir);
                $uploadFile = mysqli_real_escape_string($conn, $uploadFile);}
                $updateSql = "UPDATE users SET nom = '$nom', description = '$newDescription', image = '$uploadFile' , prenom='$pre' , email='$em' , telephone='$tel' , lien_fb='$fb' , lien_insta='$insta' , lien_x='$x' , lien_linkdin='$link'  WHERE id= '$id'";
                $updateResult = mysqli_query($conn, $updateSql);
        
                if ($updateResult) {
                    echo '<script>alert("informations d\'admin modifiées avec succès.");</script>';
                    echo '<script>window.location.href = "modifier_admin.php";</script>'; // Redirection après l'ajout
                    exit();
                } else {
                    echo '<script>alert("Erreur lors de la modification des informations. Veuillez réessayer.");</script>';
                }
            }
        }
    }
        // Afficher le formulaire de modification avec les données existantes pré-remplies
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Méta-informations -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Cultur Campus | modifier_admin</title>
    <!-- Favicon -->
    <link href="images/logo/logo_icon.jpeg" rel="shortcut icon"/>
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/colors.css">
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <link rel="stylesheet" href="css/perfect-scrollbar.css">
    <link rel="stylesheet" href="css/jquery.fancybox.css">
        <body class="inner_page tables_page">
<div class="full_container">
    <div class="inner_container">
        <!-- Inclure la barre latérale -->
        <?php include 'sidebar.php'; ?>
        <!-- Contenu de la page -->
        <div id="content">
            <!-- Inclure la barre supérieure -->
            <?php include 'topbar.php'; ?>
            <div class="midde_cont">
                <div class="container-fluid">
                    <div class="row column_title">
                        <div class="col-md-12">
                            <br><br>
                            <div class="page_title">
                                <h2>Admin</h2>
                            </div>
                        </div>
                    </div>
        <div class="container">
            <h2>Modifier les informations d'admin</h2>
            <form action="" method="POST" enctype="multipart/form-data" >
                <!-- Champs de formulaire pour la modification -->
                <div class="form-group">
                    <label for="title">Nom :</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $nom; ?>">
                </div>

                <div class="form-group">
                    <label for="title">Prénom :</label>
                    <input type="text" class="form-control" id="pre" name="pre" value="<?php echo $preUser; ?>">
                </div>

                <div class="form-group">
                    <label for="title">Email :</label>
                    <input type="email" class="form-control" id="em" name="em" value="<?php echo $em; ?>">
                </div>

                <div class="form-group">
                    <label for="title">Télephone :</label>
                    <input type="text" class="form-control" id="tel" name="tel" value="<?php echo $tel; ?>">
                </div>

                
                <div class="form-group">
                    <label for="title">Facebook :</label>
                    <input type="text" class="form-control" id="fb" name="fb" value="<?php echo $fb; ?>">
                </div>

                <div class="form-group">
                    <label for="title">Instagram :</label>
                    <input type="text" class="form-control" id="insta" name="insta" value="<?php echo $insta; ?>">
                </div>

                <div class="form-group">
                    <label for="title">X :</label>
                    <input type="text" class="form-control" id="x" name="x" value="<?php echo $x; ?>">
                </div>

                <div class="form-group">
                    <label for="title">Linkdin :</label>
                    <input type="text" class="form-control" id="link" name="link" value="<?php echo $link; ?>">
                </div>



                <div class="form-group">
                    <label for="description">Description :</label>
                    <textarea class="form-control" id="description" name="description"><?php echo $desc; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="image">Image actuelle :</label><br>
                    <img src="../img/user_img/<?php echo $image; ?>" class="img-fluid" style="width:100%;height:400px" alt="Image de l'actualité"><br><br>
                    <div class="field">
                                        <label class="label_field">Choisir une nouvelle image :</label>
                                        <input type="file" id="imageFile" name="imageFile" accept="image/*">
                                     </div>                </div>
                <!-- Champ caché pour l'ID de l'actualité -->
                <input type="hidden" name="id_news" value="<?php echo $id_news; ?>">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
        </div>
        </body>
        </html>
        <?php

?>
 </div>
                </div>
            </div>
            <!-- Pied de page -->
            <div class="container-fluid">
                <div class="footer">
                    <p>Copyright © 2018 Designed by html.design. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap modal markup -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirmation de suppression</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            Êtes-vous sûr de vouloir supprimer cette actualité ?
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            <a id="deleteLink" href="#" class="btn btn-danger">Supprimer</a>
         </div>
      </div>
   </div>
</div>

<!-- Add JavaScript to handle deletion confirmation -->
<script>
   $(document).ready(function() {
      // Bind click event to deletion link
      $('[data-toggle="modal"]').click(function() {
         var target = $(this).data('target');
         var href = $(this).attr('href');
         $(target).find('.modal-footer #deleteLink').attr('href', href);
      });
   });
</script>
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/animate.js"></script>
<script src="js/bootstrap-select.js"></script>
<script src="js/owl.carousel.js"></script>
<script src="js/Chart.min.js"></script>
<script src="js/Chart.bundle.min.js"></script>
<script src="js/utils.js"></script>
<script src="js/analyser.js"></script>
<script src="js/perfect-scrollbar.min.js"></script>
<script src="js/jquery.fancybox.min.js"></script>
<script src="js/custom.js"></script>
<script src="js/semantic.min.js"></script>

</body>
</html>