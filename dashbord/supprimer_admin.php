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
      <title>Cultur Campus | Supprimer ADmin</title>
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
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

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
   </head>
   <body class="inner_page project_page">
      <div class="full_container">
         <div class="inner_container">
                    <!-- Sidebar  -->
                           <!-- Sidebar  -->
                           <?php include 'sidebar.php'; ?>
                           <!-- end sidebar -->
                   <!-- right content -->
  <div id="content">
   <!-- topbar -->
   <?php include 'topbar.php'; ?>


   <!-- end topbar -->           
   
   
    <!-- code php  -->
    <?php   

@include '../conn_db.php';

// supprimer
if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM users WHERE id = '$id'");
};  ?>
<div class="midde_cont">
                  <div class="container-fluid">
                     <div class="row column_title">
                        <div class="col-md-12">
                           <div class="page_title">
                              <br><br>
                              <h2>Admin(s)</h2>

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
                                                   <th style="width: 2%">No</th>
                                                   <th style="width: 30%">Image</th>
                                                   <th>Nom Complet</th>
                                                   <th>Action</th>
                                                  

                                                </tr>
                                             </thead>

                                             <?php
                                             $counter = 0;
                                     $select = mysqli_query($conn, "SELECT nom , prenom,image , id FROM users");
                                     while($row = mysqli_fetch_assoc($select)){ 
                                        $counter++;
                                        ?>

                                             <tbody>
                                                <tr>
                                                   <td><?php  echo $counter;  ?></td>
                                                   <td>
                                                      <img width="100" height="100" src="../img/user_img/<?php echo $row['image']; ?>" class="rounded-circle" alt="">
                                                   </td>
                                                   <td>
                                                    <strong><?php echo $row['nom'] . ' '.$row['prenom'] ; ?></strong>
                                                   </td>
                                                 
                                                  
                                                  
                                                  
                                                   <td style="white-space: nowrap;">
                                                  
                          
                                       <a href="?delete=<?php echo $row['id']; ?>" name="delete" data-toggle="modal" data-target="#deleteConfirmationModal" style="background-color: red; margin-left: 5px;" class="btn btn-success btn-xs"><i class="fa-solid fa-trash"></i></a>
   </td> 
  
                                                                             </tr>
                                                                             <?php } ?>

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
            Êtes-vous sûr de vouloir supprimer cet admin ?
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
   </body>
</html>