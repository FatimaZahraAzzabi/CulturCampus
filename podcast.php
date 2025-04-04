<?php
@include 'conn_db.php';

session_start(); // Démarrez la session pour stocker les informations sur les likes

if (isset($_GET['podcast_id']) && isset($_GET['action'])) {
    $podcastId = $_GET['podcast_id'];

    if ($_GET['action'] === 'like') {
        // Vérifiez si l'utilisateur n'a pas déjà aimé ce podcast
        if (!isset($_SESSION['liked_podcasts']) || !in_array($podcastId, $_SESSION['liked_podcasts'])) {
            // Mettez à jour le nombre de likes dans la base de données
            $updateQuery = "UPDATE podcast SET likes = likes + 1 WHERE id_podcast = ?";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bind_param("i", $podcastId);
            $stmt->execute();
            $stmt->close();

            // Ajoutez l'ID du podcast aux likes de l'utilisateur
            $_SESSION['liked_podcasts'][] = $podcastId;
        }
    } elseif ($_GET['action'] === 'unlike') {
        // Retirez le like de l'utilisateur s'il existe
        if (isset($_SESSION['liked_podcasts']) && in_array($podcastId, $_SESSION['liked_podcasts'])) {
            // Mettez à jour le nombre de likes dans la base de données
            $updateQuery = "UPDATE podcast SET likes = likes - 1 WHERE id_podcast = ?";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bind_param("i", $podcastId);
            $stmt->execute();
            $stmt->close();

            // Retirez l'ID du podcast des likes de l'utilisateur
            $_SESSION['liked_podcasts'] = array_diff($_SESSION['liked_podcasts'], array($podcastId));
        }
    }
	

    // Redirigez vers la même page pour éviter la répétition de l'action lors du rafraîchissement de la page
    header('Location:podcasts' ) ;
    exit();
}



?>
<!DOCTYPE html>
<html lang="zxx">
<head>
		<title>Cultur campus | Podcasts</title>

	<meta charset="UTF-8">
	<meta name="description" content="SolMusic HTML Template">
	<meta name="keywords" content="music, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- Favicon -->
<link href="img/favicon.jpeg" rel="shortcut icon"/>
	<!-- Google font -->
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>


	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="css/slicknav.min.css"/>
    <script src="js/jquery-3.2.1.min.js"></script>

	<!-- Main Stylesheets -->


	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<style>
		 /* Styles pour les boutons de like */
		 .like-button {
            text-decoration: none;
            color: #333;
        }
        .like-button:hover {
            color: #ff6347; /* Couleur de l'icône like au survol */
        }
	.songs-section {
    padding: 50px 0;
}

.song-item {
    margin-bottom: 30px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.song-item:hover {
    transform: translateY(-5px);
    transition: transform 0.3s ease;
}

.song-info-box {
    display: flex;
    align-items: center;
    padding: 20px;
}

.song-info-box img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-right: 20px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.song-info-box img:hover {
    transform: scale(1.1);
}

.song-info h4 {
    margin-bottom: 10px;
    font-size: 18px;
    color: #333;
}

.song-info p {
    font-size: 14px;
    color: #666;
}

.single_player_container {
    display: flex;
    align-items: center;
}

.songs-links {
    display: flex;
    align-items: center;
}

.songs-links a {
    margin-right: 10px;
}

/* Animation pour le bouton de lecture */
.song-info-box:hover .play-button {
    opacity: 1;
    transform: scale(1);
}

.play-button {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    opacity: 0;
    transition: opacity 0.3s ease, transform 0.3s ease;
}

.play-button img {
    width: 50px;
    height: 50px;
}

/* Animation pour le bouton de like */
.like-button {
    transition: transform 0.3s ease;
}

.like-button:hover {
    transform: scale(1.1);
}

/* Styles pour les boutons de téléchargement et de like */
.tel-button,
.like-button {
    text-decoration: none;
    color: #333;
    transition: transform 0.3s ease;
    margin-right: 10px;
}

.tel-button:hover,
.like-button:hover {
    transform: scale(1.1);
}
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
    background-color: #f8d7da; /* Couleur de fond rouge pour indiquer un message d'erreur */
    color: #721c24; /* Couleur du texte pour contraster avec le fond */
    border-radius: 5px;
    margin-top: 20px;
}

#notFound img {
    max-width: 100px; /* Ajustez la largeur de l'image selon vos besoins */
    margin-bottom: 10px; /* Espace entre l'image et le texte */
}

.song-item.active {
    background-color: #7db7cbb7;
}
/* @media only screen and (max-width: 767px) {

.col-lg-6 {
		 position: absolute; 
		left: 250px;
	}} */
