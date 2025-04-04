<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Cultur campus | Grille des programmes</title>

    <meta charset="UTF-8">
    <meta name="description" content="SolMusic HTML Template">
    <meta name="keywords" content="music, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link href="img/favicon.jpeg" rel="shortcut icon" />
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/owl.carousel.min.css" />
    <link rel="stylesheet" href="css/slicknav.min.css" />

    <!-- Main Stylesheets -->
    <link rel="stylesheet" href="css/style1.css" />

    <style>
        .textcenter {
            text-align: center;
        }
        
        span::before,
        span::after {
            content: "";
            width: 3px;
            height: 0;
            position: absolute;
            transition: all 0.2s linear;
            background: #000;
        }
        
        .col-1 {
            -ms-flex: 0 0 8.333333%;
            flex: 0 0 8.333333%;
            max-width: 8.333333%;
        }
        
        .col-1.textcenter.p0:before {
            background: #e0e0e0;
            bottom: 0;
            content: " ";
            display: block;
            position: absolute;
            width: 1px;
            height: 150px;
            left: 0;
            right: 0;
            margin: auto;
        }
        
        .contenulist-para {
            font-size: 17px;
            width: 100%;
            margin-right: 0;
            padding: 13px 20px 0px 0;
            margin-left: 22px;
        }
        
        /* Mobile Styles */
        @media (max-width: 768px) {
            .contenulist-para {
                font-size: 14px;
            }
            
            .time {
                display: block;
                text-align: center;
                margin-bottom: 10px;
                font-size: 16px;
            }
            
            .col-1.textcenter.p0:before {
                height: 0;
            }
            
            .col-7.col-md-9.bcg.p0 {
                height: auto;
                border-radius: 15px;
                margin-bottom: 10px;
            }
            
            .imgleftprog {
                width: 100%;
                height: auto;
                border-radius: 15px;
            }
        }
    </style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header section -->
    <?php include 'header.php'; ?>

    <!-- Header section end -->
    <br><br><br><br>

    <div class="container-fluid">
        <div class="section-title">
            <h2>&nbsp; &nbsp; &nbsp;Grille des programmes <i class="fa-solid fa-calendar"></i></h2>
        </div>

        <?php
        @include 'conn_db.php';

        $select = mysqli_query($conn, "SELECT * FROM grille_programme WHERE visibility = 1"); // N'affiche que les planifications visibles
        while($row = mysqli_fetch_assoc($select)){ ?>

        <div class="simp-playlist">
            <div class="row mb15">
                <div class="col-12 textcenter p0">
                    <span class="time" style="font-weight: 600;">
                        <?php echo $row['date']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span>
                </div>
                <div class="col-7 col-md-9 bcg p0" style="width: 100%; height: 150px; background: #f1f1f1; border-radius: 15px;">
                    <br>
                    <div class="contenulist">
                        <h4 class="contenulist-para" id="title_em" style="font-weight: bold;">
                            <?php echo $row['nom']; ?>
                            <p class="contenulist-para" id="title_ep">
                                <?php echo $row['type']; ?>
                            </p>
                        </h4>
                    </div>
                </div>
                <div class="col-4 col-md-2">
                    <a>
                        <img src="img/planing_img/<?php echo $row['image']; ?>" class="imgleftprog" id="image_audio" alt="" style="width: 100%; height: 150px; object-fit: cover; border-radius: 15px;">
                    </a>
                </div>
            </div>
        </div>

        <br><br>
        <?php } ?>

        <br><br>

        <!-- Footer section -->
        <?php include 'footer.php'; ?>
        <!-- Footer section end -->

        <!--====== Javascripts & Jquery ======-->
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.slicknav.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/mixitup.min.js"></script>
        <script src="js/main.js"></script>

        <!-- Audio Player and Initialization -->
        <script src="js/jquery.jplayer.min.js"></script>
        <script src="js/jplayerInit.js"></script>

</body>

</html>