<?php
session_start();
include '../conn_db.php';
$maxLength = 150;
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
$id_admin=$_SESSION['id'];

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM users WHERE id = '$id'");
};

?>
  
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Méta-informations -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Cultur Campus | Modifier Admin</title>
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
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
      
.news-img {
      width: 100%; 
      height: 300px; 
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
                                <h2>Admin(s)</h2>
                            </div>
                        </div>
                    </div>
                    <!-- Boucle pour afficher les actualités -->
                    <div class="row">
                        <?php
                        // Vérifier s'il y a des actualités à afficher
                        // if (mysqli_num_rows($result) > 0) {
                        //     while ($row = mysqli_fetch_assoc($result)) {
                            $select = mysqli_query($conn, "SELECT * FROM users");
                            while($row = mysqli_fetch_assoc($select)){ 

                                $image = $row['image'];
                                $nom = $row['nom'];
                                $preUser=$row['prenom'];
                                $em=$row['email'];
                                $tel=$row['telephone'];
                                $desc=$row['description'];
                                $fb=$row['lien_fb'];
                                $insta=$row['lien_insta'];
                                $x=$row['lien_x'];
                                $link=$row['lien_linkdin'];
                                // Structure HTML pour afficher chaque actualité
                                echo '
                                <div class="col-md-6">
                                <div class="white_shd full margin_bottom_30">
                                <div class="table_section padding_infor_info">
                                    <div class="table-responsive-sm">
                                    <div class="news-item">

                                    <img src="../img/user_img/' . $image . '" class="news-img" width="100%" height="auto" alt="">                                               
                                                <h3 class="news-title">  ' . $nom .' '.$preUser . '</h3>

                                                <p class="news-title"> Email : ' .$em. '</p>
                                                 
                                                <p class="news-title"> Telephone : ' .$tel. '</p>

                                                <p class="news-title"> une description : ' .$desc. '</p>

                                                <p class="news-title"> Facebook : ' .$fb. '</p>

                                                <p class="news-title">Instagram : ' .$insta. '</p>

                                                <p class="news-title"> X : ' .$x. '</p>

                                                <p class="news-title"> Linkdin : '  .$link. '</p>
                     
                                                <center>
                                                   
                                                    <div class="button_block" style="display: inline-block;">
                                                        <a href="modifier_admin2.php?id=' . $row['id'] . '"  class="btn cur-p btn-outline-primary">Modifier</a>
                                                    </div>
                                                </center>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ';
                            }
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
   // Lier l'URL de suppression uniquement au bouton de confirmation de suppression dans le modal
   $('#deleteConfirmationModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Bouton qui a déclenché l'ouverture du modal
      var href = button.attr('href'); // Récupérer l'URL de suppression depuis le bouton
      $(this).find('.modal-footer #deleteLink').attr('href', href); // Lier l'URL de suppression au bouton de confirmation de suppression
   });
});



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