</style>
<style>/* Media query pour les appareils mobiles avec une largeur maximale de 767px */
@media only screen and (max-width: 767px) {
    /* Ajustement de la position des éléments */
    .song-item {
        margin-bottom: 20px; /* Réduction de la marge inférieure */
    }
    .song-info-box img {
        width: 80px; /* Réduction de la taille de l'image */
        height: 80px;
        margin-right: 10px; /* Réduction de la marge droite */
    }
    .song-info h4 {
        font-size: 16px; /* Réduction de la taille du titre */
    }
    .song-info p {
        font-size: 12px; /* Réduction de la taille du texte d'information */
    }
    .single_player_container {
        margin-top: 0px; /* Ajout de marge en haut du lecteur audio */
    	padding-left: 10px;
}
    .songs-links {
        margin-top: 10px; /* Ajout de marge en haut des liens de podcast */
    }
    .tel-button,
    .like-button {
        font-size: 14px; /* Réduction de la taille des boutons de téléchargement et de like */
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
	<!-- Header section -->
	<?php include 'header.php'; ?>

	<!-- Header section end -->
   
    <!-- <div id="wrap">
  <form  action="" autocomplete="on" class="pull-right position search_inbox">
  <input id="searchInput" name="search" type="text" placeholder="chercher....">
  <input id="search_submit" value="Rechercher" style="color: #0a183d;" type="submit">
  </form>
</div> -->



		<div class="container-fluid">
    

			<div class="section-title">

<br><br>
			<h2>	&nbsp;&nbsp;&nbsp;Podcasts <i class="fa-solid fa-microphone-lines"></i></h2>
            <center>
<div class="search-box">
    <button class="btn-search"><i class="fas fa-search"></i></button>
    <input id="searchInput" name="search" type="text" class="input-search" placeholder="Type to Search...">
  </div></center>
        </div>



	<!-- Songs section  -->

	<section class="songs-section">
		
			<div class="container">
			
	<!-- song -->
    
	<?php  
	       
		   $select = mysqli_query($conn, "SELECT * FROM podcast WHERE visibility = 1"); 
	   
		   while($row = mysqli_fetch_assoc($select)){
            $podcastId = $row['id_podcast'];
            ?>
	
			<div class="song-item">
		
			   
				<div class="row">
					<div class="col-lg-4">
						<div class="song-info-box">
							<img src="img/podcast_img/<?php echo $row['image']; ?>" alt="">
							<div class="song-info">
									<h4><?php echo $row['nom_podcast']; ?></h4>					
								<p><?php echo $row['enregistrer_par']; ?></p>
								</div>
						</div>
					</div>
					<div class="col-lg-6">
                    <div class="single_player_container">
                <div class="single_player">
                    <!-- Player Controls -->
                    <div class="player_controls_box" id="audio-<?php echo $podcastId; ?>">
    <audio id="audioPlayer-<?php echo $podcastId; ?>" data-podcast-id="<?php echo $podcastId; ?>" src="audios/podcast_audio/<?php echo $row['audio']; ?>" type="audio/mpeg"></audio>
    <button class="jp-prev player_button" id="prevButton-<?php echo $podcastId; ?>" tabindex="0">
        <i class="fa fa-backward" style="font-size: 1px;"></i>
    </button>
    <button class="jp-play player_button" id="playButton-<?php echo $podcastId; ?>" tabindex="0">
        <i class="fa fa-play" style="color:white;" style="font-size: 1px;"></i>
    </button>
    <button class="jp-next player_button" id="nextButton-<?php echo $podcastId; ?>" tabindex="0">
        <i class="fa fa-forward" style="font-size: 1px;"></i>
    </button>
    <button class="jp-stop player_button" id="stopButton-<?php echo $podcastId; ?>" tabindex="0">
        <i class="fa fa-stop" style="font-size: 1px;"></i>
    </button>
</div>


                </div>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span class="audio-duration" id="duration-<?php echo $podcastId; ?>"></span>

            </div>


 <!-- script pour play pause audio -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    var audio = document.getElementById('audioPlayer-<?php echo $podcastId; ?>');
    var playButton = document.getElementById('playButton-<?php echo $podcastId; ?>');
    var stopButton = document.getElementById('stopButton-<?php echo $podcastId; ?>');
    
    playButton.addEventListener('click', function() {
        if (audio.paused) {
            audio.play();
            playButton.innerHTML = '<i class="fa fa-pause" style="color:white;"></i>';
        } else {
            audio.pause();
            playButton.innerHTML = '<i class="fa fa-play" style="color:white;"></i>';
        }
    });

    stopButton.addEventListener('click', function() {
        audio.pause();
        audio.currentTime = 0;
        playButton.innerHTML = '<i class="fa fa-play" style="color:white;"></i>';
    });
});

</script>

</div>

					<div class="col-lg-2">
					<div class="songs-links">
    <?php
        $likeAction = isset($_SESSION['liked_podcasts']) && in_array($row['id_podcast'], $_SESSION['liked_podcasts']) ? 'unlike' : 'like';
        $likeIcon = $likeAction === 'like' ? 'fa-regular' : 'fa-solid';
        echo "<a href='?action={$likeAction}&podcast_id={$row['id_podcast']}'  class='like-button'>";
        echo "<i class='{$likeIcon} fa-heart '></i> {$row['likes']}";
        echo "</a>";

    ?>
    
      <a href="#" style="color:black;">
        <i class="fa-solid fa-headphones"></i>   <?php echo $row['listeners']; ?>
    </a>
  <a class='tel-button' href="audios/podcast_audio/<?php echo $row['audio']; ?>" download="<?php echo $row['nom_podcast']; ?>--<?php echo $row['enregistrer_par']; ?>" style="color:black;">
	<i class="fa-solid fa-download" ></i> </a>
</div>


									</div>	
				</div>
				
			</div>
		
			<?php } ?>	
            <div id="notFound" style="display: none;">Aucun résultat trouvé
    </div>
								
		
	</section>	
 
	<!-- Songs section end -->

