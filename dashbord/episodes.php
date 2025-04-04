<?php
include '../conn_db.php';
session_start();

if(isset($_GET['id_pr'])) {
    $id_prog = $_GET['id_pr'];
}

// $sql = "SELECT * FROM episodes WHERE id_programme='$id_prog'";
// $result = mysqli_query($conn, $sql);


   // Supprimer l'épisode
if(isset($_GET['delete'])){
   $id_episode = $_GET['delete'];

   $query = "SELECT id_programme FROM episodes WHERE id_episode = '$id_episode'";
   $result = mysqli_query($conn, $query);
   $row = mysqli_fetch_assoc($result);
   $id_programme = $row['id_programme'];

   mysqli_query($conn, "DELETE FROM episodes WHERE id_episode = '$id_episode'");
   
   $message[] = "l'épisode est supprimé avec succès";
   
   header("Location: episodes.php?id_pr=$id_programme");
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
      <title>Cultur Campus | Episodes</title>
      <!-- Favicon -->
      <link href="images/logo/logo_icon.jpeg" rel="shortcut icon"/>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- site icon -->
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
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   </head>
   <body class="inner_page project_page">
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
               <div class="midde_cont">
                  <div class="container-fluid">
                     <div class="row column_title">
                        <div class="col-md-12">
                           <div class="page_title">
                              <br><br>
                              <h2>Episode</h2>
                           </div>
                        </div>
                     </div>
                     <div class="inbox-head">

<!-- Form pour la recherche -->
<form action="#" class="pull-right position search_inbox">
<div class="input-append">
<input id="searchInput" type="text" class="sr-input" placeholder="Search Mail">
<button class="btn sr-btn" type="button"><i class="fa fa-search"></i></button>
</div>
</form>
</div>
                     <!-- row -->
                     <div class="row column1">
                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full price_table padding_infor_info">
                                 <div class="row">
                                    <div class="col-lg-12">
                                       <div class="table-responsive-sm">
                                          <table class="table table-striped projects">
                                             <thead class="thead-dark">
                                                <tr>
                                                   <th>No</th>
                                                  
                                                   <th>Image</th>
                                                   <th>Nom</th>
                                                   <th>le programme </th>
                                                   <th>la description</th>
                                                   <th>Audio</th>
                                                   <th>Nombre de lectures</th>
                                                   <th>Nombre de likes</th>
                                                   <th>Action</th>
                                                   <th>visibilité</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                                <?php
                                                // if(mysqli_num_rows($result) > 0) {
                                                   //  while($row = mysqli_fetch_assoc($result)) {
                                                      $select = mysqli_query($conn, "SELECT * FROM episodes WHERE id_programme='$id_prog'");
                                                      while($row = mysqli_fetch_assoc($select)){ 
                 
                                                        $sql2 = "SELECT titre_programme,image_prog FROM programme WHERE id_programme='" . $row['id_programme'] . "'";
                                                        $result2 = mysqli_query($conn, $sql2);
                                                        $row2= mysqli_fetch_assoc($result2);
                                                ?>
                                            <tr data-episode-id="<?php echo $row['id_episode']; ?>">
    <td><?php echo $row['num_episode']; ?></td>
    <td>
        <img width="100" height="100" src="../img/programme_images/<?php echo $row2['image_prog']; ?>" class="rounded-circle" alt="">
    </td>
    <td><strong><?php echo $row['nom_episode']; ?></strong></td>
    <td><strong><?php echo $row2['titre_programme']; ?></strong></td>
    <td><strong><?php echo $row['description_episode']; ?></strong></td>
    <td>
        <audio controls>
            <source src="../audios/audios_episodes/<?php echo $row['audio']; ?>" type="audio/mpeg">
            Votre navigateur ne supporte pas l'élément audio.
        </audio>
    </td>
    <td><?php echo $row['listeners']; ?></td>
    <td><?php echo $row['likes']; ?></td>
    <td>
        <a href="modifier_episode.php?id_episode=<?php echo $row['id_episode']; ?>" class="btn btn-success btn-xs" style="margin-left: 5px;"><i class="fa-solid fa-pen-to-square"></i></a>
        <a href="episodes.php?delete=<?php echo $row['id_episode']; ?>" name="delete" data-toggle="modal" data-target="#deleteConfirmationModal" style="background-color: red; margin-left: 5px;" class="btn btn-success btn-xs"><i class="fa-solid fa-trash"></i></a>    </td>

        <td>
    <?php if ($row['visibility'] == 1) { ?>
        <a href="toggle_visibility.php?id=<?php echo $row['id_episode']; ?>&visibility=0&table=episodes"><i class="fa-solid fa-eye"></i></a>
    <?php } else { ?>
        <a href="toggle_visibility.php?id=<?php echo $row['id_episode']; ?>&visibility=1&table=episodes"><i class="fa-solid fa-eye-slash"></i></a>
    <?php } ?>
</td>
      </tr>
                                                <?php
                                                    }
                                                
                                                ?>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- end row -->
                     </div>
                     <!-- footer -->
                     <div class="container-fluid">
                        <div class="row">
                           <div class="footer">
                              <p>Copyright © 2018 Designed by html.design. All rights reserved.</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- end dashboard inner -->
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
            Êtes-vous sûr de vouloir supprimer cet enregistrement ?
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            <a id="deleteLink"  class="btn btn-danger">Supprimer</a>
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
<!-- Script JavaScript pour la recherche -->
<script>
$(document).ready(function() {
   // Fonction de recherche
   $('#searchInput').on('keyup', function() {
      var searchText = $(this).val().toLowerCase(); // Convertit le texte en minuscules pour la recherche insensible à la casse
      // Parcourt chaque ligne de la table
      $('table.projects tbody tr').each(function() {
         var lineText = $(this).text().toLowerCase(); // Convertit le texte de la ligne en minuscules
         // Affiche ou cache la ligne en fonction de si le texte de la ligne contient le texte de recherche
         $(this).toggle(lineText.indexOf(searchText) !== -1);
      });
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
      <!-- owl carousel -->
      <script src="js/owl.carousel.js"></script> 
      <!-- chart js -->
      <script src="js/Chart.min.js"></script>
      <script src="js/Chart.bundle.min.js"></script>
      <script src="js/utils.js"></script>
      <script src="js/analyser.js"></script>
      <!-- nice scrollbar -->
      <script src="js/perfect-scrollbar.min.js"></script>
      <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script>
      <!-- custom js -->
      <script src="js/custom.js"></script>
      <!-- calendar file css -->     
      <script src="js/semantic.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
// $(document).ready(function() {
//     $(document).on('click', '.delete-episode-btn', function(e) {
//         e.preventDefault();

//         var episodeId = $(this).data('episode-id');

//         $('#deleteConfirmationModalLabel').data('episode-id', episodeId);

//         $('#deleteConfirmationModal').modal('show');
//     });

//     $('#confirmDeleteBtn').click(function() {
//         var episodeId = $('#deleteConfirmationModalLabel').data('episode-id');

//         $.ajax({
//             type: 'POST',
//             url: 'episodes.php',
//             data: { episodeId: episodeId, delete: 1 },
//             success: function(response) {
//                 if (response === 'success') {
//                     $('#deleteConfirmationModal').modal('hide');
//                     $('tr[data-episode-id="' + episodeId + '"]').remove();
//                 } else {
//                     console.log('Error:', response);
//                 }
//             },
//             error: function(xhr, status, error) {
//                 console.log('Error:', error);
//             }
//         });
//     });
// });

</script>
   </body>
</html>
