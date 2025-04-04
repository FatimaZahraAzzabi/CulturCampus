<?php

@include '../conn_db.php';
require_once '../functions/compteur.php';

ajouter_vue();

// Effectuer la requête pour compter le nombre de messages dans la table "contacts"
$query = "SELECT COUNT(*) AS total_messages FROM contacts";
$result = mysqli_query($conn, $query);
if ($result) {
 // Extraire le nombre de messages de la réponse de la requête
 $row = mysqli_fetch_assoc($result);
 $total_messages = $row['total_messages'];
} 
  
$query1 = "SELECT COUNT(*) AS total_podcast FROM podcast";
$result1 = mysqli_query($conn, $query1);
if ($result1) {
 // Extraire le nombre de messages de la réponse de la requête
 $row1 = mysqli_fetch_assoc($result1);
 $total_podcast = $row1['total_podcast'];
} 

$stat="SELECT count(*) as stat_prog FROM programme";

$result2 = mysqli_query($conn, $stat);
if ($result2) {
 $row2 = mysqli_fetch_assoc($result2);
 $total_pr= $row2['stat_prog'];
} 

$stat2="SELECT count(*) as stat_episode FROM episodes";

$result3 = mysqli_query($conn, $stat2);
if ($result3) {
 $row3 = mysqli_fetch_assoc($result3);
 $total_episode= $row3['stat_episode'];
} 

$query_views_likes_podcast = "SELECT SUM(listeners) AS total_views_podcast, SUM(likes) AS total_likes_podcast FROM podcast";
$result_views_likes_podcast = mysqli_query($conn, $query_views_likes_podcast);
if ($result_views_likes_podcast) {
    $row_views_likes_podcast = mysqli_fetch_assoc($result_views_likes_podcast);
    $total_views_podcast = $row_views_likes_podcast['total_views_podcast'];
    $total_likes_podcast = $row_views_likes_podcast['total_likes_podcast'];
}

