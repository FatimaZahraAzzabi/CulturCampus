<?php
session_start();
include '../conn_db.php';

if (isset($_GET['id_episode'])) {
    $id_episode = $_GET['id_episode'];
    $sql1 = "SELECT id_programme, num_episode,nom_episode, description_episode,  audio FROM episodes WHERE id_episode='$id_episode'";
    $result = mysqli_query($conn, $sql1);

    if (mysqli_num_rows($result) == 1) {
        $row1 = mysqli_fetch_assoc($result);
        $num = $row1['num_episode'];
        $nom_episode = $row1['nom_episode'];
        $desc = $row1['description_episode'];
        $audio = $row1['audio'];
       // $img = $row1['image_episodes'];
        $id_prog = $row1['id_programme'];

        $sql2 = "SELECT titre_programme FROM programme WHERE id_programme = '$id_prog'";
        $res2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($res2);
        $nom_prog = ($row2) ? $row2['titre_programme'] : "Ce programme n'existe pas";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Vérifier si le titre du programme existe
            $proTitle = mysqli_real_escape_string($conn, $_POST['title']);
            $episodeDescription = mysqli_real_escape_string($conn, $_POST['description']);
            $nom_episode = mysqli_real_escape_string($conn, $_POST['nom_episode']);
            $num = mysqli_real_escape_string($conn, $_POST['num']);
            $sql3 = "SELECT id_programme FROM programme WHERE titre_programme='$proTitle'";
            $qr = mysqli_query($conn, $sql3);
            $res3 = mysqli_fetch_assoc($qr);
            $id_pr = ($res3) ? $res3['id_programme'] : null;

            if (!$id_pr) {
               echo '<script>alert("Ce programme n\'existe pas."); window.location.href = "modifier_episode.php?id_episode='.$id_episode.'";</script>';
               exit(); 
            }

            // Gestion de l'image
            // if (!empty($_FILES['imageFile']['name'])) {
            //     $uploadDir = '../img/episodes/';
            //     $uploadFile = $uploadDir . basename($_FILES['imageFile']['name']);
            //     move_uploaded_file($_FILES['imageFile']['tmp_name'], $uploadFile);
            //     $uploadFile = mysqli_real_escape_string($conn, $uploadFile);
            // } else {
            //     $uploadFile = $img; // 
            // }

          
            // Gestion de l'audio
            if (!empty($_FILES['nouvel_audio']['name'])) { 
                $nouvel_audio= $_FILES['nouvel_audio']['name'];
                $uploadAudioDir = '../audios/audios_episodes/' . $nouvel_audio;
                move_uploaded_file($_FILES['nouvel_audio']['tmp_name'], $uploadAudioDir);
                $nouvel_audio = mysqli_real_escape_string($conn, $nouvel_audio);
                        } else {
                            $uploadFile = $audio;
            }

            $updateSql = "UPDATE episodes SET id_programme = '$id_pr', description_episode= '$episodeDescription',   audio='$nouvel_audio',  num_episode = '$num',nom_episode='$nom_episode' WHERE id_episode = '$id_episode'";
            $updateResult = mysqli_query($conn, $updateSql);

            if ($updateResult) {
                echo '<script>alert("Épisode modifié avec succès.");</script>';
                echo '<script>window.location.href = "episodes.php?id_pr='.$id_pr.'";</script>'; // Redirection après la modification
                exit();
            } else {
                echo '<script>alert("Erreur lors de la modification de l\'épisode. Veuillez réessayer."); window.location.href = "modifier_episode.php?id_episode='.$id_episode.'</script>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Méta-informations -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Cultur Campus |modifie_episode</title>
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
            <h2>Modifier l'épisode</h2>
            <form action="" method="POST" enctype="multipart/form-data" >
                <!-- Champs de formulaire pour la modification -->
                <div class="form-group">
                    <label for="title">Titre de programme :</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo $nom_prog; ?>">
                </div>
                <div class="form-group">
                    <label for="title">Nom episode :</label>
                    <input type="text" class="form-control" id="title" name="nom_episode" value="<?php echo $nom_episode; ?>">
                </div>
                <div class="form-group">
                    <label for="title">Numéro de l'épisode  :</label>
                    <input type="number" class="form-control" id="num" name="num" value="<?php echo $num; ?>">
                </div>
               
                <div class="form-group">
    <label for="audio">Audio actuel :</label><br>
    <audio controls>
        <source src="../audios/audios_episodes/<?php echo $audio; ?>" type="audio/mp3">
        Your browser does not support the audio element.
    </audio><br><br>
    <div class="field">
        <label class="label_field">Choisir un nouvel audio :</label>
        <input type="file" id="nouvel_audio" name="nouvel_audio" accept="audio/*">
    </div>
</div>

                <div class="form-group">
                    <label for="description">Description :</label>
                    <textarea class="form-control" id="description" name="description"><?php echo $desc; ?></textarea>
                </div>
               
                <!-- <div class="form-group">
                    <label for="image">Image actuelle :</label><br>
                    <img src="<?php echo $img; ?>" class="img-fluid" style="width:700px;height:400px" alt="Image de l'actualité"><br><br>
                    <div class="field">
                                        <label class="label_field">Choisir une nouvelle image :</label>
                                        <input type="file" id="imageFile" name="imageFile" accept="image/*">
                                     </div>                </div>
                Champ caché pour l'ID de l'actualité -->
                <input type="hidden" name="id_programme" value="<?php echo $id_programme; ?>">
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