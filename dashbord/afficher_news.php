<?php
session_start();
include '../conn_db.php';
$maxLength = 150;
$sql = "SELECT * FROM news";
$result = mysqli_query($conn, $sql);
$id_admin=$_SESSION['id'];



// Récupérer la date actuelle pour supprimer automatiquement les news expirées
$current_date = date('Y-m-d');
// Requête pour sélectionner les news expirées
$sql3 = "SELECT id_news FROM news WHERE date_fin <= '$current_date'";
$result3 = mysqli_query($conn, $sql3);
while ($li = mysqli_fetch_assoc($result3)) {
    $news_id = $li['id_news'];
    $delete_sql = "DELETE FROM news WHERE id_news = '$news_id'";
    mysqli_query($conn, $delete_sql);
}  

if(isset($_GET['delete'])){
    $id_news = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM news WHERE id_news = '$id_news'");
    $message[] = " l'actualité est suppripmée ";
    header("Location: afficher_news.php");

 };?>



  
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Méta-informations -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Cultur Campus | Actualité</title>
    <!-- Favicon -->
    <link href="images/logo/logo_icon.jpeg" rel="shortcut icon"/>
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

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
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
      
.news-img {
      width: 100%; 
      height: 200px; 
      object-fit: cover; 
              }
.news-container {
    height: 200px; /* Hauteur fixe */
    overflow: hidden; /* Cache le texte débordant */
    text-overflow: ellipsis; /* Ajoute des points de suspension si le texte est coupé */
}

.news-title {
    font-size: 18px; /* Taille de la police */
    font-weight: bold; /* Gras */
    margin-bottom: 10px; /* Espacement */
}

.news-description {
    font-size: 14px; /* Taille de la police */
    line-height: 1.6; /* Hauteur de ligne */
    height: 120px; /* Hauteur fixe pour la description */
    overflow: hidden; /* Cache le texte débordant */
    text-overflow: ellipsis; /* Ajoute des points de suspension */
    display: -webkit-box;
    -webkit-line-clamp: 5; /* Limite le nombre de lignes */
    -webkit-box-orient: vertical;
}

.news-container {
    display: flex;
    flex-direction: column;
}

