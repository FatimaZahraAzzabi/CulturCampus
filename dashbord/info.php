<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    // Redirigez vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: ../loginAdmin.php');
    exit();
}?>
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
      <title>Cultur Campus | info</title>
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
   <body class="inner_page contact_page">
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
                     <?php   

@include '../conn_db.php';

$select = mysqli_query($conn, "SELECT * FROM info");
$row = mysqli_fetch_assoc($select)

?>

               <!-- dashboard inner -->
               <div class="midde_cont">
                  <div class="container-fluid">
                     <div class="row column_title">
                        <div class="col-md-12">
                           <div class="page_title">
                              <br><br>
                              <h2>Informations</h2>
                              <center>   <a href="modifier_info.php?edit=<?php echo $row['id_info']; ?>" class="btn btn-success btn-xs"><i class="fa-solid fa-pen-to-square"></i> modifier
                            </a></center>
                          
                           </div>
                          
                        </div>
                        
                     </div>

                       <!-- row -->
                       <div class="row column1 social_media_section">
                        <div class="col-md-6 col-lg-3">
                           <div class="full socile_icons fb margin_bottom_30">
                           <a  href="<?php echo $row['lien_fb']?>">  <div class="social_icon">
                                 <i href="" class="fa fa-facebook"></i>
                              </div></a> 
                              <div class="social_cont">
                              <ul>
                                
                              
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                           <div class="full socile_icons tw margin_bottom_30">
                            <a href="<?php echo $row['lien_instagram']?>"> <div class="social_icon" style="background:#ed00dd;">
                                 <i class="fa fa-instagram"></i>
                              </div></a> 
                              <div class="social_cont">
                              <ul>
                                
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                           <div class="full socile_icons linked margin_bottom_30">
                             <a 	href="<?php echo $row['lien_linkedin']?>"> <div  class="social_icon">
                                 <i class="fa fa-linkedin"></i>
                              </div></a>
                              <div class="social_cont">
                              <ul>
                            
                                 </ul>
                              </div>
                           </div>
                        </div>
                        
                        <div class="col-md-6 col-lg-3">
                           <div class="full socile_icons google_p margin_bottom_30">
                           <a href="<?php echo $row['lien_youtube']?>">   <div class="social_icon">
                                 <i class="fa fa-youtube"></i>
                              </div></a>
                              <div class="social_cont">
                                 <ul>
                                
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- end row -->
                     
                     <!-- row -->
                     <div class="row column1">
                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2></h2>

                                 </div>

                                       <!-- tab style 2 -->
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2></h2>
                                 </div>
                                 
                              </div>
                              
                              <div class="full inner_elements">
                                
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="tab_style2">
                                          <div class="tabbar padding_infor_info">
                                             <nav>
                                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                   <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home_s2" role="tab" aria-controls="nav-home_s2" aria-selected="true">text 1</a>
                                                   <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact_s2" role="tab" aria-controls="nav-contact1_s2" aria-selected="false">text 2</a>
                                                   <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile_s2" role="tab" aria-controls="nav-profile_s2" aria-selected="false">a propos de nous:</a>
                                                   <a class="nav-item nav-link" id="nav-logo-tab" data-toggle="tab" href="#nav-logo_s2" role="tab" aria-controls="nav-logo_s2" aria-selected="false">logo:</a>
                                                   <a class="nav-item nav-link" id="nav-ad-tab" data-toggle="tab" href="#nav-ad_s2" role="tab" aria-controls="nav-ad_s2" aria-selected="false">Adresse</a>
                                                   <a class="nav-item nav-link" id="nav-tel-tab" data-toggle="tab" href="#nav-tel_s2" role="tab" aria-controls="nav-tel_s2" aria-selected="false">Tel</a>
                                                   <a class="nav-item nav-link" id="nav-fax-tab" data-toggle="tab" href="#nav-fax_s2" role="tab" aria-controls="nav-fax_s2" aria-selected="false">Fax</a>
                                                   <a class="nav-item nav-link" id="nav-email-tab" data-toggle="tab" href="#nav-email_s2" role="tab" aria-controls="nav-email_s2" aria-selected="false">Email</a>
                                                   <a class="nav-item nav-link" id="nav-map-tab" data-toggle="tab" href="#nav-map_s2" role="tab" aria-controls="nav-map_s2" aria-selected="false">Maps</a>






                                                </div>
                                             </nav>
                                             <div class="tab-content" id="nav-tabContent">
                                                <div class="tab-pane fade show active" id="nav-home_s2" role="tabpanel" aria-labelledby="nav-home-tab">
                                                   <p>
                                                   <?php echo $row['text1'] ?>
                                                   </p>
                                                 

                                
                                                </div>
                                               
                                                <div class="tab-pane fade" id="nav-contact_s2" role="tabpanel" aria-labelledby="nav-contact-tab">
                                                   <p><?php echo $row['text2'] ?></p>
                                                  
                                                </div>
                                                <div class="tab-pane fade" id="nav-profile_s2" role="tabpanel" aria-labelledby="nav-profile-tab">
                                                   <p>
                                                   <?php echo $row['about']?> 
                                                   </p>
                                                 
                                                </div>
                                                <div class="tab-pane fade" id="nav-logo_s2" role="tabpanel" aria-labelledby="nav-logo-tab">
                                                <center>  <p>
                                                   <img src="../img/<?php echo $row['logo'] ?>" style="width: 150px;height: 150px; 	
					display: inline-block;
					 border-radius: 100%;" alt="">
                                                   </p></center> 
                                                  
                                                </div>
                                               
                                                <div class="tab-pane fade" id="nav-ad_s2" role="tabpanel" aria-labelledby="nav-ad-tab">
                                                <p>
                                                <?php echo $row['adresse']?> 
                                                   </p>
                                                 
                                                </div>
                                               
                                                <div class="tab-pane fade" id="nav-tel_s2" role="tabpanel" aria-labelledby="nav-tel-tab">
                                                <p>
                                                <?php echo $row['tel']?> 
                                                   </p>
                                                  
                                                </div>
                                                <div class="tab-pane fade" id="nav-fax_s2" role="tabpanel" aria-labelledby="nav-fax-tab">
                                                <p>
                                                <?php echo $row['fax']?> 
                                                   </p>
                                                  
                                                </div>
                                                <div class="tab-pane fade" id="nav-email_s2" role="tabpanel" aria-labelledby="nav-email-tab">
                                                <p>
                                                <?php echo $row['email']?> 
                                                   </p>
                                                 
                                                </div>
                                                <div class="tab-pane fade" id="nav-map_s2" role="tabpanel" aria-labelledby="nav-map-tab">
                                                <p>
                                               <iframe src=" <?php echo $row['maps']?> " style="border:0" allowfullscreen></iframe>
                                                   </p>
                                                                                </div>
                                                
                                                
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        
                              </div>
                              
                           </div> 
                        </div>
                     </div>
                     <!-- footer -->
                     <div class="container-fluid">
                        <div class="footer">
                           <p>Copyright © 2018 Designed by html.design. All rights reserved.<br><br>
                              Distributed By: <a href="https://themewagon.com/">ThemeWagon</a>
                           </p>
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
      <script></script>
   </body>
</html>