<!-- Footer section -->
<?php include 'footer.php'; ?>
<!-- Footer section end -->

 <!-- Script pour la gestion de la lecture des podcasts -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Écoutez l'événement de lecture de chaque élément audio
    $('audio').on('play', function() {
        // Récupérez l'ID du podcast en cours de lecture
        var currentPodcastId = $(this).data('podcast-id');
        // Parcourez tous les autres éléments audio
        $('audio').each(function() {
            // Si l'élément audio n'est pas celui en cours de lecture, mettez-le en pause
            if ($(this).data('podcast-id') !== currentPodcastId) {
                this.pause(); // Mettez en pause l'élément audio
            }
        });
    });
});
</script>
<!-- script pour afficher la durée d'un podcast -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fonction pour obtenir la durée formatée de l'audio
        function getFormattedAudioDuration(audio) {
            var duration = Math.floor(audio.duration);
            var hours = Math.floor(duration / 3600);
            var minutes = Math.floor((duration % 3600) / 60);
            var seconds = duration % 60;
            var formattedDuration = (hours < 10 ? '0' : '') + hours + ':' + (minutes < 10 ? '0' : '') + minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
            return formattedDuration;
        }

        var audioElements = document.querySelectorAll('audio');
        
        audioElements.forEach(function(audio) {
            audio.addEventListener('loadedmetadata', function() {
                var podcastId = audio.dataset.podcastId;
                var durationElement = document.getElementById('duration-' + podcastId);
                var formattedDuration = getFormattedAudioDuration(audio);
                durationElement.textContent = formattedDuration;
            });
        });
    });
</script>

<!-- script pour l'activation d'un audio -->
<script>
$(document).ready(function() {
    $('audio').on('play', function() {
        var podcastId = $(this).data('podcast-id');
        $('.song-item').removeClass('active');
        $(this).closest('.song-item').addClass('active');
    });
});
</script>
<script>
$(document).ready(function() {
    function pauseOtherAudio(currentAudio) {
        $('audio').each(function(index, audio) {
            if (audio !== currentAudio) {
                audio.pause(); io
            }
        });
    }

    $('audio').on('play', function() {
        var podcastId = $(this).data('podcast-id');
        pauseOtherAudio(this); 
        $('.song-item').removeClass('active');
        $(this).closest('.song-item').addClass('active');
    });
    $('audio').on('pause', function() {
        $(this).closest('.song-item').removeClass('active');
    });
});
</script>

<!-- script pour la recherche -->
<script>
$(document).ready(function() {
    $('#searchInput').on('keyup', function() {
        var searchText = $(this).val().toLowerCase();
        var found = false;
        $('.song-item').each(function() {
            var songTitle = $(this).find('.song-info h4').text().toLowerCase();
            var songArtist = $(this).find('.song-info p').text().toLowerCase();
            if (songTitle.includes(searchText) || songArtist.includes(searchText)) {
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

<!-- script pour count le nombre de listener -->
<script>
 $('audio').on('play', function() {
    var podcastId = $(this).data('podcast-id');
    $('.song-item').removeClass('active');
    $(this).closest('.song-item').addClass('active');
    
    // Mettre à jour le nombre de listeners dans la base de données
    $.ajax({
        type: 'POST',
        url: 'update_listeners.php',
        data: { podcast_id: podcastId },
        success: function(response) {
            console.log('Nombre de listeners incrémenté pour le podcast ' + podcastId);
        },
        error: function(xhr, status, error) {
            console.error('Erreur lors de la mise à jour du nombre de listeners : ' + error);
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

	<!-- Audio Player and Initialization -->
	<script src="js/jquery.jplayer.min.js"></script>
	<script src="js/jplayerInit.js"></script>

	</body>
</html>
