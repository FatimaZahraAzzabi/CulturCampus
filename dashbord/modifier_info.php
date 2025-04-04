<!-- code php -->
<?php
@include '../conn_db.php';

$id_info= $_GET['edit'];
if(isset($_POST['update_info'])){
   $lien_fb = mysqli_real_escape_string($conn, $_POST['lien_fb']);
   $lien_instagram = mysqli_real_escape_string($conn, $_POST['lien_instagram']);
   $lien_linkedin = mysqli_real_escape_string($conn, $_POST['lien_linkedin']);
   $lien_youtube = mysqli_real_escape_string($conn, $_POST['lien_youtube']);
   $text1 = mysqli_real_escape_string($conn, $_POST['text1']);
   $about = mysqli_real_escape_string($conn, $_POST['about']);
   $text2 = mysqli_real_escape_string($conn, $_POST['text2']);
   $fax = mysqli_real_escape_string($conn, $_POST['fax']);
   $tel = mysqli_real_escape_string($conn, $_POST['tel']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $adresse = mysqli_real_escape_string($conn, $_POST['adresse']);
   $maps = mysqli_real_escape_string($conn, $_POST['maps']);
   $logo = $_FILES['logo']['name'];
   $image_tmp_name = $_FILES['logo']['tmp_name'];
   $info_image_folder = '../img/'.$logo;


if(isset($lien_fb) || isset($lien_linkedin)  || isset($lien_youtube) || isset($lien_instagram) ||  isset($text2) 
|| isset($text2) || 
 isset($fax) || 
isset($email) || 
isset($about) || 
isset($adresse) || 
isset($maps) || 
 isset($tel) || 
isset($logo)
){
  

      $update_data = "UPDATE info SET lien_fb ='$lien_fb', 
      lien_linkedin='$lien_linkedin', lien_instagram='$lien_instagram',lien_youtube='$lien_youtube'
    , text1='$text1',text2='$text2' ,logo='$logo',fax='$fax',tel='$tel' ,email='$email',adresse='$adresse',maps='$maps',about='$about' WHERE id_info ='$id_info' ";
      $upload = mysqli_query($conn, $update_data);
      if ($upload) {
         echo '<script>alert("information(s) modifiée(s) avec succès.");</script>';
         echo '<script>window.location.href = "info.php";</script>'; 
         exit();
     } else {
         echo '<script>alert("Erreur lors de la modification des informations. Veuillez réessayer.");</script>';
     }
   
};}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Méta-informations -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Cultur Campus | Informations</title>
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
                                <h2>Informations</h2>
                            </div>
                        </div>
                    </div>
        <div class="container">
            <h2>Modifier les infotmations du site </h2><br><br>
            <form action="" method="POST" enctype="multipart/form-data" >
                <!-- Champs de formulaire pour la modification -->
                <?php
      $select = mysqli_query($conn, "SELECT * FROM info WHERE id_info = '$id_info'");
      while($row = mysqli_fetch_assoc($select)){
 ?>
                 <div class="form-group">
                    <label for="description">Texte 1 :</label>
                    <textarea class="form-control" id="" name="text1"><?php echo $row['text1']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="description">Texte 2 :</label>
                    <textarea class="form-control" id="" name="text2"><?php echo $row['text2']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="description">Texte A propos de nous :</label>
                    <textarea class="form-control" id="" name="about"><?php echo $row['about']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="title">Email :</label>
                    <input type="text" class="form-control" id="" name="email" value="<?php echo $row['email']; ?>">
                </div>

                <div class="form-group">
                    <label for="title">Adresse :</label>
                    <input type="text" class="form-control" id="" name="adresse" value="<?php echo $row['adresse']; ?>">
                </div>

                <div class="form-group">
                    <label for="title">Téléphone :</label>
                    <input type="text" class="form-control" id="" name="tel" value="<?php echo $row['tel']; ?>">
                </div>

<div class="form-group">
                    <label for="title">Fax :</label>
                    <input type="text" class="form-control" id="" name="fax" value="<?php echo $row['fax']; ?>">
                </div>

                <div class="form-group">
                    <label for="title">Facebook:</label>
                    <input type="text" class="form-control" id="" name="lien_fb" value="<?php echo $row['lien_fb']; ?>">
                </div>

                <div class="form-group">
                    <label for="title">Instagram :</label>
                    <input type="text" class="form-control" id="" name="lien_instagram" value="<?php echo $row['lien_instagram']; ?>">
                </div>

                <div class="form-group">
                    <label for="title">Linkdin :</label>
                    <input type="text" class="form-control" id="" name="lien_linkedin" value="<?php echo $row['lien_linkdin']; ?>">
                </div>
               
            

                <div class="form-group">
                    <label for="title">lien youtube :</label>
                    <input type="text" class="form-control" id="" name="lien_youtube" value="<?php echo $row['lien_youtube']; ?>">
                </div>


                

                <div class="form-group">
                    <label for="title">Maps :</label>
                    <input type="text" class="form-control" id="" name="maps" value="<?php echo $row['maps']; ?>">
                </div>

                <div class="form-group">
                    <label for="image">logo :</label><br>
                    <img src="../img/<?php echo $row['logo']; ?>" class="img-fluid" style="width:100%;height:400px" alt="logo"><br><br>
                    <div class="field">
                                        <label class="label_field">Choisir un nouveau logo :</label>
                                        <input type="file" id="" name="logo" accept="image/*">
                                     </div>                </div>
                <!-- Champ caché pour l'ID de l'actualité -->
               
                <button name="update_info" type="submit" class="btn btn-primary">Enregistrer</button>
                <?php  } ?>
            </form>
        </div>
        </body>
        </html>
        <?php
//     } else {
//         // Actualité non trouvée
//         echo "Actualité non trouvée.";
//     }
// } else {
//     // ID non spécifié
//     echo "ID de l'actualité non spécifié.";
// }
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