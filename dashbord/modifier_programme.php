<?php
session_start();
include '../conn_db.php';

// Vérifier si l'ID de l'actualité à modifier est passé via l'URL
if (isset($_GET['id'])) {
    $id_programme = $_GET['id'];

    // Récupérer les détails de l'actualité à modifier depuis la base de données
    $sql = "SELECT * FROM programme WHERE id_programme = '$id_programme'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
      $row = mysqli_fetch_assoc($result);
      $nom = $row['titre_programme'];
      $desc = $row['description_programme'];
      $enregistre_par = $row['enregistre_par'];
    //   $nbr_episodes = $row['nbr_episodes'];
      $cat = $row['category'];
      $img = $row['image_prog'];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $proTitle = mysqli_real_escape_string($conn, $_POST['title']);
            $proDescription = mysqli_real_escape_string($conn, $_POST['description']);
            // $nbr = mysqli_real_escape_string($conn, $_POST['nbr_e']);
            $cat = mysqli_real_escape_string($conn, $_POST['cat']);
            $user = mysqli_real_escape_string($conn, $_POST['user_p']);

            if(empty($_FILES['imageFile']['name'])){
                $uploadFile=$img;
            }
      

  
            else{
            $uploadFile = $_FILES['imageFile']['name'];
            $uploadDir = '../img/programme_images/' .$uploadFile;
            move_uploaded_file($_FILES['imageFile']['tmp_name'], $uploadDir);
            $uploadFile = mysqli_real_escape_string($conn, $uploadFile);}
            $updateSql = "UPDATE programme SET titre_programme = '$proTitle', description_programme = '$proDescription', image_prog = '$uploadFile', enregistre_par = '$user', category = '$cat'/*, nbr_episodes = '$nbr'*/ WHERE id_programme = '$id_programme'";
            $updateResult = mysqli_query($conn, $updateSql);
        
                if ($updateResult) {
                    echo '<script>alert("programme modifiée avec succès.");</script>';
                    echo '<script>window.location.href = "programmes.php";</script>'; // Redirection après l'ajout
                    exit();
                } else {
                    echo '<script>alert("Erreur lors de la modification du programme. Veuillez réessayer.");</script>';
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
    <title>Cultur Campus |modifie_programme</title>
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
                                <h2>News</h2>
                            </div>
                        </div>
                    </div>
        <div class="container">
            <h2>Modifier le programme</h2>
            <form action="" method="POST" enctype="multipart/form-data" >
                <!-- Champs de formulaire pour la modification -->
                <div class="form-group">
                    <label for="title">Titre :</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo $nom; ?>">
                </div>
                <div class="form-group">
                    <label for="title">Enregistré par :</label>
                    <input type="text" class="form-control" id="user_p" name="user_p" value="<?php echo $enregistre_par; ?>">
                </div>
                <!-- <div class="form-group">
                    <label for="title">Nombre d'épisodes :</label>
                    <input type="Number" class="form-control" id="nbr_e" name="nbr_e" value="<?php echo $nbr_episodes; ?>">
                </div> -->
                <div class="form-group">
                    <label for="title">Catégorie :</label>
                    <input type="text" class="form-control" id="cat" name="cat" value="<?php echo $cat; ?>">
                </div>
                <div class="form-group">
                    <label for="description">Description :</label>
                    <textarea class="form-control" id="description" name="description"><?php echo $desc; ?></textarea>
                </div>
               
                <div class="form-group">
                    <label for="image">Image actuelle :</label><br>
                    <img src="../img/programme_images/<?php echo $img; ?>" class="img-fluid" style="width:700px;height:400px" alt="Image de l'actualité"><br><br>
                    <div class="field">
                                        <label class="label_field">Choisir une nouvelle image :</label>
                                        <input type="file" id="imageFile" name="imageFile" accept="image/*">
                                     </div>                </div>
                <!-- Champ caché pour l'ID de l'actualité -->
                <input type="hidden" name="id_programme" value="<?php echo $id_programme; ?>">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
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