.news-item {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.news-description {
    flex-grow: 1; /* Permet à la description de remplir l'espace disponible */
}

.news-description .full-text {
    display: none;
}
.news-description a.read-more {
    color: blue; /* ou toute autre couleur souhaitée */
    cursor: pointer;
    text-decoration: underline;
}

.news-description {
    overflow-y: auto; /* Permet le défilement vertical */
    max-height: 120px; /* Hauteur maximale avant que le défilement ne commence */
}


    </style>

</head>
<body class="inner_page tables_page">
<div class="full_container">
    <div class="inner_container">
        <!-- Inclure la barre latérale -->
        <?php include 'sidebar.php'; ?>
        <!-- Contenu de la page -->
        <div id="content">
            <!-- Inclure la barre supérieure -->
            <?php include 'topbar.php'; ?>
            <!-- Contenu principal -->
            <div class="midde_cont">
                <div class="container-fluid">
                    <div class="row column_title">
                        <div class="col-md-12">
                            <br><br>
                            <div class="page_title">
                                <h2>News</h2>
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
                    </div>
                    <!-- Boucle pour afficher les actualités -->
                    <div class="row">
                        <?php
                        // Vérifier s'il y a des actualités à afficher
                        if (mysqli_num_rows($result) > 0) {
                        //     while ($row = mysqli_fetch_assoc($result)) {
                                // Extraire les données de chaque actualité
                               
                                $select = mysqli_query($conn, "SELECT * FROM news");
                                while($row = mysqli_fetch_assoc($select)){ 

                                $image = $row['image'];
                                $date = $row['date_debut'];
                                $title = $row['titre'];
                                $description = $row['description'];
                                $nomUser=$row['user'];
                                
                                // Structure HTML pour afficher chaque actualité
                                echo '
                                <div class="col-md-6">
                                <div class="white_shd full margin_bottom_30">
                                <div class="table_section padding_infor_info">
                                    <div class="table-responsive-sm">
                                    <div class="news-item">

                                                <img src="../img/news_images/' . $image . '" class="news-img" width="100%" height="auto" alt="">
                                                <div class="blog-date">' . $date .'</div>
                                                <h3 class="news-title">' . $title . '</h3>
                                                <div class="blog-meta">ajoutée par  '.$nomUser.'</div>
                                                <p class="news-description"> '  . $description . '</p>
                                                <center>
                                                   
                                                    <div class="button_block" style="display: inline-block;">
                                                        <a href="modifier_news.php?id=' . $row['id_news'] . '"  class="btn cur-p btn-outline-primary">Modifier</a>
                                                    </div>
                                                  ';?>
                                                                                             <a href="afficher_news.php?delete=<?php echo $row['id_news']; ?>" name="delete" data-toggle="modal" data-target="#deleteConfirmationModal" style="background-color: red; margin-left: 5px;" class="btn btn-success btn-xs"><i class="fa-solid fa-trash"></i></a>

                                                   <?php if ($row['visibility'] == 1) { ?>
        <a href="toggle_visibility.php?id=<?php echo $row['id_news']; ?>&visibility=0&table=news"><i class="fa-solid fa-eye"></i></a>
    <?php } else { ?>
        <a href="toggle_visibility.php?id=<?php echo $row['id_news']; ?>&visibility=1&table=news"><i class="fa-solid fa-eye-slash"></i></a>
    <?php } ?>

                                                </center>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            // Aucune actualité trouvée
                            echo '<p>Aucune actualité disponible pour le moment.</p>';
                        }
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

<!-- Add JavaScript to handle deletion confirmation -->
<script>
//    $(document).ready(function() {
//    // Lier l'URL de suppression uniquement au bouton de confirmation de suppression dans le modal
//    $('#deleteConfirmationModal').on('show.bs.modal', function (event) {
//       var button = $(event.relatedTarget); // Bouton qui a déclenché l'ouverture du modal
//       var href = button.attr('href'); // Récupérer l'URL de suppression depuis le bouton
//       $(this).find('.modal-footer #deleteLink').attr('href', href); // Lier l'URL de suppression au bouton de confirmation de suppression
//    });
// });



   window.onload = function() {
    let newsDescriptions = document.querySelectorAll('.news-description');
    let maxHeight = 0;

    // Trouver la hauteur maximale
    newsDescriptions.forEach(function(node) {
        if (node.clientHeight > maxHeight) {
            maxHeight = node.clientHeight;
        }
    });

    // Appliquer la hauteur maximale à tous les éléments
    newsDescriptions.forEach(function(node) {
        node.style.height = maxHeight + 'px';
    });
};


newsDescriptions.forEach(function(node) {
    let length = node.textContent.length;
    if (length > 200) {
        node.style.fontSize = '12px'; // Plus petit pour les textes longs
    } else {
        node.style.fontSize = '14px'; // Plus grand pour les textes courts
    }
});

document.querySelectorAll('.news-description').forEach(desc => {
    const maxLength = 200; // Définir la longueur maximale du texte visible
    if (desc.innerText.length > maxLength) {
        let shownText = desc.innerText.substring(0, maxLength) + '...';
        let fullText = desc.innerText;
        desc.innerHTML = <span class="short-text">${shownText}</span><span class="full-text" style="display:none;">${fullText}</span><a href="#" class="read-more">Lire la suite</a>;

        desc.querySelector('.read-more').addEventListener('click', function(e) {
            e.preventDefault();
            this.previousSibling.style.display = 'inline';
            this.previousSibling.previousSibling.style.display = 'none';
            this.style.display = 'none'; // Cache le lien après extension
        });
    }
});


</script>

<script>
$(document).ready(function() {
    $('#searchInput').on('keyup', function() {
        var searchText = $(this).val().toLowerCase();
        var found = false;
        $('.col-md-6').each(function() {
            var Title = $(this).find('.news-title').text().toLowerCase();
            var desc = $(this).find('.news-description').text().toLowerCase();
            var admin = $(this).find('.blog-meta').text().toLowerCase();


            if (Title.includes(searchText) || desc.includes(searchText) || admin.includes(searchText)) {
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