$query_likes_episodes = "SELECT SUM(likes)  AS total_likes_episodes , SUM(listeners) as tot_v FROM episodes";
$result_likes_episodes = mysqli_query($conn, $query_likes_episodes);
if ($result_likes_episodes) {
    $row_likes_episodes = mysqli_fetch_assoc($result_likes_episodes);
    $total_likes_episodes = $row_likes_episodes['total_likes_episodes'];
    $total_v = $row_likes_episodes['tot_v']; 
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
      <title>Cultur Campus </title>
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
      <link rel="stylesheet" href="css/color_2.css" />
      <!-- select bootstrap -->
      <link rel="stylesheet" href="css/bootstrap-select.css" />
      <!-- scrollbar css -->
      <link rel="stylesheet" href="css/perfect-scrollbar.css" />
      <!-- custom css -->
      <link rel="stylesheet" href="css/custom.css" />
      <style>
.social_media_section {
    text-align: center;
    margin-top: 20px; 
}

.social_icons {
    list-style: none;
    padding: 0;
    margin: 0;
}

.social_icons li {
    display: inline-block;
    margin-right: 50px; 
}

.social_icons li:last-child {
    margin-right: 0;
}

.social_icons a {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    width: 80px; 
    height: 80px;
    border-radius: 50%;
    background-color: #0a92c0; 
    color: #fff;
    font-size: 30px; 
    transition: background-color 0.3s ease;
    border: 2px solid transparent;
}

.social_icons a:hover {
    background-color: #333; 
    border-color: #3b5998;
}

.text-dark {
            color: #333 !important; 
        }

      </style>
      
   </head>
   <body class="dashboard dashboard_1">
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

               <!-- dashboard inner -->
               <div class="midde_cont">
                  <div class="container-fluid">
                     <div class="row column_title">
                        <div class="col-md-12">
                           <div class="page_title">
                              <br><br>
                              <h2>Dashboard Cultur Campus</h2>
                           </div>
                        </div>
                     </div>
                     <div class="row column_title">
    <div class="col-md-12">
        <div class="page_title">
            <br><br>
            <h2>Statistiques</h2>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="full counter_section margin_bottom_30">
            <div class="couter_icon">
                <div> 
                    <i class="fa fa-user yellow_color"></i>
                </div>
            </div>
            <div class="counter_no">
                <div>
                <p class="total_no" style='color:black'>visiteurs   </p>
                    <p class="head_couter" style="color:gray"><?php echo nombre_vue(); ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="full counter_section margin_bottom_30">
            <div class="couter_icon">
                <div> 
                    <i class="fa fa-music blue1_color"></i>
                </div>
            </div>
            <div class="counter_no">
                <div>
                    <p class="total_no" style="color:black"><?php echo $total_podcast ;?></p>
                    <p class="head_couter" style="color:gray">Total podcast</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="full counter_section margin_bottom_30">
            <div class="couter_icon">
                <div> 
                    <i class="fa fa-file-alt green_color"></i>
                </div>
            </div>
            <div class="counter_no">
                <div>
                    <p class="total_no" style="color:black"><?php echo $total_pr; ?></p>
                    <p class="head_couter" style="color:gray">Total Programme</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="full counter_section margin_bottom_30">
            <div class="couter_icon">
                <div> 
                    <i class="fa fa-music blue1_color"></i>
                </div>
            </div>
            <div class="counter_no">
                <div>
                    <p class="total_no" style="color:black"><?php echo $total_episode; ?></p>
                    <p class="head_couter" style="color:gray">Total épisodes</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="full counter_section margin_bottom_30">
            <div class="couter_icon">
                <div> 
                    <i class="fa fa-eye green_color"></i>
                </div>
            </div>
            <div class="counter_no">
                <div>
                    <p class="total_no" style="color:black"><?php echo $total_views_podcast; ?></p>
                    <p class="head_couter" style="color:gray">Total Vues (Podcast)</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="full counter_section margin_bottom_30">
            <div class="couter_icon">
                <div> 
                    <i class="fa fa-thumbs-up green_color"></i>
                </div>
            </div>
            <div class="counter_no">
                <div>
                    <p class="total_no" style="color:black"><?php echo $total_likes_podcast; ?></p>
                    <p class="head_couter" style="color:gray">Total Likes (Podcast)</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="full counter_section margin_bottom_30">
            <div class="couter_icon">
                <div> 
                    <i class="fa fa-eye green_color"></i>
                </div>
            </div>
            <div class="counter_no">
                <div>
                    <p class="total_no" style="color:black"><?php echo $total_v; ?></p>
                    <p class="head_couter" style="color:gray">Total Vues (Épisodes)</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="full counter_section margin_bottom_30">
            <div class="couter_icon">
                <div> 
                    <i class="fa fa-thumbs-up green_color"></i>
                </div>
            </div>
            <div class="counter_no">
                <div>
                    <p class="total_no" style="color:black"><?php echo $total_likes_episodes; ?></p>
                    <p class="head_couter" style="color:gray">Total Likes (Épisodes)</p>
                </div>
            </div>
        </div>
    </div>
</div>


                     <!-- </div> -->
                     <div class="social_media_section">
    <ul class="social_icons">
        <li><a href="https://www.facebook.com/watch/?v=808188276973199"><i class="fab fa-facebook-f"></i></a></li>
        <li><a href="https://twitter.com/BUnivh2c"><i class="fab fa-twitter"></i></a></li>
        <li><a href="https://www.instagram.com/explore/locations/110687902328213/bibliotheque-universitaire-mohamed-sekkat/"><i class="fab fa-instagram"></i></a></li>
        <li><a href="https://www.linkedin.com/in/biblioth%C3%A8que-universitaire-mohamed-sekkat-bums-77a057245/?originalSubdomain=ma"><i class="fab fa-linkedin-in"></i></a></li>
        <li><a href="https://youtube.com/@bibliothequeuniversitairem4688?si=Yp8R4RZd27zlR-X6"><i class="fab fa-youtube"></i></a></li>
    </ul>
</div>


                   
                  <!-- footer -->
                  <div class="container-fluid">
                     <div class="footer">
                        <p>Copyright © 2024 Cultur campus Bums. All rights reserved.<br><br>
                        </p>
                     </div>
                  </div>
               </div>
               <!-- end dashboard inner -->
            </div>
         </div>
      </div>
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
      <script src="js/chart_custom_style1.js"></script>
   </body>
</html>