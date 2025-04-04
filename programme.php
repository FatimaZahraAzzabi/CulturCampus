<?php
include 'conn_db.php';

$sql_programmes = "SELECT DISTINCT titre_programme FROM programme WHERE visibility = 1";
$result_programmes = mysqli_query($conn, $sql_programmes);

$nomProgrammeFiltre = isset($_GET['nom_programme']) ? $_GET['nom_programme'] : '';

$sql = "SELECT * FROM programme WHERE visibility = 1";
if(!empty($nomProgrammeFiltre)) {
    $sql .= " AND titre_programme = '$nomProgrammeFiltre'";
}

$result = mysqli_query($conn, $sql);

$sql_count = "SELECT COUNT(*) AS total_programmes FROM programme";
$result_count = mysqli_query($conn, $sql_count);
$row_count = mysqli_fetch_assoc($result_count);
$total_programmes = $row_count['total_programmes'];

?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>Cultur campus | Programmes</title>
    <meta charset="UTF-8">
    <meta name="description" content="SolMusic HTML Template">
    <meta name="keywords" content="music, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link href="img/favicon.jpeg" rel="shortcut icon"/>
    <!-- Google font -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/font-awesome.min.css"/>
    <link rel="stylesheet" href="css/owl.carousel.min.css"/>
    <link rel="stylesheet" href="css/slicknav.min.css"/>
    <!-- Main Stylesheets -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .filter-form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .filter-form label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .filter-form select,
        .filter-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .filter-form input[type="submit"] {
            background-color: #0a183d;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .filter-form input[type="submit"]:hover {
            background-color: #333;
        }
        .category-items {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .category-item {
            flex: 1 1 calc(33.333% - 20px);
            box-sizing: border-box;
            height: 350px;
            overflow: hidden;
        }
        .image-overlay {
            position: relative;
            overflow: hidden;
        }
        .overlay-text {
            position: absolute;
            top: 260px;
            left: 0;
            right: 0;
            padding: 10px;
            text-align: center;
            transition: 0.3s;
            color: #0a183d;
            font-size: 18px;
            line-height: 1.5;
            font-weight: bold;
            max-width: 300px;
            min-width: 300px;
        }
        .snip1573 {
            background-color: #0a183d;
            display: inline-block;
            font-family: 'Open Sans', sans-serif;
            font-size: 16px;
            max-width: 300px;
            min-width: 300px;
            overflow: hidden;
            position: relative;
            text-align: center;
            width: 100%;
            border-radius: 60px;
        }
        .snip1573 * {
            box-sizing: border-box;
            transition: all 0.35s ease;
        }
        .snip1573:before,
        .snip1573:after {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            transition: all 0.35s ease;
            background-color: #0a183d;
            border-left: 3px solid #fff;
            border-right: 3px solid #fff;
            content: '';
            opacity: 0.9;
            z-index: 1;
        }
        .snip1573:before {
            transform: skew(45deg) translateX(-155%);
        }
        .snip1573:after {
            transform: skew(45deg) translateX(155%);
        }
        .snip1573 img {
            backface-visibility: hidden;
            max-width: 100%;
            vertical-align: top;
        }
        .snip1573 figcaption {
            top: 50%;
            left: 50%;
            position: absolute;
            z-index: 2;
            transform: translate(-50%, -50%) scale(0.5);
            opacity: 0;
            box-shadow: 0 0 10px #0a183d;
        }
        .snip1573 h3 {
            background-color: #0a183d;
            border: 2px solid #fff;
            color: #fff;
            font-size: 1em;
            font-weight: 600;
            letter-spacing: 1px;
            margin: 0;
            padding: 5px 10px;
            text-transform: uppercase;
        }
        .snip1573 a {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 3;
        }
        .snip1573:hover > img,
        .snip1573.hover > img {
            opacity: 0.5;
        }
        .snip1573:hover:before,
        .snip1573.hover:before {
            transform: skew(45deg) translateX(-55%);
        }
        .snip1573:hover:after,
        .snip1573.hover:after {
            transform: skew(45deg) translateX(55%);
        }
        .snip1573:hover figcaption,
        .snip1573.hover figcaption {
            transform: translate(-50%, -50%) scale(1);
            opacity: 1;
        }

        @media (max-width: 767px) {
    .filter-form {
        display: none;
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

    <!-- Category section -->
    <div class="container-fluid">
    
        <div class="section-title">
          <br><br><br>
                <h2>&nbsp;Programmes <i class="fa-solid fa-microphone-lines"></i></h2>
            <p>Nombre de programmes : <?php echo $total_programmes; ?></p>

            </div>
        <br>
        <div class="row">
        <div class="col-lg-3">
        <div class="filter-icon d-block d-lg-none">
    <i class="fas fa-filter"></i>
</div>
                <div class="filter-form">
                    <form action="" method="GET">
                        <label for="nom_programme">Nom du programme :</label>
                        <select name="nom_programme" id="nom_programme">
                            <option value="">Tous les programmes</option>
                            <?php mysqli_data_seek($result_programmes, 0); ?>
                            <?php while ($row_programme = mysqli_fetch_assoc($result_programmes)) { ?>
                                <option value="<?php echo $row_programme['titre_programme']; ?>" <?php if ($nomProgrammeFiltre == $row_programme['titre_programme']) echo "selected"; ?>><?php echo $row_programme['titre_programme']; ?></option>
                            <?php } ?>
                        </select>

                        <input type="submit" value="Filtrer">
                    </form>
                </div>
            </div>
            <div class="col-lg-9">
                <!-- Category items -->
                <div class="category-items">
                    <div class="row">
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <div class="category-item">
                                <div class="image-overlay"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <figure class="snip1573">
                                        <img src="img/programme_images/<?php echo $row['image_prog']; ?>" style="height: 250px; width: 200px;" alt="">
                                        <figcaption>
                                            <h3>voir épisodes</h3>
                                        </figcaption>
                                       
                                      <a href="episodes?/=<?php echo $row['id_programme']; ?>"></a>

                                    </figure>
                                </div>
                                <div class="overlay-text"><br>
                                    <h4><?php echo $row['titre_programme']; ?></h4>
                                </div>
                                <br><br><br>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <style>
    @media (max-width: 767px) {
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .filter-form {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }

        .filter-form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .filter-form select,
        .filter-form input {
            width: 100%;
            padding: 8px;
            margin-bottom: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .filter-form input[type="submit"] {
            background-color: #0a183d;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .filter-form input[type="submit"]:hover {
            background-color: #333;
        }

        .category-items {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .category-item {
            flex: 1 1 100%;
            box-sizing: border-box;
            height: auto;
            overflow: hidden;
            margin-bottom: 15px;
        }

        .overlay-text {
            position: absolute;
            bottom: 10px;
            left: 0;
            right: 0;
            padding: 10px;
            text-align: center;
            transition: 0.3s;
            color: #0a183d;
            font-size: 16px;
            line-height: 1.5;
            font-weight: bold;
        }

        .snip1573 {
            background-color: #0a183d;
            display: inline-block;
            font-family: 'Open Sans', sans-serif;
            font-size: 14px;
            width: 100%;
            overflow: hidden;
            position: relative;
            text-align: center;
            border-radius: 60px;
        }

        .snip1573 * {
            box-sizing: border-box;
            transition: all 0.35s ease;
        }

        .snip1573:before,
        .snip1573:after {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            transition: all 0.35s ease;
            background-color: #0a183d;
            border-left: 3px solid #fff;
            border-right: 3px solid #fff;
            content: '';
            opacity: 0.9;
            z-index: 1;
        }

        .snip1573:before {
            transform: skew(45deg) translateX(-155%);
        }

        .snip1573:after {
            transform: skew(45deg) translateX(155%);
        }

        .snip1573 img {
            backface-visibility: hidden;
            max-width: 100%;
            vertical-align: top;
        }

        .snip1573 figcaption {
            top: 50%;
            left: 50%;
            position: absolute;
            z-index: 2;
            transform: translate(-50%, -50%) scale(0.5);
            opacity: 0;
            box-shadow: 0 0 10px #0a183d;
        }

        .snip1573 h3 {
            background-color: #0a183d;
            border: 2px solid #fff;
            color: #fff;
            font-size: 0.9em;
            font-weight: 600;
            letter-spacing: 1px;
            margin: 0;
            padding: 5px 10px;
            text-transform: uppercase;
        }

        .snip1573 a {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 3;
        }

        .snip1573:hover > img,
        .snip1573.hover > img {
            opacity: 0.5;
        }

        .snip1573:hover:before,
        .snip1573.hover:before {
            transform: skew(45deg) translateX(-55%);
        }

        .snip1573:hover:after,
        .snip1573.hover:after {
            transform: skew(45deg) translateX(55%);
        }

        .snip1573:hover figcaption,
        .snip1573.hover figcaption {
            transform: translate(-50%, -50%) scale(1);
            opacity: 1;
        }
    }
.filter-icon {
    display: none;
}

@media (max-width: 991px) {
    .filter-form {
        display: none; 
    }

    .filter-icon {
        display: block;
    }

    .filter-form.mobile-visible {
        display: block !important;
    }
}

</style>

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
    <script>
   document.addEventListener('DOMContentLoaded', function() {
    var filterIcon = document.querySelector('.filter-icon');

    var filterForm = document.querySelector('.filter-form');

    filterIcon.addEventListener('click', function() {
        if (filterForm.classList.contains('mobile-visible')) {
            filterForm.classList.remove('mobile-visible');
        } else {
            filterForm.classList.add('mobile-visible');
        }
    });
});


    </script>
</body>
</html>