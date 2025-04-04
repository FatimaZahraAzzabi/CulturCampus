<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Cultur campus | News</title>
    <meta charset="UTF-8">
    <meta name="description" content="SolMusic HTML Template">
    <meta name="keywords" content="music, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link href="img/favicon.jpeg" rel="shortcut icon" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/owl.carousel.min.css" />
    <link rel="stylesheet" href="css/slicknav.min.css" />

    <!-- Main Stylesheets -->
    <link rel="stylesheet" href="css/style1.css" />

    <style>
        .blog-item img {
            width: 100%;
            height: 550px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        @import url(https://fonts.googleapis.com/css?family=Lato:100,300,400,700);
        @import url(https://raw.github.com/FortAwesome/Font-Awesome/master/docs/assets/css/font-awesome.min.css);

        *{box-sizing: border-box;
}

.search-box{
  
  width: fit-content;
  height: fit-content;
  position: relative;
}
.input-search{
  height: 50px;
  width: 50px;
  border-style: none;
  padding: 10px;
  font-size: 18px;
  letter-spacing: 2px;
  outline: none;
  border-radius: 25px;
  transition: all .5s ease-in-out;
  background-color: #130f40;
  padding-right: 40px;
  color:#130f40;
}
.input-search::placeholder{
  color:#130f40;
  font-size: 18px;
  letter-spacing: 2px;
  font-weight: 100;
}
.btn-search{
  width: 50px;
  height: 50px;
  border-style: none;
  font-size: 20px;
  font-weight: bold;
  outline: none;
  cursor: pointer;
  border-radius: 50%;
  position: absolute;
  right: 0px;
  color:#ffffff ;
  background-color:#130f40;
  pointer-events: painted;  
}
.btn-search:focus ~ .input-search{
  width: 300px;
  border-radius: 0px;
  background-color: transparent;
  border-bottom:1px solid #130f40;
  transition: all 500ms cubic-bezier(0, 0.110, 0.35, 2);
}
.input-search:focus{
  width: 300px;
  border-radius: 0px;
  background-color: transparent;
  border-bottom:1px solid #130f40;
  transition: all 500ms cubic-bezier(0, 0.110, 0.35, 2);
}


        #notFound {
            display: none;
            text-align: center;
            padding: 20px;
            background-color: #f8d7da;
            color: #721c24;
            border-radius: 5px;
            margin-top: 20px;
        }

        #notFound img {
            max-width: 100px;
            margin-bottom: 10px;
        }

        .blog-description {
            display: -webkit-box;
            -webkit-line-clamp: 10;
            -webkit-box-orient: vertical;
            overflow: hidden;
            position: relative;
        }

        .read-more {
            color: #007bff;
            cursor: pointer;
            font-weight: bold;
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

    <br><br>
    <center>
<div class="search-box">
    <button class="btn-search"><i class="fas fa-search"></i></button>
    <input id="searchInput" name="search" type="text" class="input-search" placeholder="Type to Search...">
  </div></center>
    <br><br>

    <!-- Blog section -->
    <section class="blog-section spad">
        <?php
        // Inclusion du fichier de connexion à la base de données
        include 'conn_db.php';

        // Requête SQL pour récupérer les actualités
        $sql = "SELECT * FROM news WHERE visibility = 1";
        $result = mysqli_query($conn, $sql);

        // Vérification s'il y a des actualités à afficher
        if (mysqli_num_rows($result) > 0) {
            // Boucle pour afficher chaque actualité
            while ($row = mysqli_fetch_assoc($result)) {
                echo '
                <div class="container">
                    <div class="blog-item">
                        <h3>' . $row['titre'] . '</h3>
                        <div class="blog-date">' . $row['date_debut'] . '</div>
                        <img src="img/news_images/' . $row['image'] . '" alt="">
                        <p class="blog-description">' . $row['description'] . '</p>
                        <span class="read-more">Lire plus...</span>
                    </div>
                </div>';
            }
        } else {
            // Aucune actualité trouvée
            echo '<p>Aucune actualité disponible pour le moment.</p>';
        }

        // Fermer la connexion à la base de données
        mysqli_close($conn);
        ?>
        <div id="notFound" style="display: none;">Aucun résultat trouvé
        </div>
    </section>
    <!-- Blog section end -->

    <!-- Footer section -->
    <?php include 'footer.php'; ?>
    <!-- Footer section end -->

    <script>
        $(document).ready(function() {
            $('#searchInput').on('keyup', function() {
                var searchText = $(this).val().toLowerCase();
                var found = false;
                $('.container').each(function() {
                    var Title = $(this).find('.blog-item h3').text().toLowerCase();
                    var songArtist = $(this).find('.blog-item p').text().toLowerCase();
                    var date = $(this).find('.blog-date').text();
                    if (Title.includes(searchText) || songArtist.includes(searchText) || date.includes(searchText)) {
                        $(this).show();
                        found = true;
                    } else {
                        $(this).hide();
                    }
                });
                if (!found) {
                    $('#notFound').show();
                } else {
                    $('#notFound').hide();
                }
            });

            $('.read-more').click(function() {
                var $this = $(this);
                var $description = $this.siblings('.blog-description');
                if ($description.css('-webkit-line-clamp') === '10') {
                    $description.css('-webkit-line-clamp', 'initial');
                    $this.text('Lire moins');
                } else {
                    $description.css('-webkit-line-clamp', '10');
                    $this.text('Lire plus...');
                }
            });
        });
    </script>
    <!--====== Javascripts & Jquery ======-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.slicknav.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>